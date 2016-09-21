<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $generalSetting->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $generalSetting->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List General Settings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="generalSettings form large-9 medium-8 columns content">
    <?= $this->Form->create($generalSetting) ?>
    <fieldset>
        <legend><?= __('Edit General Setting') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id');
            echo $this->Form->input('settings_name');
            echo $this->Form->input('settings_value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
