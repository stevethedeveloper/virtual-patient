<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vp Yields'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="vpYields form large-9 medium-8 columns content">
    <?= $this->Form->create($vpYield) ?>
    <fieldset>
        <legend><?= __('Add Vp Yield') ?></legend>
        <?php
            echo $this->Form->input('yield_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
