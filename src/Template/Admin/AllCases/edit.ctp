<div class="col-md-10 panel panel-default">
    <?= $this->Form->create($allCase) ?>
    <?= $this->Element('edit_submenu')?>

    <h3>Wordpress Settings</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->input('name');
                    echo $this->Form->input('slug', ['label' => 'Slug (text, underscores and dashes only, no spaces)']);
                    echo $this->Form->input('wp_post_id', ['type' => 'text', 'label' => 'Course Post ID']);
                    echo $this->Form->input('wp_lesson_post_id', ['type' => 'text', 'label' => 'Lesson Post ID']);
                    echo $this->Form->input('course_home');
                ?>
            </fieldset>
        </div>
    </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <br /><br />
</div>
