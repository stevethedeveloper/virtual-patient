<?
    echo $this->Html->css('/admin/plugins/datatables/dataTables.bootstrap.css');
?>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Pages</h3>
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
                <?php foreach ($contentPages as $contentPage): ?>
                <tr id="option_<?=$contentPage->id?>">
                    <td class="col-md-8"><?= h($contentPage->title) ?></td>
                    <td class="actions col-md-4">
                        <?= $this->Html->link(__('Preview'), ['prefix' => false, 'controller' => '/'.$contentPage->slug], ['target' => '_blank']) ?>
                        <?php if ($contentPage->edit_lock != 1) {?>
                             - 
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contentPage->id]) ?>
                        <?php }?>
                        <?php if ($contentPage->delete_lock != 1) {?>
                             - 
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contentPage->id], ['confirm' => __('Are you sure you want to delete "{0}"?', $contentPage->title)]) ?>
                        <?php }?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
                <?php if ($this->Paginator->hasPage(2)) {?>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?//= $this->Paginator->numbers() ?>
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