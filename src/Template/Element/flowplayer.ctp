<?php
if (empty($streamer_path) || empty($ios_path) || empty($folder) || empty($videos->video_file_name)) {
?>
<div class="flowplayer headshot" style="max-width: 640px; max-height: 360px;">
  <video poster="<?=$poster?>">
  </video>
</div>
<?php
} else {

    echo $this->Html->script('jquery/jquery.js');
?>
<?php
echo $this->Html->css('fv-player-pro/style.css?ver=0.6.5', ['id' => 'fv-player-pro-css', 'type' => 'text/css', 'media' => 'all']);
echo $this->Html->css('fv-flowplayer-custom/style-1.css?ver=1448119277', ['id' => 'fv_flowplayer-css', 'type' => 'text/css', 'media' => 'all']);

echo $this->Html->script('jquery/jquery-migrate.min.js?ver=1.2.1');
?>
<div id="wpfp_51f3572714b228c37acdecd2dc46d2ba" class="flowplayer no-brand play-button" data-embed="false" style="max-width: 640px; max-height: 360px; " data-rtmp="rtmp://<?=$streamer_path?>" data-ratio="0.5625">
  <video <?=(isset($autoplay) && $autoplay === true) ? 'autoplay' : ''?> <?php if ((!isset($autoplay) || $autoplay === false) && (isset($poster) && !empty($poster))) echo 'poster="'.$poster.'"';?>>
    <source src="http://<?=$ios_path?><?=$folder?>/<?=$videos->video_file_name?>" type="video/mp4" />
      <source src="mp4:<?=$folder?>/<?=$videos->video_file_name?>" type="video/flash" />
    </video>
    <div class='fv-player-buttons-wrap'>
      <div class='fv-player-buttons fv-player-buttons-center'>
        <ul class='fv-player-speed'>
          <li>
            <a class='fv_sp_slower'>&#45;</a>
          </li>
          <li>
            <a class='fv_sp_faster'>&#43;</a>
          </li>
        </ul>
      </div>
    </div>
</div>
				
<script type='text/javascript'>
/* <![CDATA[ */
var fv_flowplayer_conf = {
  "embed": {
    "library":"\/\/wipediseases.org\/virtual_patient\/js\/flowplayer\/fv-flowplayer.min.js",
    "script":"\/\/wipediseases.org\/virtual_patient\/js\/flowplayer\/embed.min.js",
    "skin":"\/\/wipediseases.org\/virtual_patient\/css\/flowplayer\/flowplayer.css",
    "swf":"\/\/wipediseases.org\/virtual_patient\/flowplayer\/flowplayer.swf?ver=6.0.3.10",
    "swfHls":"\/\/wipediseases.org\/virtual_patient\/flowplayer\/flowplayerhls.swf?ver=6.0.3.10"
  },
  "swf":"\/\/wipediseases.org\/virtual_patient\/flowplayer\/flowplayer.swf?ver=6.0.3.10",
  "swfHls":"\/\/wipediseases.org\/virtual_patient\/flowplayer\/flowplayerhls.swf?ver=6.0.3.10",
  "key":"$592816610658857",
  "safety_resize":"1",
  "volume":"1"
};
var fv_flowplayer_translations = {"0":"","1":"Video loading aborted","2":"Network error","3":"Video not properly encoded","4":"Video file not found","5":"Unsupported video","6":"Skin not found","7":"SWF file not found","8":"Subtitles not found","9":"Invalid RTMP URL","10":"Unsupported video format. Try installing Adobe Flash.","11":"Click to watch the video","12":"[This post contains video, click to play]","video_expired":"<h2>Video file expired.<br \/>Please reload the page and play it again.<\/h2>","unsupported_format":"<h2>Unsupported video format.<br \/>Please use a Flash compatible device.<\/h2>","mobile_browser_detected_1":"Mobile browser detected, serving low bandwidth video.","mobile_browser_detected_2":"Click here","mobile_browser_detected_3":"for full quality.","live_stream_failed":"<h2>Live stream load failed.<\/h2><h3>Please try again later, perhaps the stream is currently offline.<\/h3>","live_stream_failed_2":"<h2>Live stream load failed.<\/h2><h3>Please try again later, perhaps the stream is currently offline.<\/h3>","what_is_wrong":"Please tell us what is wrong :","full_sentence":"Please give us more information (a full sentence) so we can help you better","error_JSON":"Admin: Error parsing JSON","no_support_IE9":"Admin: Video checker doesn't support IE 9.","check_failed":"Admin: Check failed.","video_issues":"Video Issues"};
var fv_fp_ajaxurl = "https:\/\/wipediseases.org\/wp-admin\/admin-ajax.php";
var fv_flowplayer_playlists = [];
var fv_flowplayer_browser_chrome_mp4_array = {"51f3572714b228c37acdecd2dc46d2ba":"1"};
/* ]]> */
</script>

<?php
echo $this->Html->script('flowplayer/fv-flowplayer.min.js?ver=6.0.3.10');
?>

<script type='text/javascript'>
/* <![CDATA[ */
var fv_player_pro = {"ajaxurl":"https:\/\/wipediseases.org\/wp-admin\/admin-ajax.php","autoplay_once":"","chapters":[],"cloudfront":"","debug":"","lightbox":[],"lightbox_images":"","playlist":[],"static_playlist":[],"start_end":[],"video_ads":[],"youtube":""};
/* ]]> */
</script>

<?php
echo $this->Html->script('flowplayer-pro/fv_player_pro.min.js?ver=0.6.5');
?>

<!--fv-flowplayer-footer-->

    <script type="text/javascript">
        jQuery(document).ready(function(){
            ! function($){
                "use strict";
                var $wrap = $('#wrap'),
                    $footer = $('footer#footer'),
                    $reset_margin_top = $('#tc-reset-margin-top'),
                    $html = $('html'),
                    $body = $('body'),
                    $push = $('#push'),
                    isCustomizing = $('body').hasClass('is-customizing'),
                    isUserLogged = ! isCustomizing && ( $('body').hasClass('logged-in') || 0 !== $('#wpadminbar').length ),
                    stickyEnabled = $body.hasClass('tc-sticky-header'),
                    resizeBodyHtml = isUserLogged || stickyEnabled,
 
                    $window_width = $(window).width();
                
                function resize_body_html(timeout){
                    if ( ! resizeBodyHtml )
                        return;
 
                    setTimeout(function(){
                        if ( isUserLogged ){
                            $html.css('height', '100%');
                            $html.css('height', parseInt($html.css('height')) - $('#wpadminbar').height() );
                        }
 
                        if ( stickyEnabled ){
                            $body.css('height', '100%');
                            $body.css('height', parseInt($body.css('height')) - parseInt( $reset_margin_top.css('marginTop') ) );
                        }
                    }, timeout ) ;
                }
 
                function render_sticky_footer(){
                    var $push_height = parseInt( $footer.css('height') ) + parseInt( $footer.css('borderTopWidth') ) + parseInt( $footer.css('borderBottomWidth') ) + 1,
                        $wrap_b_margin = -1 * $push_height;
 
                    $wrap.css('marginBottom', $wrap_b_margin );
                    $push.css('height', $push_height );
                }
 
                render_sticky_footer();
                resize_body_html(50);
 
                $(window).resize(function(){
                    setTimeout( function(){
                        // re-render on resizing only if an "interesting" resing occurred
                        if ( Math.abs($(window).width() - $window_width) > 50 ){
                            render_sticky_footer();
                            $window_width = $(window).width();
                        }
                        resize_body_html(50);
                    }, 100);
                });
            }(window.jQuery);
         });    
    </script>
<?php
}
?>