<?php
    echo $this->Html->css('fv-player-pro/style.css?ver=0.6.5', ['id' => 'fv-player-pro-css', 'type' => 'text/css', 'media' => 'all']);
    echo $this->Html->css('fv-flowplayer-custom/style-1.css?ver=1448119277', ['id' => 'fv_flowplayer-css', 'type' => 'text/css', 'media' => 'all']);
    echo $this->Html->script('jquery/jquery-migrate.min.js?ver=1.2.1');
    echo $this->Html->script('flowplayer/fv-flowplayer.min.js?ver=6.0.3.10');
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

            <!--left top-->
            <div class="row">
                <div class="col-md-12 well left-top">
                    <h1>Feedback</h1>
                    <div id="media_div">
                        <div id="image">
                            <img src="<?=$poster?>" alt="" />
                        </div>
                        <div id="video_div" class="fixed-controls">
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
              <a href="<?= $this->Url->build(['controller' => 'Feedback', 'action' => 'index'])?>" role="button" class="btn btn-default">Study</a>
            </div>
            <div class="btn-group" role="group">
              <a href="<?= $this->Url->build(['controller' => 'Feedback', 'action' => 'counseling'])?>" role="button" class="btn btn-default">Counseling</a>
            </div>
            <div class="btn-group" role="group">
              <a href="<?= $this->Url->build(['controller' => 'Feedback', 'action' => 'medication'])?>" role="button" class="btn btn-default">Medication</a>
            </div>
            <div class="btn-group" role="group">
              <a href="<?= $this->Url->build(['controller' => 'Feedback', 'action' => 'referral'])?>" role="button" class="btn btn-default">Referral</a>
            </div>
            <div class="btn-group" role="group">
              <a href="<?= $this->Url->build(['controller' => 'Feedback', 'action' => 'billing'])?>" role="button" class="btn btn-primary">Billing</a>
            </div>
        </div>
        <br />
        
        <div class="col-md-12 scroll-pane-arrows">

            <div class="col-md-11">
                <?php
                foreach ($yield_names as $yield_key => $yield_name) {
                ?>
               
                    <div class="row">
                        <div class="col-md-12">
                            <h3><?=$yield_name?></h3>
                            <hr />
                            <?php if (count($feedback_array['ordered'][$yield_key]) > 0) {?>
                                <?php foreach ($feedback_array['ordered'][$yield_key] as $val) {?>
                                    <strong>Study:</strong> <?=$val['study']?>
                                    <br />
                                    <strong>Status:</strong> <?=$val['status']?>
                                    <br />
                                    <strong>Rationale:</strong> <?=$val['rationale']?>
                                    <br />
                                    <?php if (!empty($val['video'])) {?>
                                        <strong>Video:</strong> <a href="javascript:playVideo('<?=$val['video']?>');">More Information</a>
                                    <?php } elseif (!empty($val['photo'])) {?>
                                        <strong>Photo:</strong> <a href="javascript:showThumbnail('<?=$val['photo']?>', '<?=$val['photo_lg']?>');">More Information</a>
                                    <?php }?>
                                    <br /><br />
                                <?php }?>
                                <hr />
                            <?php }?>
                            <?php if (count($feedback_array['not_ordered'][$yield_key]) > 0) {?>
                                <br />
                                <?php foreach ($feedback_array['not_ordered'][$yield_key] as $val) {?>
                                    <strong>Study:</strong> <?=$val['study']?>
                                    <br />
                                    <strong>Status:</strong> <?=$val['status']?>
                                    <br />
                                    <strong>Rationale:</strong> <?=$val['rationale']?>
                                    <br />
                                    <?php if (!empty($val['video'])) {?>
                                        <strong>Video:</strong> <a href="javascript:playVideo('<?=$val['video']?>');">More Information</a>
                                    <?php } elseif (!empty($val['photo'])) {?>
                                        <strong>Photo:</strong> <a href="javascript:showThumbnail('<?=$val['photo']?>', '<?=$val['photo_lg']?>');">More Information</a>
                                    <?php }?>
                                    <br />
                                    <br />
                                <?php }?>
                                <hr />
                            <?php }?>
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

    <!--nav-->  
    <div class="row">
        <div class="col-md-10">
            <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', ['controller' => 'feedback', 'action' => 'referral'], ['class' => 'btn btn-default btn-md previous-button', 'escape' => false])?>
        </div>
        <div class="col-md-2 pull-right">
            <?= $this->Html->link('Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', ['controller' => 'summary'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
        </div>
    </div>

</div>

<script>

    var api = flowplayer();

    $(document).ready(function(){
        $('.scroll-pane-arrows').jScrollPane(
        {showArrows:false,scrollbarWidth:6,verticalGutter: 0,hideFocus:true}
        );

        document.getElementById('video_div').style.display='none';
    });

    function showThumbnail(image, large_image) {
        api.stop();
        document.getElementById('video_div').style.display='none';
        document.getElementById('image').style.display='block';
        document.getElementById('image').innerHTML = '<a href="javascript:getLabImage(\'' + large_image + '\');"><img src="'+image+'" class="responsive-image" /></a>';
    }

    $(document).ready(function(){
        
        api = flowplayer("#video_div", {
          ratio: 9/16,
          clip: {
            sources: [
              { type: "video/mp4", src: "<?=$video_path['http']?>case1_interstitial08.mp4" }
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

    function playVideo(video_file_name) {
        document.getElementById('video_div').style.display='block';
        document.getElementById('image').style.display='none';
        api.play("<?=$video_path['http']?>" + video_file_name);
    }
</script>
