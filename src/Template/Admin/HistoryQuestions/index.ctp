<style>
    .container, .container_unsortable {
    }
    .question, .question_unsortable {
        background-color:#e7e7e7;
        margin:5px;
        padding:5px;
        cursor:move;
    }
    .question_group, .question_group_unsortable {
        background-color:#ffffff;
        border:solid 1px #ccc;
        min-height: 50px;
        margin: 10px;
        padding: 0 10px;
        vertical-align:top;
        cursor:move;
    }
    .question_group_unsortable {
        cursor: default;
    }
</style>

<div class="index col-md-10 columns content">
    <?= $this->Element('edit_submenu')?>
    <h3><?= __('History Questions') ?></h3>
</div>

<div class="index col-md-12 columns content container">
    <?php foreach ($historyQuestionGroups as $historyQuestionGroup): 
        if ($historyQuestionGroup->id != 0) {
        ?>
        <div class="question_group" id="question_group_<?=$historyQuestionGroup->id?>">
            <h3 class="title"><?=$historyQuestionGroup->name?></h3>
            <?php foreach ($historyQuestionGroup->history_questions as $question): ?>
                <div class="question" id="question_<?=$question->id?>">
                    <?=$question->question?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php 
        }
    endforeach; 
    ?>
</div>

<div class="index col-md-12 columns content container_unsortable">
    <?php foreach ($historyQuestionGroups as $historyQuestionGroup): 
        if ($historyQuestionGroup->id == 0) {
        ?>
        <div class="question_group question_group_unsortable" id="question_group_<?=$historyQuestionGroup->id?>">
            <h3 class="title"><?=$historyQuestionGroup->name?></h3>
            <?php foreach ($historyQuestionGroup->history_questions as $question): ?>
                <div class="question" id="question_<?=$question->id?>"><?=$question->question?></div>
            <?php endforeach; ?>
        </div>
    <?php 
        }
    endforeach; 
    ?>
</div>

<script>
$(function(){

    /* Sort groups */
    $('.container').sortable({
        axis: "y",
        update: function (event, ui) {
            var data = $(this).sortable('toArray');
            var url = "<?php echo $this->Url->build(['controller' => 'HistoryQuestions', 'action' => 'change_group_order']);?>";

            var posting = $.post( url, { data } );
            //$("#result").html("JSON:<pre>"+JSON.stringify(data)+"</pre>");
        }   
    }); 
    
    /* Here we will store all data */
    var myArguments = {};   
    
    function assembleData(object,arguments)
    {       
        var data = $(object).sortable('toArray'); // Get array data 
        var question_group_id = $(object).attr("id"); // Get question_group_id and we will use it as property name
        var arrayLength = data.length; // no need to explain
        
        /* Create question_group_id property if it does not exist */
        if(!arguments.hasOwnProperty(question_group_id)) 
        { 
            arguments[question_group_id] = new Array();
        }   
        
        /* Loop through all items */
        for (var i = 0; i < arrayLength; i++) 
        {
            var question_id = data[i]; 
            /* push all question_id onto property question_group_id (which is an array) */
            arguments[question_group_id].push(question_id);          
        }
        return arguments;
    }   
    
    /* Sort questions */
    $('.question_group').sortable({
        axis: "y",
        connectWith: '.question_group',
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
        /* That's fired third */       
        receive : function( event, ui ) {
            /* Get array of items where we added a new item */  
            myArguments = assembleData(this,myArguments);       
        },
        update: function(e,ui) {
            if (this === ui.item.parent()[0]) {
                 /* In case the change occurs in the same container */ 
                 if (ui.sender == null) {
                    myArguments = assembleData(this,myArguments);       
                } 
            }
        },      
        /* That's fired last */         
        stop : function( event, ui ) {                  
            /* Send JSON to the server */
            var url = "<?php echo $this->Url->build(['controller' => 'HistoryQuestions', 'action' => 'change_question_order']);?>";

            var posting = $.post( url, { myArguments } );

            $("#result").html("Send JSON to the server:<pre>"+JSON.stringify(myArguments)+"</pre>");        
        },  
    });
});
</script>