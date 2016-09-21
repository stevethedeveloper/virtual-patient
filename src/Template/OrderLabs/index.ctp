<?php
echo $this->Html->script('jquery/jquery-migrate.min.js?ver=1.2.1');

$lab_sections = array();
foreach ($labs as $lab) {
    $lab_sections[$lab->category][$lab->id] = $lab;
}

echo $this->Html->css('shadowbox/shadowbox.css');
echo $this->Html->script('shadowbox/shadowbox.js');
?>
<script>
    Shadowbox.init({
        language: 'en',
        players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv']
    });
        
    function getLabImage(labImage){
        Shadowbox.open({
        content: labImage,
        player: "iframe",
        title: "",
        height: 480,
        width: 640
        });
    }
</script>
    <!--left column-->
    <div class="col-md-5 left-column">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 well left-top">
                    <h1><?php echo $page->pages_title; ?></h1>
                    <div id="media_div">
                        <div id="image">
                            <img src="<?=$poster?>" alt="" />
                        </div>
                    </div>
                </div>
            </div>

            <!--left middle-->
            <div class="row">
                <div class="col-md-12 well left-middle">
                    <div id="count_div">
                    You have ordered <strong id="ordered_count"><?=$total_count?></strong> of a possible <strong><?=$lab_order_cap?></strong> labs.
                    </div>
                </div>
            </div>

            <!--left bottom-->
            <div class="row">
                <div class="col-md-12 well left-bottom">
                    <div id="page_description">
                        <?=$page->pages_desc?>
                    </div>
                    <div id="lab_results">
                        <strong>Lab Ordered:</strong> <span id="lab_ordered"></span>
                        <br /><br />
                        <strong>Result:</strong> <span id="lab_result"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--right column-->
    <div class="col-md-7 well right-column">
        
        <div class="col-md-12 scroll-pane-arrows">

        <?php foreach($labs as $group) {?>
                <?php
                if (count($group->order_labs) === 0) {
                    continue;
                }
                ?>
            <h1><?=$group->name?></h1>

            <?php foreach($group->order_labs as $l) {?>
                <div class="row">
                    <div class="col-md-2">
                        <?php
                            if (!in_array($l->id, $already_ordered)) {
                        ?>
                                <?php if ($l->lab_group != -1 && in_array($l->id, $groups[$l->lab_group]['ids']) && count(array_intersect($already_ordered, $groups[$l->lab_group]['ids'])) > 0) {?>
                                    <button id="order-button-<?=$l->id?>" type="button" class="btn btn-default btn-md hidden" onClick="javascript:orderLab('<?=$l->id?>', 'labs');">Review</button>
                                <?php } else {?>
                                    <button id="order-button-<?=$l->id?>" type="button" class="btn btn-default btn-md" onClick="javascript:orderLab('<?=$l->id?>', 'labs'<?php if ($l->lab_group != -1) { echo ', \''.$l->lab_group.'\''; }?>);">Order</button>
                                <?}?>
                        <?php
                            } else {
                        ?>
                                <button id="order-button-<?=$l->id?>" type="button" class="btn btn-default btn-md" onClick="javascript:orderLab('<?=$l->id?>', 'labs');">Review</button>
                        <?php }?>
                    </div>
                    <div class="col-md-10">
                        <?php
                            if ($l->lab_group == -1) {
                                echo $l->lab;
                            } else {
                                echo '<span style="color:'.$groups[$l->lab_group]['color'].'">'.$l->lab.'</span>';
                            }
                        ?>
                    </div>
                </div>
                <?//=$q->Videos['video_file_name']?>
                <br />
            <?php }?>
            <br /><br />
        <?php }?>
        </div>
    
    </div>

    <!--nav-->  
    <div class="row">
        <div class="col-md-10">
            <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', ['controller' => 'more_information'], ['class' => 'btn btn-default btn-md previous-button', 'escape' => false])?>
        </div>
        <div class="col-md-2 pull-right">
            <?= $this->Form->postLink('Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', ['controller' => 'order_labs', 'action' => 'index'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
        </div>
    </div>

</div>

<script>

    var ordered_count = <?=$total_count?>;
    var groups = <?=json_encode($groups)?>;

//alert(groups["oximetry"]["ids"].length);

    //var api = flowplayer();

    $(document).ready(function(){
        $('.scroll-pane-arrows').jScrollPane(
        {showArrows:false,scrollbarWidth:6,verticalGutter: 0,hideFocus:true}
        );
        
        //$( ".question_wrapper" ).css( "display", "block" );
        
    });

    function orderLab(lab_id, section_name, group) {

        var returned;
        var confirm_message;
        var confirmed = false;
        var button_text = $("#order-button-" + lab_id);

        if (ordered_count >= <?=$lab_order_cap?> && $("#order-button-" + lab_id).html() == "Order") {
            alert("You have ordered the maximum number of labs.");
        } else {

            if (group != undefined && button_text.html() == "Order") {
                confirm_message = "This study is part of a group. \n(The other studies in this group also are colored " + groups[group]["color"] + ".)\n If you select 'OK' this study will be ordered and the rest will become unavailable. Selecting 'Cancel' cancels the order.";
                if (confirm(confirm_message)) {
                    confirmed = true;
                }
            }

            if (group == undefined || confirmed == true) {
                var url = "<?php echo $this->Url->build(['controller' => 'OrderLabs', 'action' => 'order_lab']);?>";

                var posting = $.post( url, { lab_id:lab_id, section_name:section_name } );
             
                posting.done(function( data ) {
                        try {
                            returned = JSON.parse(data);
                            $("#lab_ordered").html(returned['lab']);
                            $("#lab_result").html(returned['result']);
                            document.getElementById('page_description').style.display='none';
                            document.getElementById('lab_results').style.display='block';

                            if(returned['pict_ordered'] > '') {
                                document.getElementById('image').innerHTML = '<a href="javascript:getLabImage(\'' + returned['pict_ordered_lg'] + '\');"><img src="'+returned['pict_ordered']+'" class="responsive-image" /></a>';
                            } else {
                                document.getElementById('image').innerHTML = '<img class="responsive-image" src="<?=$poster?>" alt="" />';
                            }

                            //api.play(JSON.parse(data));
                            if (button_text.html() == "Order") {
                                ordered_count = ordered_count + 1;
                                $("#ordered_count").html(ordered_count);
                                button_text.html('Review');
                            }

                            if (group != undefined && button_text != "Order") {
                                for (var i = 0;i < groups[group]["ids"].length;i++) {
                                    if (groups[group]["ids"][i] != lab_id) {
                                        button_text = $("#order-button-" + groups[group]["ids"][i]);
                                        button_text.addClass('hidden');
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
    }
</script>
