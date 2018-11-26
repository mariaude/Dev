<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController {

    public function isAuthorized($user) {
        parent::isAuthorized($user);

        $action = $this->request->getParam('action');
        $this->log($user);
        if (isset($user['role']) && ( $user['role'] == "student"|| $user['role'] == "admin")) {
            if(in_array($action, ['add', 'view', 'edit', 'delete'])){
                return true;
            }
            return true;
        }
        /*
        // The edit and delete actions are allowed to logged in users for comments.
        if (in_array($action, ['add', 'edit', 'delete'])) {
            return true;
        }*/
        
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $logged_user = $this->request->getSession()->read('Auth.User');

        $this->paginate = [
            'contain' => ['Students']
        ];
        $files = $this->paginate($this->Files);

        if($logged_user["student"]){
            
            $query = $this->Files->find()->where(['student_id' => $logged_user["student"]["id"]]);
            $files = $this->paginate($query);
        }

        $this->set(compact('files'));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        
        $file = $this->Files->get($id, [
            'contain' => []
        ]);

        //return $this->request->redirect($this->webroot."/img/".$file->path . $file->name);

        $this->set('file', $file);
            
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            if (!empty($this->request->data['name']['name'])) {

                $file_pick = $this->request->data['name'];

                $fileName = $file_pick['name'];
                $uploadPath = 'Files/';
                $uploadFile = $uploadPath . $fileName;

                $user = TableRegistry::get('Users')->find()->where(['id =' => $this->request->getSession()->read('Auth.User.id')])->first();

                $file_explode = explode(".", $fileName);

                $extension = $file_explode[sizeof($file_explode) - 1];

                if (in_array($extension, array("docx", "pdf"))) {

                    if (move_uploaded_file($this->request->data['name']['tmp_name'], 'img/' . $uploadFile)) {

                        $file->name = $fileName;
                        $file->path = $uploadPath;
                        $file->student_id = $user->student->id;

                
                        if ($this->Files->save($file)) {
                            $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                        } else {
                            $this->Flash->error(__('Unable to upload file, please try again.'));
                        }
                        
                    }  else {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
   
                } else {
                    $this->Flash->error(__('Unable to save files of this type, please try again.'));
                }
            } else {
                $this->Flash->error(__('Please choose a file to upload.'));
            }
        }
        $this->set(compact('file'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $file = $this->Files->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $this->set(compact('file'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /*public function checkFileExtensions($ext){
        $bonneExtension = false;
        if ($ext == 'doc' || $ext == 'docx' || $ext == 'pdf'){
            $bonneExtension = true;
        } 
        return $bonneExtension;
    }*/

}
