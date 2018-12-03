<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */
?>
<div class="students index columns content">
    <h3><?= __('Students') ?></h3>
    <?= $this->Html->link(__('New Student'), ['controller' => 'Users', 'action' => 'add']) ?>

    <?= $this->Form->create();?>
        <h6 id="actionLabel">Options de filtrage</h6>
        <?= $this->Form->radio('hired', 
            [
                ['value' => -1, 'text' => 'Tous les étudiants'],
                ['value' => 1, 'text' => 'Étudiants engagés'],
                ['value' => 0, 'text' => 'Étudiants non engagés'],
            ],
            ['multiple' => false,
            'value' => $hired,
            'hiddenField' => false,
            'label' => 'Filtrer les étudiants...']
            );?>
        <?=  $this->Form->button(__('Filtrer'));?>
    <?= $this->Form->end() ?>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('admission_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hired') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student->has('user') ? $this->Html->link($student->user->email, ['controller' => 'Users', 'action' => 'view', $student->user->id]) : '' ?></td>
                <td><?= h($student->admission_number) ?></td>
                <td><?= h($student->first_name) ?></td>
                <td><?= h($student->last_name) ?></td>
                <td><?= h($student->phone_number) ?></td>
                <td><?= h($student->active) ?></td>
                <td><?= h($student->hired) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $student->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
