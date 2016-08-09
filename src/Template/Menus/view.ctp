<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Parent Menu') ?></th>
            <td><?= $menu->has('parent_menu') ? $this->Html->link($menu->parent_menu->title, ['controller' => 'Menus', 'action' => 'view', $menu->parent_menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($menu->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($menu->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Controller') ?></th>
            <td><?= h($menu->controller) ?></td>
        </tr>
        <tr>
            <th><?= __('Action') ?></th>
            <td><?= h($menu->action) ?></td>
        </tr>
        <tr>
            <th><?= __('Prefix') ?></th>
            <td><?= h($menu->prefix) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Display Order') ?></th>
            <td><?= $this->Number->format($menu->display_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($menu->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($menu->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Menus') ?></h4>
        <?php if (!empty($menu->child_menus)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Display Order') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Controller') ?></th>
                <th><?= __('Action') ?></th>
                <th><?= __('Prefix') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menu->child_menus as $childMenus): ?>
            <tr>
                <td><?= h($childMenus->id) ?></td>
                <td><?= h($childMenus->parent_id) ?></td>
                <td><?= h($childMenus->display_order) ?></td>
                <td><?= h($childMenus->title) ?></td>
                <td><?= h($childMenus->url) ?></td>
                <td><?= h($childMenus->controller) ?></td>
                <td><?= h($childMenus->action) ?></td>
                <td><?= h($childMenus->prefix) ?></td>
                <td><?= h($childMenus->created) ?></td>
                <td><?= h($childMenus->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Menus', 'action' => 'view', $childMenus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Menus', 'action' => 'edit', $childMenus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menus', 'action' => 'delete', $childMenus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childMenus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
