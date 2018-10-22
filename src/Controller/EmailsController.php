<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Mailer\Email;
   use Cake\ORM\Entity;
   use Cake\ORM\TableRegistry;

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
          $name = null;
          $users = TableRegistry::get('Users')->find();
          $loguser = $this->request->getSession()->read('Auth.User');
          $internships = TableRegistry::get('Internships')->find(); 
          
          foreach($internships as $internship){
            if($internship->id = $id){
               $name = $internship->title;
            }
          }
          foreach($users as $user){
            if($user->role = 'student'){
              $enterprise = $this->request->getSession()->read('Auth.User.enterprise.name');
              $email = new Email('default');
              $email ->to($user['email'])
                     ->subject('Nouvelle offre de stage')
                     ->send($enterprise . ' a créé une nouvelle offre de stage, ' . $name. '. Visitez le site pour en savoir plus.');
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

      }

      // Notifier candidat rencontre
      public function notifierEtudiant_convocation(){

      }

      // Notifier candidat offre
      public function notifierEtudiant_nouvelleOffre(){

      }

      public function isAuthorized($user){
          if(isset($user['role']) && $user['role'] === 'enterprise' ) {
            return true;  
        }
        
      }
    
   }
   
?>