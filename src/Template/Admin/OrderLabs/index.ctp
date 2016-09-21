<style>
    .container, .container_unsortable {
    }
    .lab, .lab_unsortable {
        background-color:#e7e7e7;
        margin:5px;
        padding:5px;
        cursor:move;
    }
    .lab_group, .lab_group_unsortable {
        background-color:#ffffff;
        border:solid 1px #ccc;
        min-height: 50px;
        margin: 10px;
        padding: 0 10px;
        vertical-align:top;
        cursor:move;
    }
    .lab_group_unsortable {
        cursor: default;
    }
</style>

<div class="index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('Labs') ?></h3>
</div>

<div class="index col-md-12 columns content container">
    <?php foreach ($orderLabGroups as $orderLabGroup): 
        if ($orderLabGroup->id != 0) {
        ?>
        <div class="lab_group" id="lab_group_<?=$orderLabGroup->id?>">
            <h3 class="title"><?=$orderLabGroup->name?></h3>
            <?php foreach ($orderLabGroup->order_labs as $lab): ?>
                <div class="lab" id="lab_<?=$lab->id?>">
                    <?=$lab->lab?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php 
        }
    endforeach; 
    ?>
</div>

<div class="index col-md-12 columns content container_unsortable">
    <?php foreach ($orderLabGroups as $orderLabGroup): 
        if ($orderLabGroup->id == 0) {
        ?>
        <div class="lab_group lab_group_unsortable" id="lab_group_<?=$orderLabGroup->id?>">
            <h3 class="title"><?=$orderLabGroup->name?></h3>
            <?php foreach ($orderLabGroup->order_labs as $lab): ?>
                <div class="lab" id="lab_<?=$lab->id?>"><?=$lab->lab?></div>
            <?php endforeach; ?>
        </div>
    <?php 
        }
    endforeach; 
    ?>
</div>

<!--<div class="row">
<div class="col-md-12" id="result">
</div>
</div>-->
<script>
$(function(){

    /* Sort groups */
    $('.container').sortable({
        axis: "y",
        update: function (event, ui) {
            var data = $(this).sortable('toArray');
            var url = "<?php echo $this->Url->build(['controller' => 'OrderLabs', 'action' => 'change_group_order']);?>";

            var posting = $.post( url, { data } );
            //$("#result").html("JSON:<pre>"+JSON.stringify(data)+"</pre>");
        }   
    }); 
    
    /* Here we will store all data */
    var myArguments = {};   
    
    function assembleData(object,arguments)
    {       
        var data = $(object).sortable('toArray'); // Get array data 
        var lab_group_id = $(object).attr("id"); // Get lab_group_id and we will use it as property name
        var arrayLength = data.length; // no need to explain
        
        /* Create lab_group_id property if it does not exist */
        if(!arguments.hasOwnProperty(lab_group_id)) 
        { 
            arguments[lab_group_id] = new Array();
        }   
        
        /* Loop through all items */
        for (var i = 0; i < arrayLength; i++) 
        {
            var lab_id = data[i]; 
            /* push all lab_id onto property lab_group_id (which is an array) */
            arguments[lab_group_id].push(lab_id);          
        }
        return arguments;
    }   
    
    /* Sort labs */
    $('.lab_group').sortable({
        axis: "y",
        connectWith: '.lab_group',
        items : ':not(.title)',
        /* That's fired first */    
        start : function( event, ui ) {
            myArguments = {}; /* Reset the array*/  
        },      
        /* That's fired second */
        remove : function( event, ui ) {
            /* Get array of items in the list where we removed the item */          
            myArguments = assembleData(this,myArguments);
        },      
        /* That's fired thrird */       
        receive : function( event, ui ) {
            /* Get array of items where we added a new item */  
            myArguments = assembleData(this,myArguments);       
        },
        update: function(e,ui) {
            if (this === ui.item.parent()[0]) {
                 /* In case the change occures in the same container */ 
                 if (ui.sender == null) {
                    myArguments = assembleData(this,myArguments);       
                } 
            }
        },      
        /* That's fired last */         
        stop : function( event, ui ) {                  
            /* Send JSON to the server */
            var url = "<?php echo $this->Url->build(['controller' => 'OrderLabs', 'action' => 'change_lab_order']);?>";

            var posting = $.post( url, { myArguments } );

            $("#result").html("Send JSON to the server:<pre>"+JSON.stringify(myArguments)+"</pre>");        
        },  
    });
});
</script>