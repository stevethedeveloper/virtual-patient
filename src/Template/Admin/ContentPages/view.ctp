<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Content Page'), ['action' => 'edit', $contentPage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Content Page'), ['action' => 'delete', $contentPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentPage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Content Pages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Page'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contentPages view large-9 medium-8 columns content">
    <h3><?= h($contentPage->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Page Type') ?></th>
            <td><?= $contentPage->has('page_type') ? $this->Html->link($contentPage->page_type->name, ['controller' => 'PageTypes', 'action' => 'view', $contentPage->page_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($contentPage->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Controller') ?></th>
            <td><?= h($contentPage->controller) ?></td>
        </tr>
        <tr>
            <th><?= __('Action') ?></th>
            <td><?= h($contentPage->action) ?></td>
        </tr>
        <tr>
            <th><?= __('Prefix') ?></th>
            <td><?= h($contentPage->prefix) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($contentPage->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($contentPage->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($contentPage->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Configuration') ?></h4>
        <?= $this->Text->autoParagraph(h($contentPage->configuration)); ?>
    </div>
</div>
