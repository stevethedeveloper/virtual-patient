<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Video'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Content Pages'), ['controller' => 'ContentPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Page'), ['controller' => 'ContentPages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="videos index large-9 medium-8 columns content">
    <h3><?= __('Videos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('content_page_id') ?></th>
                <th><?= $this->Paginator->sort('video_url') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('display_order') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videos as $video): ?>
            <tr>
                <td><?= $this->Number->format($video->id) ?></td>
                <td><?= $video->has('content_page') ? $this->Html->link($video->content_page->title, ['controller' => 'ContentPages', 'action' => 'view', $video->content_page->id]) : '' ?></td>
                <td><?= h($video->video_url) ?></td>
                <td><?= h($video->title) ?></td>
                <td><?= $this->Number->format($video->display_order) ?></td>
                <td><?= h($video->created) ?></td>
                <td><?= h($video->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $video->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $video->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
