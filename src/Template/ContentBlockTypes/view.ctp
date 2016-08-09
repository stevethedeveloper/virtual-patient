<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Content Block Type'), ['action' => 'edit', $contentBlockType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Content Block Type'), ['action' => 'delete', $contentBlockType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlockType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Content Block Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Block Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Content Blocks'), ['controller' => 'ContentBlocks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Block'), ['controller' => 'ContentBlocks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contentBlockTypes view large-9 medium-8 columns content">
    <h3><?= h($contentBlockType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($contentBlockType->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($contentBlockType->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($contentBlockType->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($contentBlockType->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Content Blocks') ?></h4>
        <?php if (!empty($contentBlockType->content_blocks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Page Id') ?></th>
                <th><?= __('Content Block Type Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Content') ?></th>
                <th><?= __('Configuration') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($contentBlockType->content_blocks as $contentBlocks): ?>
            <tr>
                <td><?= h($contentBlocks->id) ?></td>
                <td><?= h($contentBlocks->page_id) ?></td>
                <td><?= h($contentBlocks->content_block_type_id) ?></td>
                <td><?= h($contentBlocks->title) ?></td>
                <td><?= h($contentBlocks->content) ?></td>
                <td><?= h($contentBlocks->configuration) ?></td>
                <td><?= h($contentBlocks->created) ?></td>
                <td><?= h($contentBlocks->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ContentBlocks', 'action' => 'view', $contentBlocks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContentBlocks', 'action' => 'edit', $contentBlocks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContentBlocks', 'action' => 'delete', $contentBlocks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlocks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
