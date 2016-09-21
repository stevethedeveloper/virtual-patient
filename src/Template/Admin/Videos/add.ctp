<?php
echo $this->Html->css('fv-player-pro/style.css?ver=0.6.5', ['id' => 'fv-player-pro-css', 'type' => 'text/css', 'media' => 'all']);
echo $this->Html->css('fv-flowplayer-custom/style-1.css?ver=1448119277', ['id' => 'fv_flowplayer-css', 'type' => 'text/css', 'media' => 'all']);

echo $this->Html->script('jquery/jquery-migrate.min.js?ver=1.2.1');

echo $this->Html->script('flowplayer/fv-flowplayer.min.js?ver=6.0.3.10');
?>
<style>
#video_div {
    display: none;
}
</style>
<?= $this->Form->create($video) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Add Video</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $case_id]);
                    echo $this->Form->input('video_file_name');
                    echo $this->Form->input('video_nice_name');
                ?>
            </fieldset>
        </div>
    </div>

    <div class="col-md-8 panel panel-default">
        <button id="play-button-test" type="button" class="btn btn-default btn-md" onClick="javascript:playVideo(<?=$case_id_nav?>);">Test</button>
        <div id="media_div">
            <div id="video_div" class="fixed-controls">
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
<?= $this->Form->end() ?>
<script>

    var api = flowplayer();

    function playVideo(case_id) {

        var video_name = $('#video-file-name').val();

        var url = "<?php echo $this->Url->build(['controller' => 'Videos', 'action' => 'play_video']);?>";

        var posting = $.post( url, { video_name:video_name, case_id:case_id } );
     
        posting.done(function( data ) {
                try {
                    document.getElementById('video_div').style.display='block';
                    //$("#video_div").html(data);
                    api.play(JSON.parse(data));
                }
                catch(err) {
                    $( "#video_div" ).empty().append( data );
                }
        });
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
