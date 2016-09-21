<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customPage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customPage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Custom Pages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customPages form large-9 medium-8 columns content">
    <?= $this->Form->create($customPage) ?>
    <fieldset>
        <legend><?= __('Edit Custom Page') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id');
            echo $this->Form->input('pages_title');
            echo $this->Form->input('pages_desc');
            echo $this->Form->input('pages_text');
            echo $this->Form->input('pages_order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
