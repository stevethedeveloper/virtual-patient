<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Video'), ['action' => 'edit', $video->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Video'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Videos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Video'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Content Pages'), ['controller' => 'ContentPages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Page'), ['controller' => 'ContentPages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="videos view large-9 medium-8 columns content">
    <h3><?= h($video->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Content Page') ?></th>
            <td><?= $video->has('content_page') ? $this->Html->link($video->content_page->title, ['controller' => 'ContentPages', 'action' => 'view', $video->content_page->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Video Url') ?></th>
            <td><?= h($video->video_url) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($video->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($video->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Display Order') ?></th>
            <td><?= $this->Number->format($video->display_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($video->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($video->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($video->description)); ?>
    </div>
</div>
