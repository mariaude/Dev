<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Internship[]|\Cake\Collection\CollectionInterface $internships
 */
?>
<div class="internships index columns content">
    <h3><?= __('Internships') ?></h3>
    <?= $this->Html->link(__('New Internship'), ['controller' => 'Internships', 'action' => 'add']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('enterprise_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('semester') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('available_places') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_hours') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($internships as $internship): ?>
            <tr>
                <td><?= $internship->has('enterprise') ? $this->Html->link($internship->enterprise->name, ['controller' => 'Enterprises', 'action' => 'view', $internship->enterprise->id]) : '' ?></td>
                <td><?= h($internship->semester) ?></td>
                <td><?= h($internship->start_date) ?></td>
                <td><?= h($internship->end_date) ?></td>
                <td><?= $this->Number->format($internship->available_places) ?></td>
                <td><?= h($internship->work_hours) ?></td>
                <td><?= h($internship->title) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $internship->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $internship->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $internship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internship->id)]) ?>
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
