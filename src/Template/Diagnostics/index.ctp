<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Diagnostic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="diagnostics index large-9 medium-8 columns content">
    <h3><?= __('Diagnostics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('all_cases_id') ?></th>
                <th><?= $this->Paginator->sort('dd_id') ?></th>
                <th><?= $this->Paginator->sort('diag_id') ?></th>
                <th><?= $this->Paginator->sort('dd_order') ?></th>
                <th><?= $this->Paginator->sort('diag_order') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diagnostics as $diagnostic): ?>
            <tr>
                <td><?= $this->Number->format($diagnostic->id) ?></td>
                <td><?= $this->Number->format($diagnostic->all_cases_id) ?></td>
                <td><?= h($diagnostic->dd_id) ?></td>
                <td><?= h($diagnostic->diag_id) ?></td>
                <td><?= $this->Number->format($diagnostic->dd_order) ?></td>
                <td><?= $this->Number->format($diagnostic->diag_order) ?></td>
                <td><?= h($diagnostic->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $diagnostic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diagnostic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diagnostic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostic->id)]) ?>
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
