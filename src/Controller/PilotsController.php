<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Exception;
use PDOException;

/**
 * Pilots Controller
 *
 * @property \App\Model\Table\PilotsTable $Pilots
 *
 * @method \App\Model\Entity\Pilot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PilotsController extends AppController {

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|void
	 */
	public function index() {

		$this->paginate = [ 
				'contain'=>[ 
						'Users'
				]
		];
		$pilots = $this->paginate( $this->Pilots );

		$this->set( compact( 'pilots' ) );
	}

	/**
	 * View method
	 *
	 * @param string|null $id
	 *        	Pilot id.
	 * @return \Cake\Http\Response|void
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view( $slug = null) {

		$temp = $this->Pilots->findBySlug( $slug )->firstOrFail();
		$pilot = $this->Pilots->get( $temp->id, [ 
				'contain'=>[ 
						'Users', 'FlightSchedules'
				]
		] );
		$this->set( 'pilot', $pilot );
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add() {

		$pilot = $this->Pilots->newEntity();
		if ( $this->request->is( 'post' ) ) {
			$pilot = $this->Pilots->patchEntity( $pilot, $this->request->getData() );
			// Permettre le auth
			$pilot->user_id = $this->Auth->user( 'id' );
			if ( $this->Pilots->save( $pilot ) ) {
				$this->Flash->success( __( 'The pilot has been saved.' ) );

				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'The pilot could not be saved. Please, try again.' ) );
		}
		$users = $this->Pilots->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'pilot', 'users' ) );
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	Pilot id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit( $slug = null) {

		$pilot = $this->Pilots->findBySlug( $slug )->firstOrFail();
		if ( $this->request->is( [ 
				'patch', 'post', 'put'
		] ) ) {
			$this->Pilots->patchEntity( $pilot, $this->request->getData(), [ 
					'accessibleFields'=>[ 
							'user_id'=>false
					]
			] );
			if ( $this->Pilots->save( $pilot ) ) {
				$this->Flash->success( __( 'The pilot has been saved.' ) );

				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'The pilot could not be saved. Please, try again.' ) );
		}
		$users = $this->Pilots->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'pilot', 'users' ) );
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	Pilot id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete( $slug = null) {

		$this->request->allowMethod( [ 
				'post', 'delete'
		] );
		$pilot = $this->Pilots->findBySlug( $slug )->firstOrFail();

		try {
			if ( $this->Pilots->delete( $pilot ) ) {
				$this->Flash->success( __( 'The pilot has been deleted.' ) );
			} else {
				$this->Flash->error( __( 'The pilot could not be deleted. Please, try again.' ) );
			}
		} catch ( PDOException $e ) {
			$this->Flash->error( __( 'The pilot could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( [ 
				'action'=>'index'
		] );
	}

	// We’ll default to denying access, and incrementally grant access where it makes sense.
	// First, we’ll add the authorization logic for pilot.
	public function isAuthorized( $user ) {

		if ( $user['admin'] ) {
			return true;
		} else {
			$action = $this->request->getParam( 'action' );
			if ( in_array( $action, [ 
					'add'
			] ) ) {
				if ( $user['confirm'] ) {
					return true;
				} else {
					return false;
				}
			}

			$slug = $this->request->getParam( 'pass.0' );
			if ( ! $slug ) {
				return false;
			}

			$pilot = $this->Pilots->findBySlug( $slug )->first();
			return $pilot->user_id === $user['id'];
		}
	}
}