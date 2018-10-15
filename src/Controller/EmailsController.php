<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Mailer\Email;
   use Cake\ORM\Entity;

   class EmailsController extends AppController{

      public function index(){
         $email = new Email('default');
         $loguser = $this->request->getSession()->read('Auth.User');
        
         $email->to($loguser['email'])->subject('About')->send('My message');
      }


      // Notifier employeur candidature
      public function notifierEmployeur_nouvelleCandidature($user = null){
        // Le code ci dessous n'est pas fonctionnel.
        $email = new Email('default');
        //$email->viewVars(['user' => $user]);
        
        $email
        ->template('employeur_nouvelleCandidature', 'default')
        ->emailFormat('html')
        ->to($user['email'])
        ->subject('Nouvelle candidature')
        ->send();
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


   }
   
?>