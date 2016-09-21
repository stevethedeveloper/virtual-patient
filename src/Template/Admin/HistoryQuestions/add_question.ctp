<?= $this->Form->create($historyQuestion) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Add Question</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $case_id]);
                    echo $this->Form->hidden('history_questions_groups_id', ['value' => 0]);
                    echo $this->Form->input('question', ['required' => false]);
                    echo $this->Form->input('video_id', ['options' => $videos, 'empty' => '--Please Select--']);
                ?>
            </fieldset>
        </div>
    </div>
    <div class="col-md-10">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
<?= $this->Form->end() ?>
