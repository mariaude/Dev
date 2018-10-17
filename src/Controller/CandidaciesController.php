<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Candidacies Controller
 *
 * @property \App\Model\Table\CandidaciesTable $Candidacies
 *
 * @method \App\Model\Entity\Candidacy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidaciesController extends AppController
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
        $candidacies = $this->paginate($this->Candidacies);

        $this->set(compact('candidacies'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidacy id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidacy = $this->Candidacies->get($id, [
            'contain' => ['Internships', 'Students']
        ]);

        $this->set('candidacy', $candidacy);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidacy = $this->Candidacies->newEntity();
        if ($this->request->is('post')) {
            $candidacy = $this->Candidacies->patchEntity($candidacy, $this->request->getData());
            if ($this->Candidacies->save($candidacy)) {
                $this->Flash->success(__('The candidacy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidacy could not be saved. Please, try again.'));
        }
        $internships = $this->Candidacies->Internships->find('list', ['limit' => 200]);
        $students = $this->Candidacies->Students->find('list', ['limit' => 200]);
        $this->set(compact('candidacy', 'internships', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidacy id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidacy = $this->Candidacies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidacy = $this->Candidacies->patchEntity($candidacy, $this->request->getData());
            if ($this->Candidacies->save($candidacy)) {
                $this->Flash->success(__('The candidacy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidacy could not be saved. Please, try again.'));
        }
        $internships = $this->Candidacies->Internships->find('list', ['limit' => 200]);
        $students = $this->Candidacies->Students->find('list', ['limit' => 200]);
        $this->set(compact('candidacy', 'internships', 'students'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidacy id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidacy = $this->Candidacies->get($id);
        if ($this->Candidacies->delete($candidacy)) {
            $this->Flash->success(__('The candidacy has been deleted.'));
        } else {
            $this->Flash->error(__('The candidacy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
