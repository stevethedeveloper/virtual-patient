<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Management Referrals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="managementReferrals form large-9 medium-8 columns content">
    <?= $this->Form->create($managementReferral) ?>
    <fieldset>
        <legend><?= __('Add Management Referral') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id');
            echo $this->Form->input('referral_id');
            echo $this->Form->input('referral_text');
            echo $this->Form->input('referral_group');
            echo $this->Form->input('media_type');
            echo $this->Form->input('vid_ordered');
            echo $this->Form->input('vid_not_ordered');
            echo $this->Form->input('media_lg');
            echo $this->Form->input('study_yield');
            echo $this->Form->input('if_ordered');
            echo $this->Form->input('not_ordered');
            echo $this->Form->input('referral_order');
            echo $this->Form->input('pict_ordered');
            echo $this->Form->input('pict_not_ordered');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
