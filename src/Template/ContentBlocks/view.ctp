<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Content Block'), ['action' => 'edit', $contentBlock->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Content Block'), ['action' => 'delete', $contentBlock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Content Blocks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Block'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Content Block Types'), ['controller' => 'ContentBlockTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Block Type'), ['controller' => 'ContentBlockTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contentBlocks view large-9 medium-8 columns content">
    <h3><?= h($contentBlock->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Content Block Type') ?></th>
            <td><?= $contentBlock->has('content_block_type') ? $this->Html->link($contentBlock->content_block_type->name, ['controller' => 'ContentBlockTypes', 'action' => 'view', $contentBlock->content_block_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($contentBlock->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($contentBlock->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Page Id') ?></th>
            <td><?= $this->Number->format($contentBlock->page_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($contentBlock->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($contentBlock->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($contentBlock->content)); ?>
    </div>
    <div class="row">
        <h4><?= __('Configuration') ?></h4>
        <?= $this->Text->autoParagraph(h($contentBlock->configuration)); ?>
    </div>
</div>
