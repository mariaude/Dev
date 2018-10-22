<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enterprise $enterprise
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Internships'), ['controller' => 'Internships', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="enterprises form large-9 medium-8 columns content">
<?= $this->Form->create(null, ['url' => ['controller' => 'Enterprises', 'action' => 'add', $user_id]]) ?>
    <fieldset>
        <legend><?= __('Complete enterprise info') ?></legend>
        <?php
        
            echo $this->Form->control('name');
            echo $this->Form->control('adress');
            echo $this->Form->control('city');
            echo $this->Form->control('province');
            echo $this->Form->control('postal_code');
            echo $this->Form->control('region');
            $options = [
                'autre' => 'Autre',
                'centreHospitalier' => 'Centre hospitalier',
                'centreReadaptation' => 'Centre de réadaptation',
                'cliniquePrivee' => 'Clinique privée',
                'chsld' => 'CHSLD',
                'clsc'  => 'CLSC'
            ];
            echo('Type');
            echo $this->Form->select('enterprise_type', $options);
            
            echo $this->Form->control('client_types._ids', [
                'type' => 'select', 
                'multiple'=> 'checkbox', 
                'label' => "Type de clientèle",
                'options' => $client_types
            ]);

            echo $this->Form->control('missions._ids', [
                'type' => 'select', 
                'multiple'=> 'checkbox',
                'label' => "Missions du milieu",
                'options' => $missions
            ]);
            
            echo $this->Form->control('additional_informations');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
