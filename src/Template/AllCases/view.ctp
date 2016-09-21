<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit All Case'), ['action' => 'edit', $allCase->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete All Case'), ['action' => 'delete', $allCase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allCase->id)]) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="allCases view large-9 medium-8 columns content">
    <h3><?= h($allCase->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($allCase->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($allCase->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($allCase->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($allCase->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($allCase->modified) ?></td>
        </tr>
    </table>
</div>
