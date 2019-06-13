<div class="allCases index col-md-10 columns content">
    <h3><?= __('Cases') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allCases as $allCase): ?>
                <tr>
                    <td><?= $this->Number->format($allCase->id) ?></td>
                    <td><?= h($allCase->name) ?></td>
                    <td><?= h($allCase->slug) ?></td>
                    <td><?= h($allCase->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['controller' => 'general_settings', 'action' => 'edit', $allCase->id]) ?>
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
