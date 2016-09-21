<div class="orderLabs index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Edit Groups') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="actions">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="selector">
                <?php foreach ($orderLabGroups as $orderLabGroup): 
                    if ($orderLabGroup->id != 0) {
                    ?>
                    <tr id="sort-<?=$orderLabGroup->id?>">
                        <td><?= $this->Number->format($orderLabGroup->id) ?></td>
                        <td><?= h($orderLabGroup->name) ?></td>
                        <td class="actions" style="text-align: right;">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'order_labs', 'action' => 'edit_group', $orderLabGroup->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                            - 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'order_labs', 'action' => 'delete_group', $orderLabGroup->id], ['confirm' => 'Are you sure you want to delete this group?  All questions in the group will be moved to Uncategorized.'])?>
                        </td>
                    </tr>
                    <?php 
                    }
                endforeach;
                ?>
                <?= $this->Form->create($orderLabGroups) ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><?= $this->Form->input('OrderLabsGroups.name', ['label' => false]);?></td>
                    <td class="actions">
                        <?= $this->Form->button(__('Add New Group')) ?>
                    </td>
                </tr>
                <?= $this->Form->end() ?>
            </tbody>
        </table>
    </div>
</div>
