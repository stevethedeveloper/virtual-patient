<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Content Block'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Content Block Types'), ['controller' => 'ContentBlockTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Block Type'), ['controller' => 'ContentBlockTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contentBlocks index large-9 medium-8 columns content">
    <h3><?= __('Content Blocks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('page_id') ?></th>
                <th><?= $this->Paginator->sort('content_block_type_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contentBlocks as $contentBlock): ?>
            <tr>
                <td><?= $this->Number->format($contentBlock->id) ?></td>
                <td><?= $this->Number->format($contentBlock->page_id) ?></td>
                <td><?= $contentBlock->has('content_block_type') ? $this->Html->link($contentBlock->content_block_type->name, ['controller' => 'ContentBlockTypes', 'action' => 'view', $contentBlock->content_block_type->id]) : '' ?></td>
                <td><?= h($contentBlock->title) ?></td>
                <td><?= h($contentBlock->created) ?></td>
                <td><?= h($contentBlock->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contentBlock->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contentBlock->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contentBlock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
