<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $historyQuestion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $historyQuestion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List History Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Videos'), ['controller' => 'Videos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Video'), ['controller' => 'Videos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="historyQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($historyQuestion) ?>
    <fieldset>
        <legend><?= __('Edit History Question') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id');
            echo $this->Form->input('question_id');
            echo $this->Form->input('video_id', ['options' => $videos]);
            echo $this->Form->input('question_order');
            echo $this->Form->input('question');
            echo $this->Form->input('question_category');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
