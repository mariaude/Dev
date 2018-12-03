<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Routing\Router;

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
            'contain' => ['Users', 'Files']
        ];
        
        $students_query = $this->Students;

        if ($this->request->is('post')) {
            
            $students_query = $this->Students;

            $this->log($this->request->getData());
            $hired = $this->request->getData('hired');
            $this->log($hired);
            if($hired != -1){
                $this->log('filtre');
                $students_query = $students_query->find()->where(['hired' => $hired]);
                $this->log($students_query);
            }
        }

        $students = $this->paginate($students_query);

        $this->set(compact('students'));
    }

    public function setHiredOrNot($id = null){

        $student = $this->Students->get($id);
        $hired = $this->request->getData('hired');
        $this->log($this->request->getData());
        $student->hired = $hired;

        if ($this->Students->save($student)) {
            $this->Flash->success(__('The student has been saved.'));
            return $this->redirect($this->request->referer());
        }else{
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
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
            'contain' => ['Users', 'Files']
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
        /*$student = $this->Students->get($id, [
            'contain' => ['Files']
        ]);*/
        //debug($user_id);
        $this->set('user_id', $user_id);
        $student = $this->Students->newEntity();
        
        if ($this->request->is('post') && isset($user_id)) {
            $student->user_id = $user_id;

            $logged_user = $this->request->getSession()->read('Auth.User');
            $student = $this->Students->patchEntity($student, $this->request->getData());

            $est_valide = ( $student->errors() == null) ? 1 : 0;
            $this->log($student->errors());
            
            if($logged_user['role'] == 'admin'){
                $student = $this->Students->patchEntity($student, $this->request->getData(), ['validate'=> 'admin']);
            } else {
                $student = $this->Students->patchEntity($student, $this->request->getData());
            }
            
            $student->active = $est_valide;

            //$this->log('student');
            //$this->log($student->errors());

            //$this->patchStudentInfos($student);
            //debug($student);
            $res = $this->Students->save($student);

            $this->log($res);
            $this->patchStudentInfos($student);
            if ($res) {
                //$this->patchStudentInfos($student);
                if ($this->Students->save($student)) {
                    $this->Flash->success(__('The student has been saved.'));
                    
                    if($this->request->getSession()->read('Auth.User.id') == $res['user_id']){

                        $this->request->getSession()->write('Auth.User.student', $student);
                    }

                    return $this->redirect(Router::url('/', true));
                }
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $files = $this->Students->Files->find('list', ['limit' => 200]);
        $this->set(compact('student', 'users', 'files'));
        
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
            'contain' => ['Files']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        
            $logged_user = $this->request->getSession()->read('Auth.User');
            $student = $this->Students->patchEntity($student, $this->request->getData());

            $est_valide = ( $student->errors() == null) ? 1 : 0;

            if($logged_user['role'] == 'admin'){
                $student = $this->Students->patchEntity($student, $this->request->getData(), ['validate'=> 'admin']);
            } else {
                $student = $this->Students->patchEntity($student, $this->request->getData());
            }
            
            $student->active = $est_valide;

            /* Modification */
            $this->patchStudentInfos($student);
            
            if ($this->Students->save($student)) {

                //$this->patchStudentInfos($student);
                if ($res = $this->Students->save($student)) {
                    $this->Flash->success(__('The student has been saved.'));
                    if($this->request->getSession()->read('Auth.User.id') == $res['user_id']){

                        $this->request->getSession()->write('Auth.User.student', $student);
                    }
                    return $this->redirect(Router::url('/', true));
                }
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $files = $this->Students->Files->find('list', ['limit' => 200]);
        $this->set(compact('student', 'users','files'));
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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->deny(['index', 'view']);
    }
    
    public function isAuthorized($user)
    {
        

        $action = $this->request->getParam('action');
        // View toujour vrai

        $valide = false;
        if (in_array($action, ['view'])) {

            if($user['enterprise']){
                $valide = true;
            }else if($user['student']){
                $student_id = (int) $this->request->getParam('pass.0');

                $valide = ($user['student']['id'] == $student_id);
            }
        }else 
        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {


            $student_id = (int) $this->request->getParam('pass.0');

            //Si user_id du student correspond au id de l'user courrant
            if(isset($user['role']) && $user['role'] === 'student' && $user['student']['id'] == $student_id){
                
                $valide = true;
            }    
        }else

        if (in_array($action, ['delete'])) {
            $valide = false;
        }else

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'student' && !$user['student']) {
             $valide = true;
        }
        else

        if (in_array($action, ['setHiredOrNot']) && isset($user['role']) && $user['enterprise']) {
             $valide = true;
        }


        return ($valide) ? $valide : parent::isAuthorized($user);


    }
}
