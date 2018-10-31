<?php
echo $student->full_name. ',<br/>';
echo sprintf("L'entreprise %s souhaitent vous convoquer suite a votre candidature sur l'offre de stage '%s' Veuillez contacter cette adresse courriel: %s.<br/>", 
$internship->enterprise->name, $internship->title, $internship->enterprise->user->email);


