<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-6 medium-2 columns content" style="width: 100%; padding-right: 25%;padding-left: 25%;">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            $loguser = $this->request->getSession()->read('Auth.User');
            echo $this->Form->control('email');
            echo $this->Form->control('password');

            if(isset($loguser['role']) && $loguser['role'] === 'admin'){
                $options = [
                    'student' => 'Student',
                    'enterprise' => 'Enterprise',
                ];

                echo $this->Form->select('role', $options, [ 'label' => "Account type"]);
            }else{
                echo 'Account type: Student';
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
