<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Management Medication'), ['action' => 'edit', $managementMedication->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Management Medication'), ['action' => 'delete', $managementMedication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $managementMedication->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Management Medications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Management Medication'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="managementMedications view large-9 medium-8 columns content">
    <h3><?= h($managementMedication->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('All Case') ?></th>
            <td><?= $managementMedication->has('all_case') ? $this->Html->link($managementMedication->all_case->name, ['controller' => 'AllCases', 'action' => 'view', $managementMedication->all_case->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Medication Id') ?></th>
            <td><?= h($managementMedication->medication_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Medication Group') ?></th>
            <td><?= h($managementMedication->medication_group) ?></td>
        </tr>
        <tr>
            <th><?= __('Feedback Only') ?></th>
            <td><?= h($managementMedication->feedback_only) ?></td>
        </tr>
        <tr>
            <th><?= __('Study Yield') ?></th>
            <td><?= h($managementMedication->study_yield) ?></td>
        </tr>
        <tr>
            <th><?= __('Media Type') ?></th>
            <td><?= h($managementMedication->media_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Vid Ordered') ?></th>
            <td><?= h($managementMedication->vid_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Vid Not Ordered') ?></th>
            <td><?= h($managementMedication->vid_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Ordered') ?></th>
            <td><?= h($managementMedication->pict_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Ordered Lg') ?></th>
            <td><?= h($managementMedication->pict_ordered_lg) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Not Ordered') ?></th>
            <td><?= h($managementMedication->pict_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Not Ordered Lg') ?></th>
            <td><?= h($managementMedication->pict_not_ordered_lg) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($managementMedication->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Medication Order') ?></th>
            <td><?= $this->Number->format($managementMedication->medication_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($managementMedication->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($managementMedication->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Medication Text') ?></h4>
        <?= $this->Text->autoParagraph(h($managementMedication->medication_text)); ?>
    </div>
    <div class="row">
        <h4><?= __('If Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($managementMedication->if_ordered)); ?>
    </div>
    <div class="row">
        <h4><?= __('Not Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($managementMedication->not_ordered)); ?>
    </div>
</div>
