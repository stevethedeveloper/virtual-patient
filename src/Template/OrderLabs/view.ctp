<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Lab'), ['action' => 'edit', $orderLab->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Lab'), ['action' => 'delete', $orderLab->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderLab->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Labs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Lab'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderLabs view large-9 medium-8 columns content">
    <h3><?= h($orderLab->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Lab Id') ?></th>
            <td><?= h($orderLab->lab_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Lab Group') ?></th>
            <td><?= h($orderLab->lab_group) ?></td>
        </tr>
        <tr>
            <th><?= __('Feedback Only') ?></th>
            <td><?= h($orderLab->feedback_only) ?></td>
        </tr>
        <tr>
            <th><?= __('Media Type') ?></th>
            <td><?= h($orderLab->media_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Vid Ordered') ?></th>
            <td><?= h($orderLab->vid_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Vid Not Ordered') ?></th>
            <td><?= h($orderLab->vid_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Ordered') ?></th>
            <td><?= h($orderLab->pict_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Ordered Lg') ?></th>
            <td><?= h($orderLab->pict_ordered_lg) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Not Ordered') ?></th>
            <td><?= h($orderLab->pict_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Not Ordered Lg') ?></th>
            <td><?= h($orderLab->pict_not_ordered_lg) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($orderLab->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($orderLab->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Lab Order') ?></th>
            <td><?= $this->Number->format($orderLab->lab_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($orderLab->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($orderLab->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Lab') ?></h4>
        <?= $this->Text->autoParagraph(h($orderLab->lab)); ?>
    </div>
    <div class="row">
        <h4><?= __('Study Yield') ?></h4>
        <?= $this->Text->autoParagraph(h($orderLab->study_yield)); ?>
    </div>
    <div class="row">
        <h4><?= __('Result') ?></h4>
        <?= $this->Text->autoParagraph(h($orderLab->result)); ?>
    </div>
    <div class="row">
        <h4><?= __('Category') ?></h4>
        <?= $this->Text->autoParagraph(h($orderLab->category)); ?>
    </div>
    <div class="row">
        <h4><?= __('If Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($orderLab->if_ordered)); ?>
    </div>
    <div class="row">
        <h4><?= __('Not Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($orderLab->not_ordered)); ?>
    </div>
</div>
