<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vp Yield'), ['action' => 'edit', $vpYield->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vp Yield'), ['action' => 'delete', $vpYield->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vpYield->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vp Yields'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vp Yield'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vpYields view large-9 medium-8 columns content">
    <h3><?= h($vpYield->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= h($vpYield->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Yield Name') ?></th>
            <td><?= h($vpYield->yield_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($vpYield->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($vpYield->modified) ?></td>
        </tr>
    </table>
</div>
