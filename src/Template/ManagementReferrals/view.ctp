<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Management Referral'), ['action' => 'edit', $managementReferral->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Management Referral'), ['action' => 'delete', $managementReferral->id], ['confirm' => __('Are you sure you want to delete # {0}?', $managementReferral->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Management Referrals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Management Referral'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="managementReferrals view large-9 medium-8 columns content">
    <h3><?= h($managementReferral->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Referral Id') ?></th>
            <td><?= h($managementReferral->referral_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Referral Group') ?></th>
            <td><?= h($managementReferral->referral_group) ?></td>
        </tr>
        <tr>
            <th><?= __('Media Type') ?></th>
            <td><?= h($managementReferral->media_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Vid Not Ordered') ?></th>
            <td><?= h($managementReferral->vid_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Study Yield') ?></th>
            <td><?= h($managementReferral->study_yield) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Ordered') ?></th>
            <td><?= h($managementReferral->pict_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Pict Not Ordered') ?></th>
            <td><?= h($managementReferral->pict_not_ordered) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($managementReferral->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($managementReferral->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Referral Order') ?></th>
            <td><?= $this->Number->format($managementReferral->referral_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($managementReferral->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($managementReferral->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Referral Text') ?></h4>
        <?= $this->Text->autoParagraph(h($managementReferral->referral_text)); ?>
    </div>
    <div class="row">
        <h4><?= __('Vid Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($managementReferral->vid_ordered)); ?>
    </div>
    <div class="row">
        <h4><?= __('Media Lg') ?></h4>
        <?= $this->Text->autoParagraph(h($managementReferral->media_lg)); ?>
    </div>
    <div class="row">
        <h4><?= __('If Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($managementReferral->if_ordered)); ?>
    </div>
    <div class="row">
        <h4><?= __('Not Ordered') ?></h4>
        <?= $this->Text->autoParagraph(h($managementReferral->not_ordered)); ?>
    </div>
</div>
