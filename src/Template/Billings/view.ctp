<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Billing'), ['action' => 'edit', $billing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Billing'), ['action' => 'delete', $billing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $billing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Billings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Billing'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Billings'), ['controller' => 'Billings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Billing'), ['controller' => 'Billings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="billings view large-9 medium-8 columns content">
    <h3><?= h($billing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('All Case') ?></th>
            <td><?= $billing->has('all_case') ? $this->Html->link($billing->all_case->name, ['controller' => 'AllCases', 'action' => 'view', $billing->all_case->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Id') ?></th>
            <td><?= h($billing->billing_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Group') ?></th>
            <td><?= h($billing->billing_group) ?></td>
        </tr>
        <tr>
            <th><?= __('Media Type') ?></th>
            <td><?= h($billing->media_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Media Not Ordered') ?></th>
            <td><?= h($billing->media_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Yield') ?></th>
            <td><?= h($billing->billing_yield) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($billing->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Order') ?></th>
            <td><?= $this->Number->format($billing->billing_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($billing->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($billing->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Billing Text') ?></h4>
        <?= $this->Text->autoParagraph(h($billing->billing_text)); ?>
    </div>
    <div class="row">
        <h4><?= __('Media') ?></h4>
        <?= $this->Text->autoParagraph(h($billing->media)); ?>
    </div>
    <div class="row">
        <h4><?= __('Media Lg') ?></h4>
        <?= $this->Text->autoParagraph(h($billing->media_lg)); ?>
    </div>
    <div class="row">
        <h4><?= __('If Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($billing->if_ordered)); ?>
    </div>
    <div class="row">
        <h4><?= __('Not Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($billing->not_ordered)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Billings') ?></h4>
        <?php if (!empty($billing->billings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('All Cases Id') ?></th>
                <th><?= __('Billing Id') ?></th>
                <th><?= __('Billing Text') ?></th>
                <th><?= __('Billing Group') ?></th>
                <th><?= __('Billing Order') ?></th>
                <th><?= __('Media Type') ?></th>
                <th><?= __('Media') ?></th>
                <th><?= __('Media Not Ordered') ?></th>
                <th><?= __('Media Lg') ?></th>
                <th><?= __('Billing Yield') ?></th>
                <th><?= __('If Ordered') ?></th>
                <th><?= __('Not Ordered') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($billing->billings as $billings): ?>
            <tr>
                <td><?= h($billings->id) ?></td>
                <td><?= h($billings->all_cases_id) ?></td>
                <td><?= h($billings->billing_id) ?></td>
                <td><?= h($billings->billing_text) ?></td>
                <td><?= h($billings->billing_group) ?></td>
                <td><?= h($billings->billing_order) ?></td>
                <td><?= h($billings->media_type) ?></td>
                <td><?= h($billings->media) ?></td>
                <td><?= h($billings->media_not_ordered) ?></td>
                <td><?= h($billings->media_lg) ?></td>
                <td><?= h($billings->billing_yield) ?></td>
                <td><?= h($billings->if_ordered) ?></td>
                <td><?= h($billings->not_ordered) ?></td>
                <td><?= h($billings->created) ?></td>
                <td><?= h($billings->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Billings', 'action' => 'view', $billings->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Billings', 'action' => 'edit', $billings->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Billings', 'action' => 'delete', $billings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $billings->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
