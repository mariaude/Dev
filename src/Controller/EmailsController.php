<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Mailer\Email;
   use Cake\ORM\Entity;
   use Cake\ORM\TableRegistry;
   use Cake\I18n;

   class EmailsController extends AppController{

      public function index(){
         $email = new Email('default');
         $loguser = $this->request->getSession()->read('Auth.User');
        
         $email->to($loguser['email'])->subject('About')->send('My message');
      }


      // Notifier etudiant candidature
      public function notifierEtudiantsNouvelleOffreStage($id = null){
        // Le code ci dessous n'est pas fonctionnel.
        if($id != null){
          $users = TableRegistry::get('Users')->find();
          $internship = TableRegistry::get('Internships')->findById($id)->first();
          
          if($internship){
            $entreprise = TableRegistry::get('Enterprises')->findById($internship['enterprise_id'])->first();
            if($entreprise){

              $entreprise_name = $entreprise["name"];
              $enter_id = $entreprise["id"];
              foreach($users as $user){
                if($user->student){
                  
                  $full_name = $user->student->full_name;
                  $this->set(['full_name' => $full_name, 'enter_id' => $enter_id, 'entreprise_name' => $entreprise_name]);
                  
                  $email = new Email('default');
                  $email->to($user['email'])
                        ->template('etudiant_nouvelleOffre', 'default')
                        ->emailFormat('html')
                        ->viewVars(['full_name' => $full_name, 'enter_id' => $enter_id, 'entreprise_name' => $entreprise_name])
                        ->subject('Nouvelle offre de stage')
                        ->send();
                }
                
              }
            }
          }
          
          




        }
        
          return $this->redirect([
            'controller' => 'Internships', 
             'action' => 'index'
         ]);

      }
      
      public function notifierEmployeurPostulationEtudiant($id = null){

        if($id != null){
          $this->log($id);
          $users = TableRegistry::get('Users')->find();
          $internship = TableRegistry::get('Internships')->findById($id)->first();
          debug($internship);
          if($internship){
            $entreprise = TableRegistry::get('Enterprises')->findById($internship['enterprise_id'])->first();
            if($entreprise){

              $entreprise_name = $entreprise["name"];
              $enter_id = $entreprise["id"];
              $entrUserId = $entreprise['user_id'];
              foreach($users as $user){
                if($user ['id'] == $entrUserId){
                  //$this->set(['full_name' => $full_name, 'enter_id' => $enter_id, 'entreprise_name' => $entreprise_name]);
                  
                  $email = new Email('default');
                  $email->to($user['email'])
                        ->template('enterprise_nouvelle_postulation', 'default')
                        ->emailFormat('html')
                        //->viewVars(['full_name' => $full_name, 'enter_id' => $enter_id, 'entreprise_name' => $entreprise_name])
                        ->subject('Nouvelle application sur une offre de stage')
                        ->send();
                }       
              }
            }
          }
        }
          return $this->redirect([
            'controller' => 'Internships', 
             'action' => 'index'
         ]);
        
      }
      
      // Notifier employeur mettre à jour informations
      public function notifierEmployeur_miseAJourInformations(){
     
      if((time() - 3600*24*15) >= Time::now()){

      }


      }

      // Notifier candidat rencontre
      public function notifierEtudiantConvocation($id = null){
        if($id != null){
          $users = TableRegistry::get('Users')->find();
          $student = TableRegistry::get('Students')->findById($id)->first();

          if($student){
            $user = TableRegistry::get('Users')->findById($student['user_id'])->first();
            if($user){

              $student_name = $student["name"];
              $email = new Email('default');
              $email->to($user['email'])
                    ->template('convocation', 'default')
                    ->emailFormat('html')
                    ->viewVars(['name' => $student_name])
                    ->subject('Convocation')
                    ->send();
                }       
              }
            }
    
      
          return $this->redirect([
            'controller' => 'Internships', 
             'action' => 'index'
         ]);
      }

      public function isAuthorized($user){

        //$action = $this->­request->­getParam('action');

        $valide = false;
        if(isset($user['role']) && $user['role'] === 'enterprise' && $user['enterprise']) {
            $valide =  true;  
        } /*else if (in_array($action, ['notifier-employeur-postulation-etudiant']) && isset($user['role']) && $user['role'] === 'student' && $user['student']){
          $valide = true;
        }*/
        $valide = true;
        return ($valide) ? $valide : parent::isAuthorized($user);
        
      }
    
   }
   
?>