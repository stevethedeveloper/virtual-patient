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
    .container, .container_unsortable {
        background-color:#ffffff;
        min-height: 50px;
        margin: 10px;
        padding: 0 10px;
        vertical-align:top;
        cursor:move;
    }
    .option {
        background-color:#e7e7e7;
        margin:5px;
        padding:5px;
        cursor:move;
    }
</style>



<div class="index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Management Medication') ?></h3>
</div>

    <div class="index table-responsive col-md-12 columns content ">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Text</th>
                    <th>Association</th>
                    <th class="actions pull-right"><?= $this->Html->link(__('[Add Option]'), ['controller' => 'management_medications', 'action' => 'add_option', $case_id]) ?></th>
                </tr>
            </thead>
            <tbody id="selector" class="container">
                <?php foreach ($managementMedications as $option):
                    //if ($option->id != 0) {
                    ?>
                    <tr id="option_<?=$option->id?>">
                        <td class="col-md-6">
                            <?php
                            if ($option->medication_group == -1 || $option->medication_group == 'x') {
                                echo '<span id="management_span_'.$option->id.'">'.$option->medication_text.'</span>';
                            } else {
                                echo '<span id="management_span_'.$option->id.'"" style="color:'.$colors[array_keys($association_array, $option->medication_group)[0]].'">'.$option->medication_text.'</span>';
                            }
                            ?>
                        </td>
                        <td id="associationFormCell_<?=$option->id?>">
                            <?php
                                if ($option->medication_group == 'x') {
                                    echo '&nbsp';
                                } else {
                                    ?>
                                        <div id="associationFormSelect_<?=$option->id?>">
                                            <?= $this->Form->input($associations[$option->medication_group], ['options' => $associations, 'label' => false, 'value' => $option->medication_group, 'id' => $option->id, 'class' => 'association_dropdown']) ?>
                                        </div>
                                        <div class="associationForm" id="associationForm_<?=$option->id?>">
                                            <?= $this->Form->create($medicationForm) ?>
                                                <?=$this->Form->hidden('ManagementMedications.id', ['value' => $option->id])?>
                                                <?= $this->Form->input('ManagementMedications.medication_group', ['label' => false]);?>
                                                <?= $this->Form->button(__('Submit')) ?>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    <?php
                                }
                                ?>
                        </td>
                        <td class="actions" style="text-align: right;">
                            <?php
                                if ($option->medication_group == 'x') {
                                    ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'management_medications', 'action' => 'edit_option', $option->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                                    <?
                                } else {
                                    ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'management_medications', 'action' => 'edit_option', $option->id, 'case_id' => $this->request->params['pass'][0]]) ?>
                                        - 
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'management_medications', 'action' => 'deleteOption', $option->id], ['confirm' => 'Are you sure you want to delete this option?'])?>
                                    <?php
                                }
                                ?>
                        </td>
                    </tr>
                    <?php 
                    //}
                endforeach;
                ?>
            </tbody>
        </table>
    </div>


<script>
$(function(){

    /* Sort options */
    $('.container').sortable({
        axis: "y",
        update: function (event, ui) {
            var data = $(this).sortable('toArray');
            var url = "<?php echo $this->Url->build(['controller' => 'ManagementMedications', 'action' => 'change_order']);?>";

            var posting = $.post( url, { data } );
        }   
    }); 
    
});
</script>

<script>
$(".association_dropdown").change(function(){
    if ($(this).val() == 'new') {
        $( this ).css( "display", "none" );
        $( '#associationForm_' + $(this).attr('id') ).css( "display", "block" );
    } else {
        var colors = new Array(<?=$color_string?>);
        var associations = new Array(<?=$association_string?>);

        var url = "<?php echo $this->Url->build(['controller' => 'ManagementMedications', 'action' => 'change_association']);?>";

        var posting = $.post( url, { id:$(this).attr('id'), medication_group:$(this).val() } );

        if ($(this).val() == '-1') {
            $( '#management_span_' + $(this).attr('id') ).css( "color", "black" );
        } else {
            $( '#management_span_' + $(this).attr('id') ).css( "color", colors[associations.indexOf($(this).val())] );
        }
    }
});
</script>