<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enterprise $enterprise
 */
?>
<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Enterprise'), ['action' => 'edit', $enterprise->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Enterprise'), ['action' => 'delete', $enterprise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enterprise->id)]) ?> </li>
    </ul>
</nav>
<div class="enterprises view large-10 medium-8 columns content">
    <h3><?= h($enterprise->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $enterprise->has('user') ? $this->Html->link($enterprise->user->email, ['controller' => 'Users', 'action' => 'view', $enterprise->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adress') ?></th>
            <td><?= h($enterprise->adress) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($enterprise->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Province') ?></th>
            <td><?= h($enterprise->province) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postal Code') ?></th>
            <td><?= h($enterprise->postal_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= h($enterprise->region) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enterprise Type') ?></th>
            <td><?= h($enterprise->enterprise_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $enterprise->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Additional Informations') ?></h4>
        <?= $this->Text->autoParagraph(h($enterprise->additional_informations)); ?>
    </div>
    <div class="related">
        <?php if (!empty($enterprise->client_types)): ?>
        <h4><?= __('Related Client Types') ?></h4>
            <ul>
                <?php foreach ($enterprise->client_types as $clientTypes): ?>
                    <li>
                        <?= $this->Html->link(h($clientTypes->name), ['controller' => 'ClientTypes', 'action' => 'view', $clientTypes->id]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="related">
        
        <?php if (!empty($enterprise->missions)): ?>
            <h4><?= __('Related Missions') ?></h4>
            <ul>
                <?php foreach ($enterprise->missions as $missions): ?>
                    <li>
                        <?= $this->Html->link(h($missions->name), ['controller' => 'Missions', 'action' => 'view', $missions->id]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="related">
        <?php if (!empty($enterprise->internships)): ?>
        <h4><?= __('Related Internships') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Enterprise Id') ?></th>
                <th scope="col"><?= __('Semester') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Available Places') ?></th>
                <th scope="col"><?= __('Work Hours') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($enterprise->internships as $internships): ?>
            <tr>
                <td><?= h($internships->id) ?></td>
                <td><?= h($internships->enterprise_id) ?></td>
                <td><?= h($internships->semester) ?></td>
                <td><?= h($internships->start_date) ?></td>
                <td><?= h($internships->end_date) ?></td>
                <td><?= h($internships->available_places) ?></td>
                <td><?= h($internships->work_hours) ?></td>
                <td><?= h($internships->title) ?></td>
                <td><?= h($internships->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Internships', 'action' => 'view', $internships->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Internships', 'action' => 'edit', $internships->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Internships', 'action' => 'delete', $internships->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internships->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
