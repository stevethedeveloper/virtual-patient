<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Content Page'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contentPages index large-9 medium-8 columns content">
    <h3><?= __('Content Pages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('page_type_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('controller') ?></th>
                <th><?= $this->Paginator->sort('action') ?></th>
                <th><?= $this->Paginator->sort('prefix') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contentPages as $contentPage): ?>
            <tr>
                <td><?= $this->Number->format($contentPage->id) ?></td>
                <td><?= $contentPage->has('page_type') ? $this->Html->link($contentPage->page_type->name, ['controller' => 'PageTypes', 'action' => 'view', $contentPage->page_type->id]) : '' ?></td>
                <td><?= h($contentPage->title) ?></td>
                <td><?= h($contentPage->controller) ?></td>
                <td><?= h($contentPage->action) ?></td>
                <td><?= h($contentPage->prefix) ?></td>
                <td><?= h($contentPage->created) ?></td>
                <td><?= h($contentPage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contentPage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contentPage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contentPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentPage->id)]) ?>
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
