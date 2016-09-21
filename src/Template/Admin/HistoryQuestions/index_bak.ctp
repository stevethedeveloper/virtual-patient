<div class="allCases index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('History Questions') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('HistoryQuestions.id', ['label' => 'ID']) ?></th>
                    <th><?= $this->Paginator->sort('HistoryQuestions.question', ['label' => 'Question']) ?></th>
                    <th><?= $this->Paginator->sort('HistoryQuestionsGroups.name', ['label' => 'Group']) ?></th>
                    <th class="actions">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historyQuestions as $historyQuestion): ?>
                <tr>
                    <td><?= $this->Number->format($historyQuestion->id) ?></td>
                    <td><?= h($historyQuestion->question) ?></td>
                    <td><?= h($historyQuestion->history_questions_group->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['controller' => 'general_settings', 'action' => 'edit', $historyQuestion->id]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
