<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Convocations Controller
 *
 * @property \App\Model\Table\ConvocationsTable $Convocations
 *
 * @method \App\Model\Entity\Convocation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConvocationsController extends AppController
{

    public function isAuthorized($user){

        //$action = $this->­request->­getParam('action');

        $valide = true;
        return ($valide) ? $valide : parent::isAuthorized($user);
        
      }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Internships', 'Students']
        ];
        $convocations = $this->paginate($this->Convocations);

        $this->set(compact('convocations'));
    }

    /**
     * View method
     *
     * @param string|null $id Convocation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $convocation = $this->Convocations->get($id, [
            'contain' => ['Internships', 'Students']
        ]);

        $this->set('convocation', $convocation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if ($this->request->is('post')) {
            $convocation = $this->Convocations->newEntity($this->request->getData());

            if ($this->Convocations->save($convocation)) {
                $this->Flash->success(__('La convocation a été envoyée'));
                return $this->redirect(['controller' => 'Emails', 'action' => 'notifierEtudiantConvocation', $convocation->student_id]);
                //return $this->redirect($this->request->referer());
            }
            $this->Flash->error(__("La convocation n'a pas pu être envoyée. Réessayer, s'il vous plaît."));
            return $this->redirect($this->request->referer());
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Convocation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $convocation = $this->Convocations->newEntity($this->request->getData());
            if ($this->Convocations->save($convocation)) {
                $this->Flash->success(__('La convocation a été renvoyée'));

                return $this->redirect($this->request->referer());
            }
            $this->Flash->error(__("La convocation n'a pas pu être renvoyée. Réessayer, s'il vous plaît."));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Convocation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $convocation = $this->Convocations->get($id);
        if ($this->Convocations->delete($convocation)) {
            $this->Flash->success(__('The convocation has been deleted.'));
        } else {
            $this->Flash->error(__('The convocation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
