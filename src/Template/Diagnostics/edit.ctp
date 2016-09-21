<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $diagnostic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostic->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Diagnostics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="diagnostics form large-9 medium-8 columns content">
    <?= $this->Form->create($diagnostic) ?>
    <fieldset>
        <legend><?= __('Edit Diagnostic') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id');
            echo $this->Form->input('dd_id');
            echo $this->Form->input('diag_id');
            echo $this->Form->input('dd_order');
            echo $this->Form->input('diag_order');
            echo $this->Form->input('diagnosis_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
