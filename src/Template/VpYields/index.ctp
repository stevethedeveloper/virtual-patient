<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vp Yield'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vpYields index large-9 medium-8 columns content">
    <h3><?= __('Vp Yields') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('yield_name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vpYields as $vpYield): ?>
            <tr>
                <td><?= h($vpYield->id) ?></td>
                <td><?= h($vpYield->yield_name) ?></td>
                <td><?= h($vpYield->created) ?></td>
                <td><?= h($vpYield->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vpYield->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vpYield->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vpYield->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vpYield->id)]) ?>
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
