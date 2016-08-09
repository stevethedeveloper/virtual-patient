<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Videos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Content Pages'), ['controller' => 'ContentPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Page'), ['controller' => 'ContentPages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="videos form large-9 medium-8 columns content">
    <?= $this->Form->create($video) ?>
    <fieldset>
        <legend><?= __('Add Video') ?></legend>
        <?php
            echo $this->Form->input('content_page_id', ['options' => $contentPages]);
            echo $this->Form->input('video_url');
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('display_order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
