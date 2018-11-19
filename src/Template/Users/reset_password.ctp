<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-10 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Resetting password') ?></legend>
        <?php
            echo $this->Form->control('password');
            echo $this->Form->control('password_confirm', [
                'type' => 'password',
                'templateVars' => ['help' => 'Confirm your new password']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
