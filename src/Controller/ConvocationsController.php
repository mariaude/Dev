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
        $convocation = $this->Convocations->newEntity();
        if ($this->request->is('post')) {
            $convocation = $this->Convocations->patchEntity($convocation, $this->request->getData());
            if ($this->Convocations->save($convocation)) {
                $this->Flash->success(__('The convocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The convocation could not be saved. Please, try again.'));
        }
        $internships = $this->Convocations->Internships->find('list', ['limit' => 200]);
        $students = $this->Convocations->Students->find('list', ['limit' => 200]);
        $this->set(compact('convocation', 'internships', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Convocation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $convocation = $this->Convocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $convocation = $this->Convocations->patchEntity($convocation, $this->request->getData());
            if ($this->Convocations->save($convocation)) {
                $this->Flash->success(__('The convocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The convocation could not be saved. Please, try again.'));
        }
        $internships = $this->Convocations->Internships->find('list', ['limit' => 200]);
        $students = $this->Convocations->Students->find('list', ['limit' => 200]);
        $this->set(compact('convocation', 'internships', 'students'));
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
