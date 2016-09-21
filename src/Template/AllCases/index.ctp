<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="allCases index col-md-8 columns content">
    <h3><?= __('All Cases') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('slug') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allCases as $allCase): ?>
            <tr>
                <td><?= $this->Number->format($allCase->id) ?></td>
                <td><?= h($allCase->name) ?></td>
                <td><?= h($allCase->slug) ?></td>
                <td><?= h($allCase->created) ?></td>
                <td><?= h($allCase->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $allCase->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $allCase->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $allCase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allCase->id)]) ?>
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
