<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Content Block Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Content Blocks'), ['controller' => 'ContentBlocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Block'), ['controller' => 'ContentBlocks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contentBlockTypes index large-9 medium-8 columns content">
    <h3><?= __('Content Block Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contentBlockTypes as $contentBlockType): ?>
            <tr>
                <td><?= $this->Number->format($contentBlockType->id) ?></td>
                <td><?= h($contentBlockType->name) ?></td>
                <td><?= h($contentBlockType->created) ?></td>
                <td><?= h($contentBlockType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contentBlockType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contentBlockType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contentBlockType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlockType->id)]) ?>
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
