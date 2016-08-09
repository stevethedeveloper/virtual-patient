<style>
    .container {
        cursor:move;
    }
</style>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Submenu for <?= h($menu->title) ?></h3>
        </div>
    </div>
    <!-- /.box -->
   
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Submenus</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody id="selector" class="container">
                <?php foreach ($menu->child_menus as $submenu): ?>
                <tr id="option_<?=$submenu->id?>">
                    <td class="col-md-8"><?= h($submenu->title) ?></td>
                    <td class="actions col-md-4">
                        <?//= $this->Html->link(__('Submenu'), ['action' => 'view', $submenu->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $submenu->id]) ?> - 
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $submenu->id], ['confirm' => __('Are you sure you want to delete "{0}"?', $submenu->title)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
                <?php if ($this->Paginator->hasPage(2)) {?>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                </div>
                <?}?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Submenu Item</h3>
        </div>
        <?= $this->Form->create($menu) ?>
            <div class="box-body">
                <?php
                    echo $this->Form->hidden('parent_id', ['value' => $menu->id]);
                    echo $this->Form->hidden('display_order', ['value' => '0']);
                    echo $this->Form->input('title', ['class' => 'form-control']);
                    echo '<br />';
                    echo $this->Form->input('content_page_id', ['label' => 'Page', 'options' => $contentPages, 'empty' => 'Please Select']);
                    //echo $this->Form->input('url', ['class' => 'form-control', 'required' => false]);
                ?>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        <?= $this->Form->end() ?>
    </div>

</section>

<script>
$(function(){

    /* Sort options */
    $('.container').sortable({
        axis: "y",
        update: function (event, ui) {
            var data = $(this).sortable('toArray');
            var url = "<?php echo $this->Url->build(['controller' => 'Menus', 'action' => 'change_top_order']);?>";

            var posting = $.post( url, { data } );
        }   
    }); 
    
});
</script>