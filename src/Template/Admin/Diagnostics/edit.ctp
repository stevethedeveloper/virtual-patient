<?= $this->Form->create($diagnostic) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Edit Diagnostic</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $diagnostic->all_cases_id]);
                    echo $this->Form->input('diagnosis_name');
                ?>
            </fieldset>
        </div>
    </div>
    <div class="col-md-10">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
<?= $this->Form->end() ?>