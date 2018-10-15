<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Internships Controller
 *
 * @property \App\Model\Table\InternshipsTable $Internships
 *
 * @method \App\Model\Entity\Internship[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InternshipsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Enterprises']
        ];
        $internships = $this->paginate($this->Internships);

        $this->set(compact('internships'));
    }

    /**
     * View method
     *
     * @param string|null $id Internship id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $internship = $this->Internships->get($id, [
            'contain' => ['Enterprises']
        ]);

        $this->set('internship', $internship);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $enterprises = TableRegistry::get('Enterprises');
        $query = $enterprises->find()->select(['id'])->where(['user_id =' => $this->Auth->user('id')])->first();
        $enterprise_id = $query['id'];
        //$enterprise_id = $query->where(['user_id' => $this->Auth->user('id')]);
        $internship = $this->Internships->newEntity();
        if ($this->request->is('post')) {
            $internship = $this->Internships->patchEntity($internship, $this->request->getData());
            
            $internship->enterprise_id = $enterprise_id;

            if ($this->Internships->save($internship)) {
                $this->Flash->success(__('The internship has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The internship could not be saved. Please, try again.'));
        }
        $enterprises = $this->Internships->Enterprises->find('list', ['limit' => 200]);
        $this->set(compact('internship', 'enterprises'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Internship id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id)
    {
        $internship = $this->Internships->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $internship = $this->Internships->patchEntity($internship, $this->request->getData());
            if ($this->Internships->save($internship)) {
                $this->Flash->success(__('The internship has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The internship could not be saved. Please, try again.'));
        }
        $enterprises = $this->Internships->Enterprises->find('list', ['limit' => 200]);
        $this->set(compact('internship', 'enterprises'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Internship id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $internship = $this->Internships->get($id);
        if ($this->Internships->delete($internship)) {
            $this->Flash->success(__('The internship has been deleted.'));
        } else {
            $this->Flash->error(__('The internship could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny('view');
    }
    
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        $valide = false;
        // authentifiés sur l'application
        if (in_array($action, ['view'])) {


            $logged_user = $this->request->getSession()->read('Auth.User');

            if($logged_user["role"] == "student" ){
                $valide = true;
            }else if($logged_user["role"] == "enterprise"){
                //Recherche pour savoir si l'entreprise suivante est propriétaire

                $current_internship = $this->Internships->get((int) $this->request->getParam('pass.0'));

                $this->log('WOLOLO');
                $this->log($current_internship);

                $enterprises = TableRegistry::get('Enterprises');

                $enteprise_user = $enterprises->find()->where(['user_id' => $logged_user["id"]])->first();

                if($enteprise_user){
                    //Est entreprise
                    $this->log($enteprise_user);

                    if($enteprise_user['id'] == $current_internship['enterprise_id'])
                        $valide = true;

                }else{
                    $this->log('rien de trouvé');
                    $valide = false;
                }
             

            }



            
            

            



            


        }

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'enterprise') {
            $valide = true;
        }

        return ($valide) ? $valide : parent::isAuthorized($user);
    }
}
