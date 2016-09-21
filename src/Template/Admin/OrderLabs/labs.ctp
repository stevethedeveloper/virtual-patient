<?php
$color_string = '"'.implode('","', $colors).'"';
$array = $associations;
unset($array['-1']);
unset($array['new']);
$association_string = '"'.implode('","', $array).'"';
$association_array = array();
foreach ($array as $val) {
    $association_array[] = $val;
}
?>
<style>
.associationForm {
    display: none;
}
</style>

<div class="orderLabs index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Edit Labs') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lab</th>
                    <th>Association</th>
                    <th class="actions pull-right"><?= $this->Html->link(__('[Add Lab]'), ['controller' => 'order_labs', 'action' => 'add_lab', $case_id]) ?></th>
                </tr>
            </thead>
            <tbody id="selector">
                <?php foreach ($orderLabs as $orderLab): 
                    if ($orderLab->id != 0) {
                    ?>
                    <tr id="sort-<?=$orderLab->id?>">
                        <td><?= $this->Number->format($orderLab->id) ?></td>
                        <td>
                            <?php
                            if ($orderLab->lab_group == -1) {
                                echo '<span id="lab_span_'.$orderLab->id.'">'.$orderLab->lab.'</span>';
                            } else {
                                echo '<span id="lab_span_'.$orderLab->id.'"" style="color:'.$colors[array_keys($association_array, $orderLab->lab_group)[0]].'">'.$orderLab->lab.'</span>';
                            }
                            ?>
                        </td>
                        <td id="associationFormCell_<?=$orderLab->id?>">
                            <div id="associationFormSelect_<?=$orderLab->id?>">
                                <?= $this->Form->input($associations[$orderLab->lab_group], ['options' => $associations, 'label' => false, 'value' => $orderLab->lab_group, 'id' => $orderLab->id, 'class' => 'association_dropdown']) ?>
                            </div>
                            <div class="associationForm" id="associationForm_<?=$orderLab->id?>">
                                <?= $this->Form->create($orderLabForm) ?>
                                    <?=$this->Form->hidden('OrderLabs.id', ['value' => $orderLab->id])?>
                                    <?= $this->Form->input('OrderLabs.lab_group', ['label' => false]);?>
                                    <?= $this->Form->button(__('Submit')) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </td>
                        <td class="actions" style="text-align: right;">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'order_labs', 'action' => 'edit_lab', $orderLab->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                            - 
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'order_labs', 'action' => 'deleteLab', $orderLab->id], ['confirm' => 'Are you sure you want to delete this lab?'])?>
                        </td>
                    </tr>
                    <?php 
                    }
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(".association_dropdown").change(function(){
    if ($(this).val() == 'new') {
        $( this ).css( "display", "none" );
        $( '#associationForm_' + $(this).attr('id') ).css( "display", "block" );
    } else {
        var colors = new Array(<?=$color_string?>);
        var associations = new Array(<?=$association_string?>);

        var url = "<?php echo $this->Url->build(['controller' => 'OrderLabs', 'action' => 'change_association']);?>";

        var posting = $.post( url, { id:$(this).attr('id'), lab_group:$(this).val() } );

        if ($(this).val() == '-1') {
            $( '#lab_span_' + $(this).attr('id') ).css( "color", "black" );
        } else {
            $( '#lab_span_' + $(this).attr('id') ).css( "color", colors[associations.indexOf($(this).val())] );
        }
    }
});
</script>