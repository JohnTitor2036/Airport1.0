<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Exception;
use Cake\ORM\TableRegistry;
use PDOException;

/**
 * Airlines Controller
 *
 * @property \App\Model\Table\AirlinesTable $Airlines
 *
 * @method \App\Model\Entity\Airline[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AirlinesController extends AppController {

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
		$airlines = $this->paginate( $this->Airlines );

		$this->set( compact( 'airlines' ) );
	}

	/**
	 * View method
	 *
	 * @param string|null $id
	 *        	Airline id.
	 * @return \Cake\Http\Response|void
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view( $slug = null) {

		$temp = $this->Airlines->findBySlug( $slug )->firstOrFail();
		$airline = $this->Airlines->get( $temp->id, [ 
				'contain'=>[ 
						'Users', 'Aircrafts'
				]
		] );
		$this->set( 'airline', $airline );
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add() {

		$airline = $this->Airlines->newEntity();
		if ( $this->request->is( 'post' ) ) {
			$airline = $this->Airlines->patchEntity( $airline, $this->request->getData() );
			$airline->user_id = $this->Auth->user( 'id' );
			if ( $this->Airlines->save( $airline ) ) {
				$this->Flash->success( __( 'The airline has been saved.' ) );
				return $this->redirect( [ 
						'controller'=>'Files', 'action'=>'add', $airline->id
				] );
			}
			$this->Flash->error( __( 'The airline could not be saved. Please, try again.' ) );
		}
		$users = $this->Airlines->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'airline', 'users' ) );
	}

	/**
	 * Edit method
	 *
	 * @param string|null $slug
	 *        	Airline slug.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit( $slug = null) {

		$airline = $this->Airlines->findBySlug( $slug )->firstOrFail();

		if ( $this->request->is( [ 
				'patch', 'post', 'put'
		] ) ) {

			$this->Airlines->patchEntity( $airline, $this->request->getData(), [ 
					'accessibleFields'=>[ 
							'user_id'=>false
					]
			] );
			if ( $this->Airlines->save( $airline ) ) {
				$this->Flash->success( __( 'The airline has been saved.' ) );

				return $this->redirect( [ 
						'controller'=>'Files', 'action'=>'edit', $airline->id
				] );
			}
			$this->Flash->error( __( 'The airline could not be saved. Please, try again.' ) );
		}
		$users = $this->Airlines->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'airline', 'users' ) );
	}

	/**
	 * Delete method
	 *
	 * @param string|null $slug
	 *        	Airline slug.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete( $slug = null) {

		$airline = $this->Airlines->findBySlug( $slug )->firstOrFail();

		try {
			$airline_id = $airline->id;

			$files = TableRegistry::get( 'files' );
			$file = $files->find()->where( [ 
					'airline_id ='=>$airline_id
			] )->order( [ 
					'created'=>'DESC'
			] )->first();

			if ( $this->Airlines->delete( $airline ) ) {
				$this->Flash->success( __( 'The airline has been deleted.' ) );
				if ( $file != null ) {
					return $this->redirect( [ 
							'controller'=>'Files', 'action'=>'delete', $airline_id
					] );
				}
			} else {
				$this->Flash->error( __( 'The airline could not be deleted. Please, try again.' ) );
			}
		} catch ( PDOException $e ) {
			$this->Flash->error( __( 'The airline could not be deleted. Please, try again.' ) );
		}
		return $this->redirect( [ 
				'action'=>'index'
		] );
	}

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

			$airline = $this->Airlines->findBySlug( $slug )->first();
			return $airline->user_id === $user['id'];
		}
	}
}