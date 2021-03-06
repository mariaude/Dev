<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Mailer\Email;
   use Cake\ORM\Entity;
   use Cake\ORM\TableRegistry;
   use Cake\I18n;
   use Cake\Event\Event;

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
          $students = TableRegistry::get('Students')->find()->contain(['Users']);
          $internship = TableRegistry::get('Internships')->findById($id)->contain(['Enterprises'])->first();
          
          if($internship && $internship->enterprise){
              foreach($students as $student){
                if($student->user){
                  $email = new Email('default');
                  $email->setTo($student->user->email)
                        ->setTemplate('etudiant_nouvelle_offre', 'default')
                        ->setEmailFormat('html')
                        ->setViewVars(['student' => $student, 'internship' => $internship])
                        ->setSubject('Nouvelle offre de stage')
                        ->send();
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
          $internship = TableRegistry::get('Internships')->findById($id)->contain(['Enterprises' => ['Users']])->first();
          $this->log('NOUVELLE POSTULATION, ');
          $this->log($internship);
          if($internship->enterprise->user){
                $email = new Email('default');
                $email->setTo($internship->enterprise->user->email)
                    ->setTemplate('enterprise_nouvelle_postulation', 'default')
                    ->setEmailFormat('html')
                      ->setViewVars(['internship' => $internship])
                      ->setSubject('Nouvelle application sur une offre de stage')
                      ->send();
            }
          }
          return $this->redirect($this->request->referer());
        
      }
      
      // Notifier employeur mettre à jour informations
      public function envoyerRappelsEmployeurs($token = null){
        
        if($token == 'ee-22-211-3'){
          $this->log('envoyerRappelsEmployeurs');
          $query = TableRegistry::get('Enterprises')->find()->where(['active' => 0])->contain(['Users']);
          foreach ($query as $enterprise){
                              $this->log($enterprise->user->email);
              //Soyons certains que le user n'est pas effacé
              if($enterprise->user->email){
                  $email = new Email('default');
                  $email->setTo($enterprise->user->email)
                  ->setTemplate('entreprise_rappel_mise_a_jour', 'default')
                  ->setEmailFormat('html')
                  ->setViewVars(['enterprise' => $enterprise])
                  ->setSubject('Mettez a jour vos informations');
                  try {
                      if ( $email->send() ) {
                          // Success
                          $this->log(sprintf("L'envoi d'un courriel à l'adresse %s (entreprise : %s) a été un succès.", $enterprise->user->email, $enterprise->name));
                          
                      } else {
                          $this->log(sprintf("L'envoi d'un courriel à l'adresse %s (entreprise : %s) a échoué.", $enterprise->user->email, $enterprise->name));
                          
                      }
                      
                  } catch ( Exception $e ) {
                      // Failure, with exception
                      $this->log($e);
                }
              }
          }
        }
        return $this->redirect($this->request->referer());
      }

      // Notifier candidat rencontre
      public function notifierEtudiantConvocation($id = null){
        if($id != null){
          $student = TableRegistry::get('Students')->findById($id)->contain(['Users'])->first();
          $candidacy = TableRegistry::get('Candidacies')->findByStudentId($id)->first();
          
          if($candidacy){
            $internship = TableRegistry::get('Internships')->findById($candidacy->internship_id)->contain(['Enterprises' => ['Users']])->first();
          
            if($internship){
              $this->log('notifierEtudiantConvocation');
              $this->log($internship);
              $enterprise = TableRegistry::get('Enterprises')->findById($internship['enterprise_id'])->first();
              $enterprise_name = $enterprise["name"];
              $enterprise_user = TableRegistry::get('Users')->findById($enterprise['user_id'])->first();
              $enterprise_email = $enterprise_user['email'];
              

              if($student->user){
                  $email = new Email('default');
                  $email->to($student->user->email)
                        ->template('etudiant_convocation', 'default')
                        ->emailFormat('html')
                        ->viewVars(['student' => $student, 'internship' => $internship])
                        ->subject("Appel de convocation par une entreprise.")
                        ->send();
                    }       
                  }
                }
              }
            
          return $this->redirect([
            'controller' => 'Internships', 
             'action' => 'index'
         ]);
      }

      public function beforeFilter(Event $event)
      {
          parent::beforeFilter($event);
          $this->Auth->allow('envoyerRappelsEmployeurs');
      }

      public function isAuthorized($user){

        //$action = $this->­request->­getParam('action');

        $valide = false;
        if(isset($user['role']) && $user['role'] === 'enterprise' && $user['enterprise']) {
            $valide =  true;  
        }
        $valide = true;
        return ($valide) ? $valide : parent::isAuthorized($user);
        
      }
    
   }
   
?>