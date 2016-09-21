<div class="allCases index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Edit Questions') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th class="actions pull-right"><?= $this->Html->link(__('[Add Question]'), ['controller' => 'history_questions', 'action' => 'add_question', $case_id]) ?></th>
                </tr>
            </thead>
            <tbody id="selector">
                <?php foreach ($historyQuestions as $historyQuestion): 
                    if ($historyQuestion->id != 0) {
                    ?>
                    <tr id="sort-<?=$historyQuestion->id?>">
                        <td><?= $this->Number->format($historyQuestion->id) ?></td>
                        <td><?= $historyQuestion->question ?></td>
                        <td class="actions" style="text-align: right;">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'history_questions', 'action' => 'edit_question', $historyQuestion->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                            - 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'history_questions', 'action' => 'delete_question', $historyQuestion->id], ['confirm' => 'Are you sure you want to delete this question?'])?>
                        </td>
                    </tr>
                    <?php 
                    }
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
