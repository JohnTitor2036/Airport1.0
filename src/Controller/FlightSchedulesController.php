<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Exception;
use PDOException;

/**
 * FlightSchedules Controller
 *
 * @property \App\Model\Table\FlightSchedulesTable $FlightSchedules
 *
 * @method \App\Model\Entity\FlightSchedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FlightSchedulesController extends AppController {

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|void
	 */
	public function index() {

		$this->paginate = [ 
				'contain'=>[ 
						'Users', 'Aircrafts', 'Pilots'
				]
		];
		$flightSchedules = $this->paginate( $this->FlightSchedules );

		$this->set( compact( 'flightSchedules' ) );
	}

	/**
	 * View method
	 *
	 * @param string|null $id
	 *        	Flight Schedule id.
	 * @return \Cake\Http\Response|void
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view( $slug = null) {

		$temp = $this->FlightSchedules->findBySlug( $slug )->firstOrFail();
		$flightSchedule = $this->FlightSchedules->get( $temp->id, [ 
				'contain'=>[ 
						'Users', 'Aircrafts', 'Pilots'
				]
		] );
		$this->set( 'flightSchedule', $flightSchedule );
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add() {

		$flightSchedule = $this->FlightSchedules->newEntity();
		if ( $this->request->is( 'post' ) ) {
			$flightSchedule = $this->FlightSchedules->patchEntity( $flightSchedule, $this->request->getData() );
			$flightSchedule->user_id = $this->Auth->user( 'id' );
			if ( $this->FlightSchedules->save( $flightSchedule ) ) {
				$this->Flash->success( __( 'The flight schedule has been saved.' ) );

				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'The flight schedule could not be saved. Please, try again.' ) );
		}
		$users = $this->FlightSchedules->Users->find( 'list', [ 
				'limit'=>200
		] );
		$aircrafts = $this->FlightSchedules->Aircrafts->find( 'list', [ 
				'limit'=>200
		] );
		$pilots = $this->FlightSchedules->Pilots->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'flightSchedule', 'users', 'aircrafts', 'pilots' ) );
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	Flight Schedule id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit( $slug = null) {

		$flightSchedule = $this->FlightSchedules->findBySlug( $slug )->firstOrFail();

		if ( $this->request->is( [ 
				'patch', 'post', 'put'
		] ) ) {

			$this->FlightSchedules->patchEntity( $flightSchedule, $this->request->getData(), [ 
					'accessibleFields'=>[ 
							'user_id'=>false
					]
			] );

			if ( $this->FlightSchedules->save( $flightSchedule ) ) {
				$this->Flash->success( __( 'The flight schedule has been saved.' ) );
				return $this->redirect( [ 
						'action'=>'index'
				] );
			}
			$this->Flash->error( __( 'The flight schedule could not be saved. Please, try again.' ) );
		}
		$users = $this->FlightSchedules->Users->find( 'list', [ 
				'limit'=>200
		] );
		$aircrafts = $this->FlightSchedules->Aircrafts->find( 'list', [ 
				'limit'=>200
		] );
		$pilots = $this->FlightSchedules->Pilots->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'flightSchedule', 'users', 'aircrafts', 'pilots' ) );
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	Flight Schedule id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete( $slug = null) {

		$this->request->allowMethod( [ 
				'post', 'delete'
		] );
		$flightSchedule = $this->FlightSchedules->findBySlug( $slug )->firstOrFail();

		try {
			if ( $this->FlightSchedules->delete( $flightSchedule ) ) {
				$this->Flash->success( __( 'The flight schedule has been deleted.' ) );
			} else {
				$this->Flash->error( __( 'The flight schedule could not be deleted. Please, try again.' ) );
			}
		} catch ( PDOException $e ) {
			$this->Flash->error( __( 'The flight schedule could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( [ 
				'action'=>'index'
		] );
	}

	// We’ll default to denying access, and incrementally grant access where it makes sense.
	// First, we’ll add the authorization logic for flight schedule.
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

			$flightSchedule = $this->FlightSchedules->findBySlug( $slug )->first();
			return $flightSchedule->user_id === $user['id'];
		}
	}
}