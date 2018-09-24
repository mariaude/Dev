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
    public function add()
    {
        $enterprise = $this->Enterprises->newEntity();
        if ($this->request->is('post')) {
            $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            $enterprise->user_id = $this->Auth->user('id');

            if ($this->Enterprises->save($enterprise)) {
                $this->Flash->success(__('The enterprise has been saved.'));

                $this->requestAction([
                    'controller' => 'Users', 
                    'action' => 'confirmEnterprise'
                ]);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enterprise could not be saved. Please, try again.'));
        }
        $users = $this->Enterprises->Users->find('list', ['limit' => 200]);
        $this->set(compact('enterprise', 'users'));
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
        $enterprise = $this->Enterprises->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            if ($this->Enterprises->save($enterprise)) {
                $this->Flash->success(__('The enterprise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enterprise could not be saved. Please, try again.'));
        }
        $users = $this->Enterprises->Users->find('list', ['limit' => 200]);
        $this->set(compact('enterprise', 'users'));
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
        // Les actions 'add' et 'tags' sont toujours autorisés pour les utilisateur
        // authentifiés sur l'application
        if (in_array($action, ['view'])) {
            return true;
        }

        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {
            
            if(isset($user['role']) && $user['role'] === 'enterprise'){
                $enterprise_id = (int) $this->request->params['pass'][0];
                
                $enterprise = $this->Enterprises->get($enterprise_id);
                
                //Si user_id de l'entreprise correspond au id de l'user courrant
                if($enterprise['user_id'] == $user['id']){
                    return true;
                }
                return false;
            }    
        }

        if (in_array($action, ['delete'])) {
            return false;
        }

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'toBeEnterprise') {
             return true;
        }
        
        return parent::isAuthorized($user);
    }
}
