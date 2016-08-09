<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pageType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pageType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Page Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Content Pages'), ['controller' => 'ContentPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Page'), ['controller' => 'ContentPages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pageTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($pageType) ?>
    <fieldset>
        <legend><?= __('Edit Page Type') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('display_order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
