<?= $this->Form->create($orderLabGroup) ?>
<?= $this->Element('edit_submenu')?>

    <h3>Edit Group</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $orderLabGroup->all_cases_id]);
                    echo "Name";
                    echo $this->Form->input('name', ['label' => false]);
                ?>
            </fieldset>
        </div>
    </div>
<div class="col-md-10">
    <?= $this->Form->button(__('Submit')) ?>
</div>
<?= $this->Form->end() ?>
