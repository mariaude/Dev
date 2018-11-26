<?php
namespace App\Controller;
use Cake\Core\App;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
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
                $user['role'] = 'student';


            if ($result = $this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $user_id = $result->id;


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
                if($user['role'] === 'student'){
                    return $this->redirect([
                        'controller' => 'Students', 
                        'action' => 'add', $user_id
                    ]);
                }else if($user['role'] === 'enterprise'){
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

                return $this->redirect(['controller' => 'Internships', 'action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function resetPassword($uuid = null)
    {
        $password_link = TableRegistry::get('PasswordLinks')->find()->where(['uuid' => $uuid])->contain(['Users'])->first();

        $time_validity = ($password_link->created->isWithinNext('15 minutes') && $password_link->created->wasWithinLast('15 minutes'));
        
        if(isset($password_link) && $password_link->user != null){
            $user = $password_link->user;
            if(!$password_link->used && $time_validity){
                if ($this->request->is(['patch', 'post', 'put'])) {

                    if($this->request->getData('password') === $this->request->getData('password_confirm')){
                        $user = $this->Users->patchEntity($user, $this->request->getData());
                        if ($this->Users->save($user)) {
                            
                            $passwordLinksModel = $this->loadModel('PasswordLinks');
                            $password_link->used = true;
                            if($passwordLinksModel->save($password_link)){
                                $this->Flash->success(__('Your password has been reset.'));
                            }
        
                            return $this->redirect(['controller' => 'Internships', 'action' => 'index']);
                        }
                    }
                    $this->Flash->error(__('The password could not be reset. Please, try again.'));
                }
            }else{
                //Déja utilisé
                $this->Flash->error(__('This password reset link is expired. Please request an other.'));
                return $this->redirect(['controller' => 'Internships', 'action' => 'index']);
            }
            $this->set(compact('user'));
        }else{
            $this->Flash->error(__('This password reset link is invalid. Please request an other.'));
            return $this->redirect(['controller' => 'Internships', 'action' => 'index']);
        }

        
    }

    public function sendPasswordLink()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $user = $this->Users->find()->where(['email' => $email])->first();

            $this->log($user);

            if($user == null){
                // Courriel pas trouvé
                $this->Flash->error(__('Cette adresse courriel ne correspond à aucun utilisateur.'));
            }else{
                return $this->redirect(['controller' => 'Emails', 'action' => 'sendPasswordLink', $user->id]);
            }

        }
        
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

                    if($user['role'] === 'student'){
                        if($user['student']){
                            if($user['student']['active'] == 0)
                                return $this->redirect([
                                    'controller' => 'Students', 
                                    'action' => 'edit', $user['student']['id']
                                ]);
                        }else{
                            return $this->redirect([
                                'controller' => 'Students', 
                                'action' => 'add', $user['id']
                            ]);
                        }
                    }else if($user['role'] === 'enterprise'){
                        $this->log($user);
                        if($user['enterprise']){
                            $this->log($user['enterprise']);
                            if($user['enterprise']['active'] == 0){
                                $this->log('REDIRECT:enterprise-edit');
                                return $this->redirect([
                                    'controller' => 'Enterprises', 
                                    'action' => 'edit', $user['enterprise']['id']
                                ]);
                            }

                        }else{
                            $this->log('REDIRECT:enterprise-add');
                            return $this->redirect([
                                'controller' => 'Enterprises', 
                                'action' => 'add', $user['id']
                            ]);
                        }
                    }
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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['index', 'view']);
        $this->Auth->allow(['resetPassword', 'sendPasswordLink']);
    }
    
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        $valide = false;

        
        // Les actions 'add' et 'tags' sont toujours autorisés pour les utilisateur
        // authentifiés sur l'application

        if (in_array($action, ['view'])) {
            $user_id = (int) $this->request->getParam('pass.0');
                    
            //Si user_id correspond au id de l'user courrant
            $valide = ($user['id'] == $user_id);
        }else 
        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {
            if(isset($user['role']) && $user['role'] === 'student'){
                        
                $user_id = (int) $this->request->getParam('pass.0');
                    
                //Si user_id correspond au id de l'user courrant
                $valide = ($user['id'] == $user_id);
            }    
        }else

        if (in_array($action, ['resetPassword'])) {
            $uuid = (int) $this->request->getParam('pass.0');
            $valide = true;

        }
        $this->log($action);
        return ($valide) ? $valide : parent::isAuthorized($user);
    }
    
}
