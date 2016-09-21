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

            <div id="video_div">
            </div>

        </div>
			</div>

			<!--left bottom-->
			<?php if (!empty($page->pages_desc)) {?>
			<div class="row">
				<div class="col-md-12 well left-bottom">
					<?=$page->pages_desc?>
				</div>
			</div>
			<?php }?>

		</div>
	</div>

	<!--right column-->
	<div class="col-md-7 well right-column">
		
		<div class="col-md-12">
			<?=$page->pages_text?>
		</div>

	</div>

    <!--nav-->  
    <div class="row">
        <div class="col-md-10">
            <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', ['controller' => 'feedback'], ['class' => 'btn btn-default btn-md previous-button', 'escape' => false])?>
        </div>
        <div class="col-md-2 pull-right">
            <?= $this->Html->link('Mark Completed <span class="glyphicon glyphicon-check" aria-hidden="true"></span>', ['controller' => 'custom_pages', 'action' => 'completed'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
        </div>
    </div>

</div>

<script>

$(document).ready(function(){
    var api;

    api = flowplayer("#video_div", {
      ratio: 9/16,
      clip: {
        sources: [
          { type: "video/mp4", src: "<?=$videos['http']?>"  }
        ],
        title: ""
      },
      autoplay: true,
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


