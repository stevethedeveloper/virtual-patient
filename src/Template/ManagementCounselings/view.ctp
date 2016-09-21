<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Management Counseling'), ['action' => 'edit', $managementCounseling->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Management Counseling'), ['action' => 'delete', $managementCounseling->id], ['confirm' => __('Are you sure you want to delete # {0}?', $managementCounseling->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Management Counselings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Management Counseling'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="managementCounselings view large-9 medium-8 columns content">
    <h3><?= h($managementCounseling->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Counseling Id') ?></th>
            <td><?= h($managementCounseling->counseling_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Counseling Group') ?></th>
            <td><?= h($managementCounseling->counseling_group) ?></td>
        </tr>
        <tr>
            <th><?= __('Feedback Only') ?></th>
            <td><?= h($managementCounseling->feedback_only) ?></td>
        </tr>
        <tr>
            <th><?= __('Study Yield') ?></th>
            <td><?= h($managementCounseling->study_yield) ?></td>
        </tr>
        <tr>
            <th><?= __('Media Type') ?></th>
            <td><?= h($managementCounseling->media_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Vid Ordered') ?></th>
            <td><?= h($managementCounseling->vid_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Vid Not Ordered') ?></th>
            <td><?= h($managementCounseling->vid_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Ordered') ?></th>
            <td><?= h($managementCounseling->pict_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Ordered Lg') ?></th>
            <td><?= h($managementCounseling->pict_ordered_lg) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Not Ordered') ?></th>
            <td><?= h($managementCounseling->pict_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Not Ordered Lg') ?></th>
            <td><?= h($managementCounseling->pict_not_ordered_lg) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($managementCounseling->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($managementCounseling->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Counseling Order') ?></th>
            <td><?= $this->Number->format($managementCounseling->counseling_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($managementCounseling->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($managementCounseling->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Counseling Text') ?></h4>
        <?= $this->Text->autoParagraph(h($managementCounseling->counseling_text)); ?>
    </div>
    <div class="row">
        <h4><?= __('If Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($managementCounseling->if_ordered)); ?>
    </div>
    <div class="row">
        <h4><?= __('Not Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($managementCounseling->not_ordered)); ?>
    </div>
</div>
