<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidacy[]|\Cake\Collection\CollectionInterface $candidacies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Candidacy'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Internships'), ['controller' => 'Internships', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Internship'), ['controller' => 'Internships', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="candidacies index large-9 medium-8 columns content">
    <h3><?= __('Candidacies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('internship_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidacies as $candidacy): ?>
            <tr>
                <td><?= $candidacy->has('internship') ? $this->Html->link($candidacy->internship->title, ['controller' => 'Internships', 'action' => 'view', $candidacy->internship->id]) : '' ?></td>
                <td><?= $candidacy->has('student') ? $this->Html->link($candidacy->student->full_name, ['controller' => 'Students', 'action' => 'view', $candidacy->student->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidacy->internship_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidacy->internship_id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidacy->internship_id)]) ?>
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
