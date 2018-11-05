<!--EXAMPLE-->
<?php
echo sprintf("L'entreprise %s est présentement désactivée sur le site en raison d'informations incompletes.", $enterprise->name).'</br>';
echo $this->Html->link("Cliquez sur le lien suivant pour mettre à jours vos informations: ", ['controller' => 'Users', 'action' => 'login', '_full' => true]);

