<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use PDOException;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController {

	public function initialize() {

		parent::initialize();
		// Include the FlashComponent
		$this->loadComponent( 'Flash' );
		// Load Files model
		$this->loadModel( 'Files' );
		// Set the layout
		// $this->layout = 'frontend';
	}

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|void
	 */
	public function index() {

		$this->Flash->error( __( "You don't have the right to do that" ) );
		return $this->redirect( [ 
				'controller'=>'Airlines', 'action'=>'index'
		] );
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add( $airline_id = null) {

		$file = $this->Files->newEntity();
		if ( $this->request->is( 'post' ) ) {
			if ( ! empty( $this->request->data['file']['name'] ) ) {

				$fileName = $this->request->data['file']['name'];
				$uploadPath = 'uploads/files/';
				$uploadFile = $uploadPath . $fileName;

				if ( move_uploaded_file( $this->request->data['file']['tmp_name'], $uploadFile ) ) {

					$file = $this->Files->patchEntity( $file, $this->request->getData() );
					$file->airline_id = $airline_id;

					$file->user_id = $this->Auth->user( 'id' );

					$file->name = $fileName;
					$file->path = $uploadPath;
					$file->created = date( "Y-m-d H:i:s" );
					$file->modified = date( "Y-m-d H:i:s" );
					if ( $this->Files->save( $file ) ) {
						$this->Flash->success( __( 'Logo has been uploaded and inserted successfully.' ) );
						return $this->redirect( [ 
								'controller'=>'Airlines', 'action'=>'index'
						] );
					} else {
						$this->Flash->error( __( 'Unable to upload logo, please try again.' ) );
					}
				} else {
					$this->Flash->error( __( 'Unable to upload logo, please try again.' ) );
				}
			} else {
				$this->Flash->success( __( 'The airline don\'t have a logo' ) );
				return $this->redirect( [ 
						'controller'=>'Airlines', 'action'=>'index'
				] );
			}
		}
		$this->set( 'file', $file );

		$files = $this->Files->find( 'all', [ 
				'order'=>[ 
						'Files.created'=>'DESC'
				]
		] );
		$filesRowNum = $files->count();
		$this->set( 'files', $files );
		$this->set( 'filesRowNum', $filesRowNum );

		$airlines = $this->Files->Airlines->find( 'list', [ 
				'limit'=>200
		] );
		$users = $this->Files->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'file', 'airlines', 'users' ) );
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	File id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit( $airline_id = null) {

		$files = TableRegistry::get( 'files' );
		$file = $files->find()->where( [ 
				'airline_id ='=>$airline_id
		] )->order( [ 
				'created'=>'DESC'
		] )->first();

		if ( $file == null ) {
			return $this->redirect( [ 
					'action'=>'add', $airline_id
			] );
		}

		if ( $this->request->is( [ 
				'patch', 'post', 'put'
		] ) ) {
			if ( ! empty( $this->request->data['file']['name'] ) ) {

				$file->name = $fileName = $this->request->data['file']['name'];
				$uploadPath = 'uploads/files/';
				$uploadFile = $uploadPath . $fileName;

				if ( move_uploaded_file( $this->request->data['file']['tmp_name'], $uploadFile ) ) {

					$file = $this->Files->patchEntity( $file, $this->request->getData() );

					if ( $this->Files->save( $file ) ) {
						$this->Flash->success( __( 'Logo has been uploaded and inserted successfully.' ) );
						return $this->redirect( [ 
								'controller'=>'Airlines', 'action'=>'index'
						] );
					} else {
						$this->Flash->error( __( 'Unable to upload logo, please try again.' ) );
					}
				} else {
					$this->Flash->error( __( 'Unable to upload logo, please try again.' ) );
				}
			} else {
				$this->Flash->success( __( 'No logo have been upload' ) );
				return $this->redirect( [ 
						'controller'=>'Airlines', 'action'=>'index'
				] );
			}
		}
		$this->set( 'file', $file );

		$files = $this->Files->find( 'all', [ 
				'order'=>[ 
						'Files.created'=>'DESC'
				]
		] );
		$filesRowNum = $files->count();
		$this->set( 'files', $files );
		$this->set( 'filesRowNum', $filesRowNum );

		$airlines = $this->Files->Airlines->find( 'list', [ 
				'limit'=>200
		] );
		$users = $this->Files->Users->find( 'list', [ 
				'limit'=>200
		] );
		$this->set( compact( 'file', 'airlines', 'users' ) );
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	File id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete( $airline_id = null) {

		$files = TableRegistry::get( 'files' );
		$file = $files->find()->where( [ 
				'airline_id ='=>$airline_id
		] )->order( [ 
				'created'=>'DESC'
		] )->first();

		if ( $file == null ) {
			return $this->redirect( [ 
					'controller'=>'Airlines', 'action'=>'index'
			] );
		}

		try {
			unlink( "../webroot/" . $file->path . $file->name );
			if ( $this->Files->delete( $file ) ) {
				$this->Flash->success( __( 'The logo has been deleted.' ) );
			} else {
				$this->Flash->error( __( 'The logo could not be deleted. Please, try again.' ) );
			}
		} catch ( PDOException $e ) {
			$this->Flash->error( __( 'The logo could not be deleted. Please, try again.' ) );
		}
		return $this->redirect( [ 
				'controller'=>'Airlines', 'action'=>'index'
		] );
	}

	public function isAuthorized( $user ) {

		if ( $user['admin'] ) {
			return true;
		} else {
			$action = $this->request->getParam( 'action' );
			if ( in_array( $action, [ 
					'add', 'delete'
			] ) ) {
				return true;
			}

			$airline_id = $this->request->getParam( 'pass.0' );
			if ( ! $airline_id ) {
				return false;
			}

			$files = TableRegistry::get( 'files' );
			$file = $files->find()->where( [ 
					'airline_id ='=>$airline_id
			] )->order( [ 
					'created'=>'DESC'
			] )->first();
			return $file['user_id'] === $user['id'];
		}
	}
}