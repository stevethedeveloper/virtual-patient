<?php
echo $this->Html->css('fv-player-pro/style.css?ver=0.6.5', ['id' => 'fv-player-pro-css', 'type' => 'text/css', 'media' => 'all']);
echo $this->Html->css('fv-flowplayer-custom/style-1.css?ver=1448119277', ['id' => 'fv_flowplayer-css', 'type' => 'text/css', 'media' => 'all']);

echo $this->Html->script('jquery/jquery-migrate.min.js?ver=1.2.1');

echo $this->Html->script('flowplayer/fv-flowplayer.min.js?ver=6.0.3.10');
?>
<div class="row two-column-video">

    <!--left column-->
    <div class="col-md-5 left-column">
        <div class="col-md-12">

            <!--left top-->
            <div class="row">
                <div class="col-md-12 well left-top">
                    <h1><?php echo $page->pages_title; ?></h1>
                    
                    <div id="media_div">
                        <div id="image_div">
                            <img src="<?=$poster?>" alt="" />
                        </div>

                        <div id="video_div" class="fixed-controls">
                        </div>
                    </div>                    
                </div>
            </div>

            <!--left middle-->
            <div class="row">
                <div class="col-md-12 well left-middle">
                    <div id="count_div">
                    You have asked <strong id="asked_count"><?=$total_count?></strong> of a possible <strong><?=$history_question_cap?></strong> questions.
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
        <div class="col-md-12 scroll-pane-arrows">
            <?php foreach($questions as $group) {?>
                    <?php
                    if (count($group->history_questions) === 0) {
                        continue;
                    }
                    ?>
                <h1><?=$group->name?></h1>
                <?php foreach($group->history_questions as $q) {?>
                    <div class="row">
                        <div class="col-md-2">
                            <?php
                                if (!in_array($q->id, $already_asked)) {
                            ?>
                                    <button id="play-button-<?=$q->video_id?>" type="button" class="btn btn-default btn-md" onClick="javascript:playVideo('<?=$q->video_id?>', '<?=$q->id?>', 'history_questions');">Ask</button>
                            <?php
                                } else {
                            ?>
                                    <button id="play-button-<?=$q->video_id?>" type="button" class="btn btn-default btn-md" onClick="javascript:playVideo('<?=$q->video_id?>', '<?=$q->id?>', 'history_questions');">Review</button>
                            <?php }?>
                        </div>
                        <div class="col-md-10">
                            <?=$q->question?>
                        </div>
                    </div>
                    <br />
                <?php }?>
            <?php }?>
            <br /><br />

        </div>

    
    </div>

    <!--nav-->  
    <div class="row">
        <div class="col-md-10">
            <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', ['controller' => 'custom_pages', 'action' => 'intro'], ['class' => 'btn btn-default btn-md previous-button', 'escape' => false])?>
        </div>
        <div class="col-md-2 pull-right">
            <?= $this->Form->postLink('Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', ['controller' => 'history_questions', 'action' => 'index'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
        </div>
    </div>

</div>

<script>

    var asked_count = <?=$total_count?>;
    var api = flowplayer();

    $(document).ready(function(){
        $('.scroll-pane-arrows').jScrollPane(
        {showArrows:false,scrollbarWidth:6,verticalGutter: 0,hideFocus:true}
        );
        
    });

    function playVideo(video_id, question_id, section_name) {

        if (asked_count >= <?=$history_question_cap?> && $("#play-button-" + video_id).html() == "Ask") {
            alert("You have asked the maximum number of questions.");
        } else {

            var url = "<?php echo $this->Url->build(['controller' => 'HistoryQuestions', 'action' => 'play_video']);?>";

            var posting = $.post( url, { video_id:video_id, question_id:question_id, section_name:section_name } );
         
            posting.done(function( data ) {
                    try {
                        document.getElementById('image_div').style.display='none';
                        //$("#video_div").html(data);
                        api.play(JSON.parse(data));
                        var button_text = $("#play-button-" + video_id);
                        if (button_text.html() == "Ask") {
                            asked_count = asked_count + 1;
                            $("#asked_count").html(asked_count);
                            button_text.html('Review');
                        }
                    }
                    catch(err) {
                        $( "#video_div" ).empty().append( data );
                    }
            });
        }
    }

    $(document).ready(function(){
        
        api = flowplayer("#video_div", {
          ratio: 9/16,
          clip: {
            sources: [
              { type: "video/mp4", src: "<?=$videos['http']?>"  }
            ],
            title: ""
          },
          embed: {
            skin: "//releases.flowplayer.org/6.0.4/skin/minimalist.css"
          }
        });

        $(".video_link").on("click", function(e) {
            e.preventDefault();
            api.play($(this).attr("href"));
        });
    });

</script>
