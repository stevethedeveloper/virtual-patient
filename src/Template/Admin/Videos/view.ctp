<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Video'), ['action' => 'edit', $video->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Video'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Videos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Video'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List History Questions'), ['controller' => 'HistoryQuestions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New History Question'), ['controller' => 'HistoryQuestions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="videos view large-9 medium-8 columns content">
    <h3><?= h($video->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Video File Name') ?></th>
            <td><?= h($video->video_file_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Video Nice Name') ?></th>
            <td><?= h($video->video_nice_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($video->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($video->all_cases_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related History Questions') ?></h4>
        <?php if (!empty($video->history_questions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('All Cases Id') ?></th>
                <th><?= __('Question Id') ?></th>
                <th><?= __('Video Id') ?></th>
                <th><?= __('Question Order') ?></th>
                <th><?= __('Question') ?></th>
                <th><?= __('Question Category') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($video->history_questions as $historyQuestions): ?>
            <tr>
                <td><?= h($historyQuestions->id) ?></td>
                <td><?= h($historyQuestions->all_cases_id) ?></td>
                <td><?= h($historyQuestions->question_id) ?></td>
                <td><?= h($historyQuestions->video_id) ?></td>
                <td><?= h($historyQuestions->question_order) ?></td>
                <td><?= h($historyQuestions->question) ?></td>
                <td><?= h($historyQuestions->question_category) ?></td>
                <td><?= h($historyQuestions->created) ?></td>
                <td><?= h($historyQuestions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HistoryQuestions', 'action' => 'view', $historyQuestions->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'HistoryQuestions', 'action' => 'edit', $historyQuestions->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HistoryQuestions', 'action' => 'delete', $historyQuestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historyQuestions->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
