<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="allCases form large-9 medium-8 columns content">
    <?= $this->Form->create($allCase) ?>
    <fieldset>
        <legend><?= __('Add All Case') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('slug');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
