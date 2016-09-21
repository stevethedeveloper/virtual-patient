<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit History Question'), ['action' => 'edit', $historyQuestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete History Question'), ['action' => 'delete', $historyQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historyQuestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List History Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New History Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Videos'), ['controller' => 'Videos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Video'), ['controller' => 'Videos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="historyQuestions view large-9 medium-8 columns content">
    <h3><?= h($historyQuestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Question Id') ?></th>
            <td><?= h($historyQuestion->question_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Video') ?></th>
            <td><?= $historyQuestion->has('video') ? $this->Html->link($historyQuestion->video->id, ['controller' => 'Videos', 'action' => 'view', $historyQuestion->video->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Question Category') ?></th>
            <td><?= h($historyQuestion->question_category) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($historyQuestion->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($historyQuestion->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Question Order') ?></th>
            <td><?= $this->Number->format($historyQuestion->question_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($historyQuestion->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($historyQuestion->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Question') ?></h4>
        <?= $this->Text->autoParagraph(h($historyQuestion->question)); ?>
    </div>
</div>
