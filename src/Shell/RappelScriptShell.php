<?php
namespace App\Shell;
use Cake\Console\Shell;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
class ScriptShell extends Shell
{
    public function main()
    {
        $query = TableRegistry::get('Enterprises')->find()->where(['active' => 0])->contain(['Users']);

        $this->out('La requete a renvoyée ' . sizeof($query) . ' résultats.');
        foreach ($query as $enterprise){
            //Soyons certains que le user n'est pas effacé
            if($enterprise->user->email){
                $this->out($enterprise->user->email);

                $email = new Email('default');
                $email->setTo($enterprise->user->email)
                ->setTemplate('entreprise_rappel_mise_a_jour', 'default')
                ->setEmailFormat('html')
                ->setViewVars(['enterprise' => $enterprise])
                ->setSubject('Mettez a jour vos informations');

                try {
                    if ( $email->send() ) {
                        // Success
                        $this->out(sprintf("L'envoi d'un courriel à l'adresse %s (entreprise : %s) a été un succès.", $enterprise->user->email, $enterprise->name));
                    } else {
                        $this->out(sprintf("L'envoi d'un courriel à l'adresse %s (entreprise : %s) a échoué.", $enterprise->user->email, $enterprise->name));
                    }
                } catch ( Exception $e ) {
                    // Failure, with exception
                }
            }
        }
    }
}