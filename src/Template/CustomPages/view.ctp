<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Custom Page'), ['action' => 'edit', $customPage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Custom Page'), ['action' => 'delete', $customPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customPage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Custom Pages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Custom Page'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customPages view large-9 medium-8 columns content">
    <h3><?= h($customPage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Pages Title') ?></th>
            <td><?= h($customPage->pages_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($customPage->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($customPage->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pages Order') ?></th>
            <td><?= $this->Number->format($customPage->pages_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($customPage->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($customPage->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Pages Desc') ?></h4>
        <?= $this->Text->autoParagraph(h($customPage->pages_desc)); ?>
    </div>
    <div class="row">
        <h4><?= __('Pages Text') ?></h4>
        <?= $this->Text->autoParagraph(h($customPage->pages_text)); ?>
    </div>
</div>
