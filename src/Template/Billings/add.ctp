<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Billings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Billings'), ['controller' => 'Billings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Billing'), ['controller' => 'Billings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="billings form large-9 medium-8 columns content">
    <?= $this->Form->create($billing) ?>
    <fieldset>
        <legend><?= __('Add Billing') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id', ['options' => $allCases]);
            echo $this->Form->input('billing_id');
            echo $this->Form->input('billing_text');
            echo $this->Form->input('billing_group');
            echo $this->Form->input('billing_order');
            echo $this->Form->input('media_type');
            echo $this->Form->input('media');
            echo $this->Form->input('media_not_ordered');
            echo $this->Form->input('media_lg');
            echo $this->Form->input('billing_yield');
            echo $this->Form->input('if_ordered');
            echo $this->Form->input('not_ordered');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
