<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
    </ul>
</nav>
<div class="users view large-10 medium-8 columns content">
    <h3><?= h($user->email) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <?php if($user->has('enterprise')):?>
            <tr>
                <th scope="row"><?= __('Enterprise') ?></th>
                <td><?= $user->has('enterprise') ? $this->Html->link($user->enterprise->name, ['controller' => 'Enterprises', 'action' => 'view', $user->enterprise->id]) : '' ?></td>
            </tr>
        <?php endif;?>
        <?php if($user->has('student')):?>
            <tr>
                <th scope="row"><?= __('Student') ?></th>
                <td><?= $user->has('student') ? $this->Html->link($user->student->full_name, ['controller' => 'Students', 'action' => 'view', $user->student->id]) : '' ?></td>
            </tr>
        <?php endif;?>
    </table>
</div>
