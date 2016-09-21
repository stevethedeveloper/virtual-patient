<?= $this->Form->create($video) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Edit Video</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $video->all_cases_id]);
                    echo $this->Form->input('video_file_name');
                    echo $this->Form->input('video_nice_name');
                ?>
            </fieldset>
        </div>
    </div>
    <div class="col-md-10">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
<?= $this->Form->end() ?>
