<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New General Setting'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="generalSettings index large-9 medium-8 columns content">
    <h3><?= __('General Settings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('all_cases_id') ?></th>
                <th><?= $this->Paginator->sort('settings_name') ?></th>
                <th><?= $this->Paginator->sort('settings_value') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($generalSettings as $generalSetting): ?>
            <tr>
                <td><?= $this->Number->format($generalSetting->id) ?></td>
                <td><?= $this->Number->format($generalSetting->all_cases_id) ?></td>
                <td><?= h($generalSetting->settings_name) ?></td>
                <td><?= h($generalSetting->settings_value) ?></td>
                <td><?= h($generalSetting->created) ?></td>
                <td><?= h($generalSetting->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $generalSetting->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $generalSetting->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $generalSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $generalSetting->id)]) ?>
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
