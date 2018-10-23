<!--EXAMPLE-->
<?php
echo $full_name. ',<br/>';
echo "L'entreprise ". $entreprise_name ." ont ouvert une nouvelle offre de stage.<br/>";

echo $this->Html->link("Consulter l'offre", ['controller' => 'Enterprises', 'action' => 'view', $enter_id, '_full' => true]);

