<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Internship $internship
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Internship'), ['action' => 'edit', $internship->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Internship'), ['action' => 'delete', $internship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internship->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Internships'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Internship'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Enterprise'), ['controller' => 'Enterprises', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="internships view large-9 medium-8 columns content">
    <h3><?= h($internship->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Enterprise') ?></th>
            <td><?= $internship->has('enterprise') ? $this->Html->link($internship->enterprise->name, ['controller' => 'Enterprises', 'action' => 'view', $internship->enterprise->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Semester') ?></th>
            <td><?= h($internship->semester) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Work Hours') ?></th>
            <td><?= h($internship->work_hours) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($internship->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($internship->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available Places') ?></th>
            <td><?= $this->Number->format($internship->available_places) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($internship->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($internship->end_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($internship->description)); ?>
    </div>
</div>