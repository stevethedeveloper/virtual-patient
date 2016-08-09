<?
    echo $this->Html->css('/admin/plugins/datatables/dataTables.bootstrap.css');
?>
<style>
    .container {
        cursor:move;
    }
</style>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Top Menus</h3>
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
                <?php foreach ($menus as $menu): ?>
                <tr id="option_<?=$menu->id?>">
                    <td class="col-md-8"><?= h($menu->title) ?></td>
                    <td class="actions col-md-4">
                        <?= $this->Html->link(__('Submenu'), ['action' => 'view', $menu->id]) ?> - 
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id]) ?> - 
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete "{0}"?  This will delete all submenus for this menu item.', $menu->title)]) ?>
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
    </section>

<?
    echo $this->Html->script('/admin/plugins/datatables/jquery.dataTables.min.js');
    echo $this->Html->script('/admin/plugins/datatables/dataTables.bootstrap.min.js');
?>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#datatable').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false
    });
  });
</script>

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