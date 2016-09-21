<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $managementMedication->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $managementMedication->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Management Medications'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="managementMedications form large-9 medium-8 columns content">
    <?= $this->Form->create($managementMedication) ?>
    <fieldset>
        <legend><?= __('Edit Management Medication') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id', ['options' => $allCases]);
            echo $this->Form->input('medication_id');
            echo $this->Form->input('medication_order');
            echo $this->Form->input('medication_group');
            echo $this->Form->input('feedback_only');
            echo $this->Form->input('medication_text');
            echo $this->Form->input('study_yield');
            echo $this->Form->input('if_ordered');
            echo $this->Form->input('not_ordered');
            echo $this->Form->input('media_type');
            echo $this->Form->input('vid_ordered');
            echo $this->Form->input('vid_not_ordered');
            echo $this->Form->input('pict_ordered');
            echo $this->Form->input('pict_ordered_lg');
            echo $this->Form->input('pict_not_ordered');
            echo $this->Form->input('pict_not_ordered_lg');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
