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
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Enterprises') ?></h4>
        <?php if (!empty($user->enterprises)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Adress') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Province') ?></th>
                <th scope="col"><?= __('Postal Code') ?></th>
                <th scope="col"><?= __('Region') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->enterprises as $enterprises): ?>
            <tr>
                <td><?= h($enterprises->id) ?></td>
                <td><?= h($enterprises->user_id) ?></td>
                <td><?= h($enterprises->name) ?></td>
                <td><?= h($enterprises->adress) ?></td>
                <td><?= h($enterprises->city) ?></td>
                <td><?= h($enterprises->province) ?></td>
                <td><?= h($enterprises->postal_code) ?></td>
                <td><?= h($enterprises->region) ?></td>
                <td><?= h($enterprises->active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Enterprises', 'action' => 'view', $enterprises->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Enterprises', 'action' => 'edit', $enterprises->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Enterprises', 'action' => 'delete', $enterprises->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enterprises->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($user->students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Admission Number') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Phone Number') ?></th>
                <th scope="col"><?= __('Informations') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->students as $students): ?>
            <tr>
                <td><?= h($students->id) ?></td>
                <td><?= h($students->user_id) ?></td>
                <td><?= h($students->admission_number) ?></td>
                <td><?= h($students->first_name) ?></td>
                <td><?= h($students->last_name) ?></td>
                <td><?= h($students->phone_number) ?></td>
                <td><?= h($students->informations) ?></td>
                <td><?= h($students->notes) ?></td>
                <td><?= h($students->active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
