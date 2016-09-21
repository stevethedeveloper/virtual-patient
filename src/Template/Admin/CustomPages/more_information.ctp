<?= $this->Form->create($customPage) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Edit More Information Page</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $customPage->all_cases_id]);
                    echo $this->Form->input('pages_title', ['label' => 'Title']);
                    echo $this->Form->input('pages_desc', ['label' => 'Description']);
                    echo $this->Form->input('pages_text', ['label' => 'Contents']);
                ?>
            </fieldset>
        </div>
    </div>
    <div class="col-md-10">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
<?= $this->Form->end() ?>
