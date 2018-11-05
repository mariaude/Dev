<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enterprise $enterprise
 */
?>
<div class="enterprises form columns content">
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
                        'options' => $client_types,
                        'label' => ""
                    ]);?>
                </td>
                <td>
                    <?= $this->Form->control('missions._ids', [
                        'type' => 'select', 
                        'multiple'=> 'checkbox',
                        'options' => $missions,
                        'label' => ""
                    ]);?>
                </td> 
            </tr>
        </table>

        <?php
            
            echo $this->Form->control('additional_informations');
            //echo $this->Form->control('active', ['label'=> "Active", 'type'=>"checkbox"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
