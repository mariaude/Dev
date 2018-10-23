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

        $valide = false;
        if(isset($user['role']) && $user['role'] === 'enterprise' && $user['enterprise'] ) {
            $valide =  true;  
        }

        return ($valide) ? $valide : parent::isAuthorized($user);
        
      }
    
   }
   
?>