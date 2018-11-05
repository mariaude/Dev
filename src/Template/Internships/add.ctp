<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Internship $internship
 */
?>
<div class="internships form large-9 medium-8 columns content">
    <?= $this->Form->create($internship)?>
    <fieldset>
        <legend><?= __('Add Internship') ?></legend>
        <?php
            $options = [
                'autumn' => 'Autumn',
                'winter' => 'Winter',
            ];
            echo 'Semester';
            echo $this->Form->select('semester', $options);
            echo $this->Form->control('start_date');
            echo $this->Form->control('end_date');
            echo $this->Form->control('available_places');
            echo $this->Form->control('work_hours');
            echo $this->Form->control('title');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
