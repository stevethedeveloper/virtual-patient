
    <!--left column-->
    <div class="col-md-5 left-column">
        <div class="col-md-12">

            <!--left top-->
            <div class="row">
                <div class="col-md-12 well left-top">
                    <h1>Management</h1>
                    <div id="media_div">
                        <div id="image">
                            <img src="<?=$poster?>" alt="" />
                        </div>
                    </div>
                </div>
            </div>

            <!--left bottom-->
            <div class="row">
                <div class="col-md-12 well left-bottom">
                    <?=$page->pages_desc?>
                </div>
            </div>

        </div>
    </div>

    <!--right column-->
    <div class="col-md-7 well right-column">
        
        <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <a href="<?= $this->Url->build(['controller' => 'Management'])?>" role="button" class="btn btn-primary">Counseling</a>
            </div>
            <div class="btn-group" role="group">
              <a href="<?= $this->Url->build(['controller' => 'Management', 'action' => 'medication'])?>" role="button" class="btn btn-default">Medication</a>
            </div>
            <div class="btn-group" role="group">
              <a href="<?= $this->Url->build(['controller' => 'Management', 'action' => 'referral'])?>" role="button" class="btn btn-default">Referral</a>
            </div>
        </div>
        <br />
        
        <div class="col-md-12">

            <div class="btn-block center-block">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $no_selection = false;
                        foreach ($questions as $q) {
                        ?>
                       
                            <div class="row">
                                <div class="col-md-2">
                                    <?php
                                        if (($q->counseling_group == 'x') && in_array($q->id, $already_ordered)) {
                                            $no_selection = true;
                                        }

                                        if (!in_array($q->id, $already_ordered)) {
                                    ?>
                                            <?php if ($no_selection || (($q->counseling_group != -1 && $q->counseling_group != 'x') && in_array($q->id, $groups[$q->counseling_group]['ids']) && count(array_intersect($already_ordered, $groups[$q->counseling_group]['ids'])) > 0)) {?>
                                                <button id="question-button-<?=$q->id?>" type="button" class="btn btn-default btn-md hidden red" onClick="javascript:clickButton('<?=$q->id?>', 'management_counseling'<?php if ($q->counseling_group != -1) { echo ', \''.$q->counseling_group.'\''; }?>);">Delete</button>
                                            <?php } else {?>
                                                <button id="question-button-<?=$q->id?>" type="button" class="btn btn-default btn-md" onClick="javascript:clickButton('<?=$q->id?>', 'management_counseling'<?php if ($q->counseling_group != -1) { echo ', \''.$q->counseling_group.'\''; }?>);">Select</button>
                                            <?}?>
                                    <?php
                                        } else {
                                    ?>
                                            <button id="question-button-<?=$q->id?>" type="button" class="btn btn-default btn-md red" onClick="javascript:clickButton('<?=$q->id?>', 'management_counseling'<?php if ($q->counseling_group != -1) { echo ', \''.$q->counseling_group.'\''; }?>);">Delete</button>
                                    <?php }?>
                                </div>
                                <div class="col-md-10">
                                    <?php
                                        if ($q->counseling_group == -1 || $q->counseling_group == 'x') {
                                            echo $q->counseling_text;
                                        } else {
                                            echo '<span style="color:'.$groups[$q->counseling_group]['color'].'">'.$q->counseling_text.'</span>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <?//=$q->Videos['video_file_name']?>
                            <br />

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    
    </div>

    <!--nav-->  
    <div class="row">
        <div class="col-md-10">
            <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', ['controller' => 'diagnostics', 'action' => 'diagnosis'], ['class' => 'btn btn-default btn-md previous-button', 'escape' => false])?>
        </div>
        <div class="col-md-2 pull-right">
            <?= $this->Html->link('Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', ['controller' => 'management', 'action' => 'medication'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
        </div>
    </div>

</div>

<script>

    var groups = <?=json_encode($groups)?>;

//alert(groups["oximetry"]["ids"].length);

//    $(document).ready(function(){
//        $('.scroll-pane-arrows').jScrollPane(
//        {showArrows:false,scrollbarWidth:6,verticalGutter: 0,hideFocus:true}
//        );
        
        //$( ".question_wrapper" ).css( "display", "block" );
        
//    });

    function clickButton(question_id, section_name, group) {

        var returned;
        var confirm_message;
        var confirmed = false;
        var button_text = $("#question-button-" + question_id);
        var groups = <?=json_encode($groups)?>;

        if (group != undefined && group != 'x' && button_text.html() == "Select") {
            confirm_message = "This option is part of a group. \n(The other options in this group also are colored " + groups[group]["color"] + ".)\n If you select 'OK' this option will be selected and the rest will become unavailable. Selecting 'Cancel' cancels the selection.";
            if (confirm(confirm_message)) {
                confirmed = true;
            }
        } else if (group == 'x' || (group != undefined && button_text.html() == "Delete")) {
            confirmed = true;
        }

        if (group == undefined || (group != undefined && confirmed == true)) {

            var url = "<?php echo $this->Url->build(['controller' => 'ManagementCounselings', 'action' => 'select_question']);?>";

            var posting = $.post( url, { question_id:question_id, section_name:section_name, group:group } );
         
            posting.done(function( data ) {
                    try {
                        //returned = JSON.parse(data);
                        //$("#lab_ordered").html(returned['lab']);
                        //$("#lab_result").html(returned['if_ordered']);
                        //document.getElementById('page_description').style.display='none';
                        //document.getElementById('lab_results').style.display='block';

                        if (button_text.html() == "Select") {
                            button_text.html('Delete');
                            button_text.addClass('red');
                        } else {
                            button_text.html('Select');
                            button_text.removeClass('red');
                        }

                        if (group != undefined && button_text.html() != "Select") {
                            for (var i = 0;i < groups[group]["ids"].length;i++) {
                                if (groups[group]["ids"][i] != question_id) {
                                    button_text = $("#question-button-" + groups[group]["ids"][i]);
                                    button_text.addClass('hidden');
                                }
                            }
                        } else if (group != undefined && button_text.html() != "Delete") {
                            for (var i = 0;i < groups[group]["ids"].length;i++) {
                                if (groups[group]["ids"][i] != question_id) {
                                    button_text = $("#question-button-" + groups[group]["ids"][i]);
                                    button_text.html('Select');
                                    button_text.removeClass('hidden');
                                    button_text.removeClass('red');
                                }
                            }
                        }
                    }
                    catch(err) {
                        //$( "#video_div" ).empty().append( data );
                    }
            });
        }
    }
</script>
