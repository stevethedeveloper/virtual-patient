<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Content Blocks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Content Block Types'), ['controller' => 'ContentBlockTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Block Type'), ['controller' => 'ContentBlockTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contentBlocks form large-9 medium-8 columns content">
    <?= $this->Form->create($contentBlock) ?>
    <fieldset>
        <legend><?= __('Add Content Block') ?></legend>
        <?php
            echo $this->Form->input('page_id');
            echo $this->Form->input('content_block_type_id', ['options' => $contentBlockTypes]);
            echo $this->Form->input('title');
            echo $this->Form->input('content');
            echo $this->Form->input('configuration');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
