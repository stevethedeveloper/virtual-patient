<div class="diagnostics index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Diagnostics') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('diagnosis_name') ?></th>
                <th class="actions pull-right"><?= $this->Html->link(__('[Add New]'), ['action' => 'add', $case_id]) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diagnostics as $diagnostic): ?>
                <tr>
                    <td><?= $this->Number->format($diagnostic->id) ?></td>
                    <td><?= $diagnostic->diagnosis_name ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['controller' => 'diagnostics', 'action' => 'edit', $diagnostic->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                        - 
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'diagnostics', 'action' => 'delete', $diagnostic->id], ['confirm' => 'Are you sure you want to delete this diagnostic?'])?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($this->Paginator->hasPage(2)) {?>
    <div class="paginator">
        <ul class="pagination">
            <li><?= $this->Paginator->prev('< ' . __('previous')) ?></li>
            <li><?//= $this->Paginator->numbers() ?></li>
            <li><?= $this->Paginator->next(__('next') . ' >') ?></li>
        </ul>
        <p>Page <?= $this->Paginator->counter() ?></p>
    </div>
    <?php }?>
</div>
