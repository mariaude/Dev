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

        $logged_user = $this->request->getSession()->read('Auth.User');

        $this->paginate = [
            'contain' => ['Internships', 'Students']
        ];
        
        if($logged_user["role"] != "enterprise" || $logged_user["role"] != "student"){
            $candidacies = $this->paginate($this->Candidacies);
        }
        if($logged_user["enterprise"]){
        
            $query = $this->Candidacies->find()
            ->leftJoinWith('Internships')
            ->where(['Internships.enterprise_id =' => $logged_user["enterprise"]["id"]]);

            $candidacies = $this->paginate($query);
        }else if($logged_user["student"]){
            $query = $this->Candidacies->find()->where(['student_id' => $logged_user["student"]["id"]]);
            $candidacies = $this->paginate($query);
        }

        $this->set(compact('candidacies'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $student = $this->request->getSession()->read('Auth.User.student');


        if ($student && $this->request->is('post')) {
            debug($this->request->getData());

            $candidacy = $this->Candidacies->newEntity($this->request->getData());
        
            debug($candidacy);

            if ($this->Candidacies->save($candidacy)) {
                $this->Flash->success(__('The candidacy has been saved.'));
                return $this->redirect(['controller' => 'internships', 'action' => 'index']);
            }
            $this->Flash->error(__('The candidacy could not be saved. Please, try again.'));
            return $this->redirect(['controller' => 'internships', 'action' => 'index']);
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
    public function delete($student_id = null, $internship_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidacy = $this->Candidacies->find()
        ->where(['student_id' => $student_id, 'internship_id' => $internship_id])
        ->firstOrFail();

        if ($this->Candidacies->delete($candidacy)) {
            $this->Flash->success(__('The candidacy has been deleted.'));
        } else {
            $this->Flash->error(__('The candidacy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        $valide = false;

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'student') {
            $valide = true;
        }else if (in_array($action, ['delete']) && $user['student']) {
            $valide = true;
        }

        return ($valide) ? $valide : parent::isAuthorized($user);
    }
}
