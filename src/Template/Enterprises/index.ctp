<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enterprise[]|\Cake\Collection\CollectionInterface $enterprises
 */
?>
<div class="enterprises index columns content">
    <h3><?= __('Enterprises') ?></h3>
    <?= 
    
    $this->Html->link(__('New Enterprise'), ['controller' => 'Users', 'action' => 'add']) 
    ?>
    <br/>
    <br/>
    <?= $this->Form->create()?>

        <h6 id="actionLabel">Options de filtrage</h6>
        <?= $this->Form->radio('active', 
            [
                ['value' => -1, 'text' => 'Toutes'],
                ['value' => 1, 'text' => 'Actives'],
                ['value' => 0, 'text' => 'Inactives'],
            ],
            ['multiple' => false,
            'value' => $active,
            'hiddenField' => false,
            'label' => 'Filtrer les entreprises...']
            );?>
        <?=  $this->Form->button(__('Filtrer'));?>
    <?= $this->Form->end() ?>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adress') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('province') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postal_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('region') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_informations') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enterprises as $enterprise): ?>
            <tr>
                <td><?= $enterprise->has('user') ? $this->Html->link($enterprise->user->email, ['controller' => 'Users', 'action' => 'view', $enterprise->user->id]) : '' ?></td>
                <td><?= h($enterprise->name) ?></td>
                <td><?= h($enterprise->adress) ?></td>
                <td><?= h($enterprise->city) ?></td>
                <td><?= h($enterprise->province) ?></td>
                <td><?= h($enterprise->postal_code) ?></td>
                <td><?= h($enterprise->region) ?></td>
                <td><?= h($enterprise->additional_informations) ?></td>
                <td><?= h($enterprise->active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $enterprise->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $enterprise->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $enterprise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enterprise->id)]) ?>
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
