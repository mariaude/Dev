<?php
echo 'Bonjour, '. $student->full_name . ',<br/>';
echo sprintf("L'entreprise %s ont ouvert une nouvelle offre de stage.<br/>", $internship->enterprise->name);

echo $this->Html->link("Consulter l'offre", ['controller' => 'Internships', 'action' => 'view', $internship->id, '_full' => true]);

