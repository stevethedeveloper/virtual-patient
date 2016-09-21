<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Group Medias'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="groupMedias form large-9 medium-8 columns content">
    <?= $this->Form->create($groupMedia) ?>
    <fieldset>
        <legend><?= __('Add Group Media') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id');
            echo $this->Form->input('group_media_type');
            echo $this->Form->input('group_media_group');
            echo $this->Form->input('group_media_file');
            echo $this->Form->input('group_media_file_not_ordered');
            echo $this->Form->input('group_media_not_ordered_message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
