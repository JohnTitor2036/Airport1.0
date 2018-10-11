<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Exception;
use PDOException;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'add', 'email', 'confirm', 'errorConfirm']);
		$this->Auth->deny(['index', 'view']);
	}
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $slug User slug.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $temp = $this->Users->findBySlug( $slug )->firstOrFail();
        $user = $this->Users->get( $temp->id, ['contain' => ['Aircrafts', 'Airlines', 'FlightSchedules', 'Hangars', 'Pilots']] );
        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->id = $this->Auth->user('id');
            $user->uuid = Text::uuid();
            if ($this->Users->save($user)) {
            	$emailTo = $user->email;
            	$emailUser = $user->username;
            	$emailUuid = $user->uuid;
            	return $this->redirect( ['controller' => 'Users', 'action' => 'email', $emailTo, $emailUser, $emailUuid] );
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $slug User slug.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug = null)
    {
    	$user = $this->Users->findBySlug( $slug )->firstOrFail();
    	
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$this->Users->patchEntity( $user, $this->request->getData(), [
        			'accessibleFields' => ['id' => false]
        	]);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $loguser = $this->request->getSession()->read( 'Auth.User' );
                if ($loguser['id'] == $user->id) {
                	return $this->redirect(['action' => 'logout']);
				}
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $aircrafts = $this->Users->Aircrafts->find('list', ['limit' => 200]);
        $airlines = $this->Users->Airlines->find('list', ['limit' => 200]);
        $flightSchedules = $this->Users->FlightSchedules->find('list', ['limit' => 200]);
        $hangars = $this->Users->Hangars->find('list', ['limit' => 200]);
        $pilots = $this->Users->Pilots->find('list', ['limit' => 200]);
        $this->set(compact('user', 'aircrafts', 'airlines', 'flightSchedules', 'hangars', 'pilots'));
    }

    /**
     * Delete method
     *
     * @param string|null $slug User slug.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->findBySlug( $slug )->firstOrFail();
        
        try {
        	if ($this->Users->delete($user)) {
        		$this->Flash->success(__('The user has been deleted.'));
        	} else {
        		$this->Flash->error(__('The user could not be deleted. Please, try again.'));
        	}
        } catch (PDOException $e) {
        	$this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	public function login() {

		if ( $this->request->is( 'post' ) ) {
			$user = $this->Auth->identify();
			if ( $user ) {
				$this->Auth->setUser( $user );
				if (!$user['confirm']) {
					$id = $user['id'];
					$this->Flash->error( __('You need to confirm you email') );
					return $this->redirect( ['controller' => 'Users', 'action' => 'errorConfirm', $id] );
				}
				return $this->redirect( $this->Auth->redirectUrl() );
			}
			$this->Flash->error( __('Your username or password is incorrect.') );
		}
	}

	public function logout() {

		$this->Flash->success( __('You are now logged out.') );
		return $this->redirect( $this->Auth->logout() );
	}
	
	public function email($emailTo = null, $emailUser = null, $emailUuid = null) {
		try {
			$email = new Email('default');
			$email->setFrom('nicolas.meunier@hotmail.ca')
			->setTo($emailTo)
			->setSubject(__('Please confirm your email'))
			->send("Hello ".$emailUser." !\nClick this link to confirme your email : http://localhost/AirportH.4.7/Users/confirm/".$emailUuid);
			$this->Flash->success(__('A confirmation email has been sent to '.$emailTo));
		} catch (Exception $e) {
			$this->Flash->error(__("Error, the confirmation email can't be sent to ".$emailTo));
		}
		return $this->redirect( $this->Auth->redirectUrl() );
	}
	
	public function confirm($emailUuid)
	{
		$user = $this->Users->findByUuid($emailUuid)->first();
		if (!$user->confirm) {
			$user->confirm = '1';
			$this->Users->save($user);
			$this->Flash->success( __("Thanks ".$user->username."! Your email is confirmed") );
		} else {
			$this->Flash->error( __("This email is already confirmed") );
		}
		return $this->redirect( ['controller' => 'Users', 'action' => 'login'] );
	}
	
	public function errorConfirm($id) {
		$user = $this->Users->get($id);
		$this->set(compact('user'));
	}
	
	public function isAuthorized( $user ) {
		
		if ($user['admin']) {
			return true;
		} else {
			$action = $this->request->getParam( 'action' );
			if ( in_array( $action, ['add'] ) ) {
				return true;
			}
			if ( in_array( $action, ['edit'] ) ) {
				if ($user['confirm']) {
					return true;
				} else {
					return false;
				}
			}
			
			$slug = $this->request->getParam( 'pass.0' );
			if ( ! $slug ) {
				return false;
			}
			
			$user2 = $this->Users->findBySlug( $slug )->first();
			return $user2->id === $user['id'];
		}
	}
}