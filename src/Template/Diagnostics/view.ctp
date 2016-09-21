<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Diagnostic'), ['action' => 'edit', $diagnostic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Diagnostic'), ['action' => 'delete', $diagnostic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagnostic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Diagnostics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diagnostic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="diagnostics view large-9 medium-8 columns content">
    <h3><?= h($diagnostic->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dd Id') ?></th>
            <td><?= h($diagnostic->dd_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Diag Id') ?></th>
            <td><?= h($diagnostic->diag_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($diagnostic->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($diagnostic->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Dd Order') ?></th>
            <td><?= $this->Number->format($diagnostic->dd_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Diag Order') ?></th>
            <td><?= $this->Number->format($diagnostic->diag_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($diagnostic->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($diagnostic->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Diagnosis Name') ?></h4>
        <?= $this->Text->autoParagraph(h($diagnostic->diagnosis_name)); ?>
    </div>
</div>
