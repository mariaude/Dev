<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Enterprises Controller
 *
 * @property \App\Model\Table\EnterprisesTable $Enterprises
 *
 * @method \App\Model\Entity\Enterprise[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnterprisesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $enterprises = $this->paginate($this->Enterprises);

        $this->set(compact('enterprises'));
    }

    /**
     * View method
     *
     * @param string|null $id Enterprise id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enterprise = $this->Enterprises->get($id, [
            'contain' => ['Users', 'Internships']
        ]);

        $this->set('enterprise', $enterprise);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        //debug($user_id);
        $this->set('user_id', $user_id);
        $enterprise = $this->Enterprises->newEntity();
        
        if ($this->request->is('post') && isset($user_id)) {
            $logged_user = $this->request->getSession()->read('Auth.User');

            $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            $est_valide = ( $enterprise->errors() == null) ? 1 : 0;


            if($logged_user['role'] == 'admin'){
                $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData(), ['validate'=> 'admin']);
            } else {
                $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            }
            
            $enterprise->active = $est_valide;
            $enterprise->user_id = $user_id;

            if ($res = $this->Enterprises->save($enterprise)) {

                if($this->request->getSession()->read('Auth.User.id') == $res['user_id']){

                    $this->request->getSession()->write('Auth.User.enterprise', $enterprise);
                }
                $this->Flash->success(__('The enterprise has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enterprise could not be saved. Please, try again.'));
        }
        $users = $this->Enterprises->Users->find('list', ['limit' => 200]);
        $client_types = $this->Enterprises->ClientTypes->find('list', ['limit' => 200]);
        $missions = $this->Enterprises->Missions->find('list', ['limit' => 200]);
        
        $this->set(compact('enterprise', 'users', 'client_types', 'missions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Enterprise id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)

    {
        /*
        $enterprise = $this->Enterprises->get($id, [
            'contain' => ['client_types', 'missions']
        ]);*/

        $enterprise = $this->Enterprises
        ->findById($id)
        ->contain('ClientTypes', 'Missions') // charge les Tags associés
        ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {


            $logged_user = $this->request->getSession()->read('Auth.User');

            $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            $est_valide = ( $enterprise->errors() == null) ? 1 : 0;

            if($logged_user['role'] == 'admin'){
                $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData(), ['validate'=> 'admin']);
            } else {
                $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            }

            $enterprise->active = $est_valide;

            if ($res = $this->Enterprises->save($enterprise)) {
                $this->Flash->success(__('The enterprise has been saved.'));

                if($this->request->getSession()->read('Auth.User.id') == $res['user_id']){

                    $this->request->getSession()->write('Auth.User.enterprise', $enterprise);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enterprise could not be saved. Please, try again.'));
        }
        $users = $this->Enterprises->Users->find('list', ['limit' => 200]);
        $client_types = $this->Enterprises->ClientTypes->find('list', ['limit' => 200]);
        $missions = $this->Enterprises->Missions->find('list', ['limit' => 200]);
        
        $this->set(compact('enterprise', 'users', 'client_types', 'missions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Enterprise id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enterprise = $this->Enterprises->get($id);
        if ($this->Enterprises->delete($enterprise)) {
            $this->Flash->success(__('The enterprise has been deleted.'));
        } else {
            $this->Flash->error(__('The enterprise could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        $valide = false;

        if (in_array($action, ['view'])) {
            $valide = true;
        }

        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {
            

            $enterprise_id = (int) $this->request->getParam('pass.0');
            $this->log($user['enterprise']['id']);
            
            //Si user_id de l'entreprise correspond au id de l'user courrant
            if(isset($user['role']) && $user['role'] === 'enterprise' && $user['enterprise']['id'] == $enterprise_id){
                
                $valide = true;
            }    
        }

        if (in_array($action, ['delete'])) {
            $valide = false;
        }

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'enterprise' && !$user['enterprise']) {
             $valide = true;
        }
        
        return ($valide) ? $valide : parent::isAuthorized($user);
    }
}
