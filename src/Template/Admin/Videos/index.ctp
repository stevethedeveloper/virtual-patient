<div class="videos index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Videos') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('video_file_name') ?></th>
                    <th colspan="2"><?= $this->Paginator->sort('video_nice_name') ?><div class="pull-right"><?= $this->Html->link(__('[Add Video]'), ['controller' => 'videos', 'action' => 'add', $case_id]) ?></div></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($videos as $video): ?>
                <tr>
                    <td><?= $this->Number->format($video->id) ?></td>
                    <td><?= h($video->video_file_name) ?></td>
                    <td><?= h($video->video_nice_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $video->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
    </table>
    <?php if ($this->Paginator->hasPage(2)) {?>
    <div class="paginator">
        <ul class="pagination">
            <li><?= $this->Paginator->prev('< ' . __('previous')) ?></li>
            <li><?//= $this->Paginator->numbers() ?></li>
            <li><?= $this->Paginator->next(__('next') . ' >') ?></li>
        </ul>
        <p>Page <?= $this->Paginator->counter() ?></p>
    </div>
    <?php }?>
</div>
