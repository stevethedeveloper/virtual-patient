<?= $this->Form->create($historyQuestion) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Edit Question</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $historyQuestion->all_cases_id]);
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
