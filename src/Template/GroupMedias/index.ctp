<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Group Media'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="groupMedias index large-9 medium-8 columns content">
    <h3><?= __('Group Medias') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('all_cases_id') ?></th>
                <th><?= $this->Paginator->sort('group_media_type') ?></th>
                <th><?= $this->Paginator->sort('group_media_group') ?></th>
                <th><?= $this->Paginator->sort('group_media_file') ?></th>
                <th><?= $this->Paginator->sort('group_media_file_not_ordered') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupMedias as $groupMedia): ?>
            <tr>
                <td><?= $this->Number->format($groupMedia->id) ?></td>
                <td><?= $this->Number->format($groupMedia->all_cases_id) ?></td>
                <td><?= h($groupMedia->group_media_type) ?></td>
                <td><?= h($groupMedia->group_media_group) ?></td>
                <td><?= h($groupMedia->group_media_file) ?></td>
                <td><?= h($groupMedia->group_media_file_not_ordered) ?></td>
                <td><?= h($groupMedia->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $groupMedia->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $groupMedia->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $groupMedia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupMedia->id)]) ?>
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
