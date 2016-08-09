<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page Type'), ['action' => 'edit', $pageType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page Type'), ['action' => 'delete', $pageType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Page Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Content Pages'), ['controller' => 'ContentPages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Page'), ['controller' => 'ContentPages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pageTypes view large-9 medium-8 columns content">
    <h3><?= h($pageType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($pageType->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($pageType->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Display Order') ?></th>
            <td><?= $this->Number->format($pageType->display_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($pageType->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($pageType->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Content Pages') ?></h4>
        <?php if (!empty($pageType->content_pages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Page Type Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Controller') ?></th>
                <th><?= __('Action') ?></th>
                <th><?= __('Prefix') ?></th>
                <th><?= __('Configuration') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pageType->content_pages as $contentPages): ?>
            <tr>
                <td><?= h($contentPages->id) ?></td>
                <td><?= h($contentPages->page_type_id) ?></td>
                <td><?= h($contentPages->title) ?></td>
                <td><?= h($contentPages->controller) ?></td>
                <td><?= h($contentPages->action) ?></td>
                <td><?= h($contentPages->prefix) ?></td>
                <td><?= h($contentPages->configuration) ?></td>
                <td><?= h($contentPages->created) ?></td>
                <td><?= h($contentPages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ContentPages', 'action' => 'view', $contentPages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContentPages', 'action' => 'edit', $contentPages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContentPages', 'action' => 'delete', $contentPages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentPages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
