<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Custom Page'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customPages index large-9 medium-8 columns content">
    <h3><?= __('Custom Pages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('all_cases_id') ?></th>
                <th><?= $this->Paginator->sort('pages_title') ?></th>
                <th><?= $this->Paginator->sort('pages_order') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customPages as $customPage): ?>
            <tr>
                <td><?= $this->Number->format($customPage->id) ?></td>
                <td><?= $this->Number->format($customPage->all_cases_id) ?></td>
                <td><?= h($customPage->pages_title) ?></td>
                <td><?= $this->Number->format($customPage->pages_order) ?></td>
                <td><?= h($customPage->created) ?></td>
                <td><?= h($customPage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customPage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customPage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customPage->id)]) ?>
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
