<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<div class="students form columns content">
<?= $this->Form->create(null, ['url' => ['controller' => 'Students', 'action' => 'add', $user_id]]) ?>
    <fieldset>
        <legend><?= __('Complete Student info') ?></legend>
        <?php
            echo $this->Form->control('admission_number');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('phone_number');
            echo $this->Form->control('informations');
            if($this->request->getSession()->read('Auth.User.role') == "admin"){
                echo $this->Form->control('notes');
                echo $this->Form->control('active', ['label'=> "Active", 'type'=>"checkbox"]);
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
