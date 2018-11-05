<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enterprise $enterprise
 */
?>
<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $enterprise->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $enterprise->id)]
            )
        ?></li>
    </ul>
</nav>
<div class="enterprises form large-10 medium-8 columns content">
    <?= $this->Form->create($enterprise) ?>
    <fieldset>
        <legend><?= __('Edit Enterprise') ?></legend>
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
?>
        <table>
            <tr>
                <th>Type de clientèle</th>
                <th>Missions du milieu</th> 
            </tr>
            <tr>
                <td>
                    <?=$this->Form->control('client_types._ids', [
                        'type' => 'select', 
                        'multiple'=> 'checkbox', 
                        'label' => "Type de clientèle",
                        'options' => $client_types,
                        'label' => ""
                    ]);?>
                </td>
                <td>
                    <?= $this->Form->control('missions._ids', [
                        'type' => 'select', 
                        'multiple'=> 'checkbox',
                        'label' => "Missions du milieu",
                        'options' => $missions,
                        'label' => ""
                    ]);?>
                </td> 
            </tr>
        </table>

<?php
            echo $this->Form->control('additional_informations');
            //echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
