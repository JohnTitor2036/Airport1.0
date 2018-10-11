<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Exception;
use PDOException;

/**
 * Hangars Controller
 *
 * @property \App\Model\Table\HangarsTable $Hangars
 *
 * @method \App\Model\Entity\Hangar[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HangarsController extends AppController {

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
		$hangars = $this->paginate( $this->Hangars );

		$this->set( compact( 'hangars' ) );
	}

	/**
	 * View method
	 *
	 * @param string|null $slug
	 *        	Hangar slug.
	 * @return \Cake\Http\Response|void
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view( $slug = null) {

		$temp = $this->Hangars->findBySlug( $slug )->firstOrFail();
		$hangar = $this->Hangars->get( $temp->id, [ 
				'contain'=>[ 
						'Users', 'Aircrafts'
				]
		] );
		$this->set( 'hangar', $hangar );
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add() {

		$hangar = $this->Hangars->newEntity();
		if ( $this->request->is( 'post' ) ) {
			$hangar = $this->Hangars->patchEntity( $hangar, $this->request->getData() );
			$hangar->user_id = $this->Auth->user( 'id' );
			if ( $this->Hangars->save( $hangar ) ) {
				$this->Flash->success( __( 'The hangar has been saved.' ) );

				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'The hangar could not be saved. Please, try again.' ) );
		}
		$users = $this->Hangars->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'hangar', 'users' ) );
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	Hangar id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit( $slug = null) {

		$hangar = $this->Hangars->findBySlug( $slug )->firstOrFail();
		if ( $this->request->is( [ 
				'patch', 'post', 'put'
		] ) ) {
			$this->Hangars->patchEntity( $hangar, $this->request->getData(), [ 
					'accessibleFields'=>[ 
							'user_id'=>false
					]
			] );
			if ( $this->Hangars->save( $hangar ) ) {
				$this->Flash->success( __( 'The hangar has been saved.' ) );

				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'The hangar could not be saved. Please, try again.' ) );
		}
		$users = $this->Hangars->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'hangar', 'users' ) );
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	Hangar id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete( $slug = null) {

		$this->request->allowMethod( [ 
				'post', 'delete'
		] );
		$hangar = $this->Hangars->findBySlug( $slug )->firstOrFail();

		try {
			if ( $this->Hangars->delete( $hangar ) ) {
				$this->Flash->success( __( 'The hangar has been deleted.' ) );
			} else {
				$this->Flash->error( __( 'The hangar could not be deleted. Please, try again.' ) );
			}
		} catch ( PDOException $e ) {
			$this->Flash->error( __( 'The hangar could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( [ 
				'action'=>'index'
		] );
	}

	// We’ll default to denying access, and incrementally grant access where it makes sense.
	// First, we’ll add the authorization logic for hangar.
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

			$hangar = $this->Hangars->findBySlug( $slug )->first();
			return $hangar->user_id === $user['id'];
		}
	}
}