<?php
namespace App\Controller;
use Cake\Core\App;

use App\Controller\AppController;
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
        $this->Auth->allow(['logout', 'add']);
        
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
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Enterprises', 'Students']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $loguser = $this->request->getSession()->read('Auth.User');

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if(!isset($user['role']))
                $user['role'] = 'toBeStudent';

            debug($user);

            if ($result = $this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $user_id = $result->id;
                debug($user_id);


                if(isset($loguser)){
                    if(isset($loguser['role']) && $loguser['role'] === 'admin'){
                        //Admin
                        echo 'test admin';
                    }
                }else{
                    // Créé par l'user
                    // Log in automatiquement
                    $user = $this->Auth->identify();
                    if ($user) {
                        $this->Auth->setUser($user);
                    }

                }

                // Redirection
                if($user['role'] === 'toBeStudent'){
                    return $this->redirect([
                        'controller' => 'Students', 
                        'action' => 'add', $user_id
                    ]);
                }else if($user['role'] === 'toBeEnterprise'){
                    return $this->redirect([
                        'controller' => 'Enterprises', 
                        'action' => 'add', $user_id
                    ]);
                }


            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function confirmStudent($id = null){
        echo 'id:'.$id;
        $user = $this->Users->get($id);
        $user->role = 'student';
    
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user account has been linked to the student.'));
            $loguser = $this->request->getSession()->read('Auth.User');
            if($loguser['id'] == $id){
                
                $this->request->getSession()->write('Auth.User.role', 'student');
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The user account could not be linked to the student. Please, try again.'));
    }

    public function confirmEnterprise($user_id = null){

        $user = $this->Users->get($user_id);
    
        $user->role = 'enterprise';
    
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user account has been linked to the enterprise.'));
            $loguser = $this->request->getSession()->read('Auth.User');
            if($loguser['id'] == $id){
                
                $this->request->getSession()->write('Auth.User', $user);
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The user account could not be linked to the enterprise. Please, try again.'));
    }



    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if(isset($user['role'])){
                    if($user['role'] === 'toBeStudent'){
                        return $this->redirect([
                            'controller' => 'Students', 
                            'action' => 'add', $user['id']
                        ]);
                    }else if($user['role'] === 'toBeEnterprise')
                        return $this->redirect([
                            'controller' => 'Enterprises', 
                            'action' => 'add', $user['id']
                        ]);
                }

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
        }
    }
    
    public function logout()
    {
        $this->Flash->success('Vous avez été déconnecté.');
        return $this->redirect($this->Auth->logout());
    }
    
     public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // Les actions 'add' et 'tags' sont toujours autorisés pour les utilisateur
        // authentifiés sur l'application
        if (in_array($action, ['view'])) {
            return true;
        }

        if (in_array($action, ['confirmStudent']) && isset($user['role']) && $user['role'] === 'toBeStudent') {
            return true;
        }

        if (in_array($action, ['confirmEnterprise']) && isset($user['role']) && $user['role'] === 'toBeEnterprise') {
            return true;
        }

        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {
            if(isset($user['role']) && $user['role'] === 'student'){
                        
                $user_id = (int) $this->request->params['pass'][0];
                    
                //Si user_id correspond au id de l'user courrant
                if($user['id'] == $user_id){
                    return true;
                }
                return false;
            }    
        }

        return parent::isAuthorized($user);
    }
    
}
