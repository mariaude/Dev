<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
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
<div class="users form large-9 medium-8 columns content">
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
