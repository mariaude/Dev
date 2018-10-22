<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 *
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
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
        $students = $this->paginate($this->Students);
        
        $this->set(compact('students'));
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $student = $this->Students->get($id, [
            'contain' => ['Users']
        ]);
        

        $this->set('student', $student);
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
        $student = $this->Students->newEntity();
        
        if ($this->request->is('post') && isset($user_id)) {
            $student->user_id = $user_id;
            $logged_user = $this->request->getSession()->read('Auth.User');
            if($logged_user['role'] == 'admin'){
                $student = $this->Students->patchEntity($student, $this->request->getData(), ['validate'=> 'admin']);
            } else {
                $student = $this->Students->patchEntity($student, $this->request->getData());
            }
            

            $this->log('student');
            $this->log($student->errors());

            //$this->patchStudentInfos($student);
            //debug($student);
            $res = $this->Students->save($student);

            $this->log($res);
            if ($res) {
                $this->patchStudentInfos($student);
                if ($this->Students->save($student)) {
                    $this->Flash->success(__('The student has been saved.'));
                    $this->redirect([
                        'controller' => 'Users', 
                        'action' => 'confirmStudent', $user_id
                    ]);
                    echo 'test';
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $this->set(compact('student', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());

            /* Modification */
            //$this->patchStudentInfos($student);
            
            if ($this->Students->save($student)) {

                $this->patchStudentInfos($student);
                if ($this->Students->save($student)) {
                    $this->Flash->success(__('The student has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $this->set(compact('student', 'users'));
    }

    public function patchStudentInfos($student = null){
        if($student != null){
            $student->phone_number = AppController::separatePhoneNumber($student->phone_number);
            $student->first_name = ucfirst($student->first_name);
            $student->last_name = ucfirst($student->last_name);
            $student->informations = ucfirst($student->informations);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
        

        $action = $this->request->getParam('action');
        // View toujour vrai

        $valide = false;

        if (in_array($action, ['view'])) {
            
            $valide = true;
        }

        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {

            if(isset($user['role']) && $user['role'] === 'student'){
                $student_id = (int) $this->request->getParam('pass.0');
                $student = $this->Students->get($student_id);
                
                //Si user_id du student correspond au id de l'user courrant
                if($student['user_id'] == $user['id']){
                    $valide = true;
                }
                $valide = false;
            }    
        }

        if (in_array($action, ['delete'])) {
            $valide = false;
        }

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'toBeStudent') {
             $valide = true;
        }

        return ($valide) ? $valide : parent::isAuthorized($user);


    }
}
