<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add Menu Item</h3>
    </div>
    <?= $this->Form->create($menu) ?>
        <div class="box-body">
            <?php
                echo $this->Form->hidden('parent_id', ['value' => $menu->parent_id]);
                echo $this->Form->hidden('display_order', ['value' => $menu->display_order]);
                echo $this->Form->input('title', ['class' => 'form-control']);
                echo '<br />';
                echo $this->Form->input('content_page_id', ['label' => 'Page', 'options' => $contentPages, 'empty' => 'Please Select']);
                //echo $this->Form->input('url', ['label' => 'URL (Overrides Selected Page), 'class' => 'form-control', 'required' => false]);
            ?>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    <?= $this->Form->end() ?>
</div>
</section>