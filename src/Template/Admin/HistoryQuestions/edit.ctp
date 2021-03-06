<?= $this->Form->create($generalSetting) ?>
<?= $this->Element('edit_submenu')?>

    <h3>Edit General Settings</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Paths</strong>
        </div>
        <div class="panel-body">
            <fieldset>
                <?php
                    echo "Streamer Path (do not include http://)";
                    echo $this->Form->input('streamer_path', ['label' => false]);
                    echo "iOS Path (do not include http://)";
                    echo $this->Form->input('ios_path', ['label' => false]);
                    echo "Folder";
                    echo $this->Form->input('folder', ['label' => false]);
                ?>
            </fieldset>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Limits</strong>
        </div>
        <div class="panel-body">
            <fieldset>
                <?php
                    echo "History Question Cap";
                    echo $this->Form->input('history_question_cap', ['label' => false]);
                    echo "Lab Order Cap";
                    echo $this->Form->input('lab_order_cap', ['label' => false]);
                    echo "Differential Diagnosis Option Cap";
                    echo $this->Form->input('dd_option_cap', ['label' => false]);
                    echo "Diagnosis Option Cap";
                    echo $this->Form->input('d_option_cap', ['label' => false]);
                ?>
            </fieldset>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Other</strong>
        </div>
        <div class="panel-body">
            <fieldset>
                <?php
                    echo "CME Credit";
                    echo $this->Form->input('cme_credit', ['label' => false]);
                    echo "Hide Billing Section ";
                    echo $this->Form->checkbox('hide_billing', ['label' => false]);
                ?>
            </fieldset>
        </div>
    </div>
</div>
<div class="col-md-10">
    <?= $this->Form->button(__('Submit')) ?>
</div>
<?= $this->Form->end() ?>
