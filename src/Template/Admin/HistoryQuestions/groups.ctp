<div class="allCases index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Edit Groups') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="actions">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="selector">
                <?php foreach ($historyQuestionGroups as $historyQuestionGroup): 
                    if ($historyQuestionGroup->id != 0) {
                    ?>
                    <tr id="sort-<?=$historyQuestionGroup->id?>">
                        <td><?= $this->Number->format($historyQuestionGroup->id) ?></td>
                        <td><?= h($historyQuestionGroup->name) ?></td>
                        <td class="actions" style="text-align: right;">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'history_questions', 'action' => 'edit_group', $historyQuestionGroup->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                            - 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'history_questions', 'action' => 'delete_group', $historyQuestionGroup->id], ['confirm' => 'Are you sure you want to delete this group?  All questions in the group will be moved to Uncategorized.'])?>
                        </td>
                    </tr>
                    <?php 
                    }
                endforeach;
                ?>
                <?= $this->Form->create($historyQuestionGroups) ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><?= $this->Form->input('HistoryQuestionsGroups.name', ['label' => false]);?></td>
                    <td class="actions">
                        <?= $this->Form->button(__('Add New Group')) ?>
                    </td>
                </tr>
                <?= $this->Form->end() ?>
            </tbody>
        </table>
    </div>
</div>
