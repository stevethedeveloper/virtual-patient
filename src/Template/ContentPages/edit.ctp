<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contentPage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contentPage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Content Pages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contentPages form large-9 medium-8 columns content">
    <?= $this->Form->create($contentPage) ?>
    <fieldset>
        <legend><?= __('Edit Content Page') ?></legend>
        <?php
            echo $this->Form->input('page_type_id', ['options' => $pageTypes]);
            echo $this->Form->input('title');
            echo $this->Form->input('controller');
            echo $this->Form->input('action');
            echo $this->Form->input('prefix');
            echo $this->Form->input('configuration');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
