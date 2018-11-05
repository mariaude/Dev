<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Convocation[]|\Cake\Collection\CollectionInterface $convocations
 */
?>
<div class="convocations index columns content">
    <h3><?= __('Convocations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('internship_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($convocations as $convocation): ?>
            <tr>
                <td><?= $convocation->has('internship') ? $this->Html->link($convocation->internship->title, ['controller' => 'Internships', 'action' => 'view', $convocation->internship->id]) : '' ?></td>
                <td><?= $convocation->has('student') ? $this->Html->link($convocation->student->full_name, ['controller' => 'Students', 'action' => 'view', $convocation->student->id]) : '' ?></td>
                <td><?= h($convocation->created) ?></td>
                <td><?= h($convocation->modified) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $convocation->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $convocation->student_id)]) ?>
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
