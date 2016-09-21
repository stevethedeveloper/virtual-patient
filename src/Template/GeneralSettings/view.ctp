<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit General Setting'), ['action' => 'edit', $generalSetting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete General Setting'), ['action' => 'delete', $generalSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $generalSetting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List General Settings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New General Setting'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="generalSettings view large-9 medium-8 columns content">
    <h3><?= h($generalSetting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Settings Name') ?></th>
            <td><?= h($generalSetting->settings_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Settings Value') ?></th>
            <td><?= h($generalSetting->settings_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($generalSetting->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($generalSetting->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($generalSetting->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($generalSetting->modified) ?></td>
        </tr>
    </table>
</div>
