<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Page Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Content Pages'), ['controller' => 'ContentPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Page'), ['controller' => 'ContentPages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pageTypes index large-9 medium-8 columns content">
    <h3><?= __('Page Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('display_order') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pageTypes as $pageType): ?>
            <tr>
                <td><?= $this->Number->format($pageType->id) ?></td>
                <td><?= h($pageType->name) ?></td>
                <td><?= $this->Number->format($pageType->display_order) ?></td>
                <td><?= h($pageType->created) ?></td>
                <td><?= h($pageType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pageType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pageType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pageType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageType->id)]) ?>
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
