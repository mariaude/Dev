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
            if($logged_user['role'] == 'admin'){
                $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData(), ['validate'=> 'admin']);
            } else {
                $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            }
            
            
            $enterprise->user_id = $user_id;
            //debug($enterprise);
            //$client_id = $this->request->getData()['client_id'];
            //$mission_id = $this->request->getData()['mission_id'];
            //debug($enterprise);

            $this->log('$enterprise');
            $this->log($enterprise);
            $this->log('$this->request->getData()');
            $this->log($this->request->getData());
            if ($this->Enterprises->save($enterprise)) {

                /*if($client_id) {
                    $client_type_enterprise = TableRegistry::get('client_type_enterprise');
                    foreach ($client_id as $value) {
                        $ref = $client_type_enterprise->newEntity([
                            'enterprise_id' => $enterprise['id'],
                            'client_id' => $value
                        ]);
                        $client_type_enterprise->save($ref);
                    }
                }
                if($mission_id) {
                    $enterprise_mission = TableRegistry::get('enterprise_mission');
                    foreach ($mission_id as $value) {
                        $ref = $enterprise_mission->newEntity([
                            'enterprise_id' => $enterprise['id'],
                            'mission_id' => $value
                        ]);
                        $enterprise_mission->save($ref);
                    }
                }*/

                $this->Flash->success(__('The enterprise has been saved.'));
                $this->redirect([
                    'controller' => 'Users', 
                    'action' => 'confirmEnterprise', $user_id
                ]);
                echo 'test';
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
            $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());

            $this->log('$enterprise');
            $this->log($enterprise);
            $this->log('$this->request->getData()');
            $this->log($this->request->getData());
            if ($this->Enterprises->save($enterprise)) {
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
            
            if(isset($user['role']) && $user['role'] === 'enterprise'){
                $enterprise_id = (int) $this->request->getParam('pass.0');
                
                $enterprise = $this->Enterprises->get($enterprise_id);
                
                //Si user_id de l'entreprise correspond au id de l'user courrant
                if($enterprise['user_id'] == $user['id']){
                    $valide = true;
                }
                $valide = false;
            }    
        }

        if (in_array($action, ['delete'])) {
            $valide = false;
        }

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'toBeEnterprise') {
             $valide = true;
        }
        
        return ($valide) ? $valide : parent::isAuthorized($user);
    }
}
