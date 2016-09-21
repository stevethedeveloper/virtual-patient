<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Group Media'), ['action' => 'edit', $groupMedia->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Group Media'), ['action' => 'delete', $groupMedia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupMedia->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Group Medias'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group Media'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="groupMedias view large-9 medium-8 columns content">
    <h3><?= h($groupMedia->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Group Media Type') ?></th>
            <td><?= h($groupMedia->group_media_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Group Media Group') ?></th>
            <td><?= h($groupMedia->group_media_group) ?></td>
        </tr>
        <tr>
            <th><?= __('Group Media File') ?></th>
            <td><?= h($groupMedia->group_media_file) ?></td>
        </tr>
        <tr>
            <th><?= __('Group Media File Not Ordered') ?></th>
            <td><?= h($groupMedia->group_media_file_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($groupMedia->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($groupMedia->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($groupMedia->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($groupMedia->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Group Media Not Ordered Message') ?></h4>
        <?= $this->Text->autoParagraph(h($groupMedia->group_media_not_ordered_message)); ?>
    </div>
</div>
