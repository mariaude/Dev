<?php
   /*namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Mailer\Email;
   use Cake\ORM\Entity;
   use Cake\Event\Event;
   use Cake\ORM\TableRegistry;
   use Cake\I18n;
   
   
   $email = new Email('default');
   $email->to('allard.mathieu7@gmail.com')->subject('Spam')->send('My message');
*/

namespace App\Shell;
use Cake\Console\Shell;
use Cake\Mailer\Email;
class ScriptShell extends Shell
{
    public function main()
    {
        $this->out('Hello world.');
        $email = new Email('default');
        $email->setTo('allard.mathieu7@gmail.com')->setSubject('Spam')->send('My message');
    }
}