<?= $this->Form->create($diagnostic) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Add Diagnostic</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $case_id]);
                    echo $this->Form->input('diagnosis_name');
                ?>
            </fieldset>
        </div>
    </div>
    <div class="col-md-10">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
<?= $this->Form->end() ?>
