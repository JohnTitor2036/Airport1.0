<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Aircraft;
use Cake\Database\Exception;
use PDOException;

class AircraftsController extends AppController {

	public function initialize() {

		parent::initialize();

		$this->loadComponent( 'Paginator' );
		$this->loadComponent( 'Flash' );
	}

	public function index() {

		$this->paginate = [ 
				'contain'=>[ 
						'Airlines', 'Hangars', 'Users'
				]
		];
		$aircrafts = $this->paginate( $this->Aircrafts );

		$this->set( compact( 'aircrafts' ) );
	}

	public function view( $slug = null) {

		$temp = $this->Aircrafts->findBySlug( $slug )->firstOrFail();
		$aircraft = $this->Aircrafts->get( $temp->id, [ 
				'contain'=>[ 
						'Users', 'FlightSchedules', 'Airlines', 'Hangars'
				]
		] );
		$this->set( 'aircraft', $aircraft );
	}

	public function add() {

		$aircraft = $this->Aircrafts->newEntity();
		if ( $this->request->is( 'post' ) ) {
			$aircraft = $this->Aircrafts->patchEntity( $aircraft, $this->request->getData() );
			$aircraft->user_id = $this->Auth->user( 'id' );

			if ( $this->Aircrafts->save( $aircraft ) ) {
				$this->Flash->success( __( 'Your aircraft has been saved.' ) );

				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'Unable to add your aircraft.' ) );
		}
		$airlines = $this->Aircrafts->Airlines->find( 'list', [ 
				'limit'=>200
		] );
		$hangars = $this->Aircrafts->Hangars->find( 'list', [ 
				'limit'=>200
		] );
		$users = $this->Aircrafts->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'aircraft', 'airlines', 'hangars', 'users' ) );
	}

	public function edit( $slug = null) {

		$aircraft = $this->Aircrafts->findBySlug( $slug )->firstOrFail();

		if ( $this->request->is( [ 
				'post', 'put'
		] ) ) {

			$this->Aircrafts->patchEntity( $aircraft, $this->request->getData(), [ 
					'accessibleFields'=>[ 
							'user_id'=>false
					]
			] );

			if ( $this->Aircrafts->save( $aircraft ) ) {
				$this->Flash->success( __( 'Your aircraft has been updated.' ) );
				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'Unable to update your aircraft.' ) );
		}

		$airlines = $this->Aircrafts->Airlines->find( 'list', [ 
				'limit'=>200
		] );
		$hangars = $this->Aircrafts->Hangars->find( 'list', [ 
				'limit'=>200
		] );
		$users = $this->Aircrafts->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'aircraft', 'airlines', 'hangars', 'users' ) );
	}

	/**
	 * Delete method
	 *
	 * @param string|null $slug
	 *        	Aircraft slug.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete( $slug = null) {

		$this->request->allowMethod( [ 
				'post', 'delete'
		] );
		$aircraft = $this->Aircrafts->findBySlug( $slug )->firstOrFail();

		try {
			if ( $this->Aircrafts->delete( $aircraft ) ) {
				$this->Flash->success( __( 'The aircraft has been deleted.' ) );
			} else {
				$this->Flash->error( __( 'The aircraft could not be deleted. Please, try again.' ) );
			}
		} catch ( PDOException $e ) {
			$this->Flash->error( __( 'The aircraft could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( [ 
				'action'=>'index'
		] );
	}

	// We’ll default to denying access, and incrementally grant access where it makes sense.
	// First, we’ll add the authorization logic for aircraft.
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

			$aircraft = $this->Aircrafts->findBySlug( $slug )->first();
			return $aircraft->user_id === $user['id'];
		}
	}
}