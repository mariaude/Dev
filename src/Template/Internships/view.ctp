<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Internship $internship
 */
?>
<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Internship'), ['action' => 'edit', $internship->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Internship'), ['action' => 'delete', $internship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internship->id)]) ?> </li>
        <br/>
    </ul>
</nav>
<div class="internships view large-10 medium-8 columns content">
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

    <?php if(isset($student_user)): // Student, possibilité de mettre une candidature
            if($already_applied): //Déja appliqué ?>
                <legend><?=__('Candidature déjà laissée')?>
            <?php else: //Jamais appliqué?>
                <?= $this->Form->create($candidacy, ['url' => ['controller' => 'Candidacies', 'action' => 'add']]) ?>
            <fieldset>
                <?php
                    echo $this->Form->hidden('student_id');
                    echo $this->Form->hidden('internship_id');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Envoyer candidature')) ?>
            <?= $this->Form->end() ?>
        <?php endif;
        endif;?>
</div>
