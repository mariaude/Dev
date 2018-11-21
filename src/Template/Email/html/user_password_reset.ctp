<?php

if($user->student){
    $nom = $user->student->full_name;
}else if($user->enterprise){
    $nom = $user->enterprise->name;
}else{
    $nom = null;
}

echo sprintf("Bonjour, %s <br/>", $nom);
echo $this->Html->link("Cliquez sur ce lien afin réinitialiser votre mot de passe", ['controller' => 'Users', 'action' => 'resetPassword', $uuid, '_full' => true]);