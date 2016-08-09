<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contentBlockType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlockType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Content Block Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Content Blocks'), ['controller' => 'ContentBlocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Block'), ['controller' => 'ContentBlocks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contentBlockTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($contentBlockType) ?>
    <fieldset>
        <legend><?= __('Edit Content Block Type') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
