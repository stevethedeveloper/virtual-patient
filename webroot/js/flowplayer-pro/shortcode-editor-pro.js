jQuery(document).on('fv_flowplayer_shortcode_parse', function(e, shortcode, remains) {

  document.getElementById("fv_wp_flowplayer_field_lightbox").checked = 0;
  document.getElementById("fv_wp_flowplayer_field_lightbox_width").value = '';
  document.getElementById("fv_wp_flowplayer_field_lightbox_height").value = '';
  document.getElementById("fv_wp_flowplayer_field_lightbox_caption").value = '';
  document.getElementById("fv_wp_flowplayer_field_start").value = '';
  document.getElementById("fv_wp_flowplayer_field_end").value = '';
    
  var sLightbox = shortcode.match( /lightbox="(.*?)"/ );
  if( sLightbox && typeof(sLightbox) != "undefined" && typeof(sLightbox[1]) != "undefined" ){
    sLightbox = sLightbox[1];
    fv_wp_fp_shortcode_remains = fv_wp_fp_shortcode_remains.replace( /lightbox="(.*?)"/, '' );  
    
    if( sLightbox ) {
      aLightbox = sLightbox.split(/[;]/,4);
      if( aLightbox.length > 2 ) {
        for( var i in aLightbox ) {			
          if( i==0 && aLightbox[i] == 'true' ){
            document.getElementById("fv_wp_flowplayer_field_lightbox").checked = 1;
          } else if( i==1 ){
            document.getElementById("fv_wp_flowplayer_field_lightbox_width").value = parseInt(aLightbox[i]);
          } else if( i==2 ){
            document.getElementById("fv_wp_flowplayer_field_lightbox_height").value = parseInt(aLightbox[i]);
          } else if( i==3 ){
            document.getElementById("fv_wp_flowplayer_field_lightbox_caption").value = aLightbox[i].trim();
          }
        }
      } else {
        if( typeof(aLightbox[0]) != "undefined" && aLightbox[0] == 'true' ){
          document.getElementById("fv_wp_flowplayer_field_lightbox").checked = 1;
        }
        if( typeof(aLightbox[1]) != "undefined" ) {
          document.getElementById("fv_wp_flowplayer_field_lightbox_caption").value = aLightbox[1].trim();
        }
      }
    }
  }
  
  document.getElementById("fv_wp_flowplayer_field_qsel").checked = 0;
  jQuery('#fv_player_shortcode_editor_qualities_sample').html('Make sure your video is using the quality prefixes from your settings.');
  
  document.getElementById("fv_wp_flowplayer_field_ab").checked = 0;
  
  var sQSel = shortcode.match( /qsel="(.*?)"/ );
  if( sQSel && typeof(sQSel) != "undefined" && typeof(sQSel[1]) != "undefined" ){
    sQSel = sQSel[1];
    fv_wp_fp_shortcode_remains = fv_wp_fp_shortcode_remains.replace( /qsel="(.*?)"/, '' );            
    if( sQSel && sQSel == "true" ) {
      document.getElementById("fv_wp_flowplayer_field_qsel").checked = 1;
    }
  }
  
  var sAB = shortcode.match( /ab="(.*?)"/ );
  if( sAB && typeof(sAB) != "undefined" && typeof(sAB[1]) != "undefined" ){
    sAB = sAB[1];
    fv_wp_fp_shortcode_remains = fv_wp_fp_shortcode_remains.replace( /ab="(.*?)"/, '' );            
    if( sAB && sAB == "true" ) {
      document.getElementById("fv_wp_flowplayer_field_ab").checked = 1;
    }
  }  
  
  jQuery('#fv_wp_flowplayer_field_video_ads').prop('selectedIndex',0);
  var sAds = shortcode.match( /ads="(.*?)"/ ), iAds = 0;
  if( sAds && typeof(sAds) != "undefined" && typeof(sAds[1]) != "undefined" ){
    sAds = sAds[1];
    iAds = parseInt(sAds);
    fv_wp_fp_shortcode_remains = fv_wp_fp_shortcode_remains.replace( /ads="(.*?)"/, '' );            
    if( sAds && sAds == "random" ) {
      document.getElementById("fv_wp_flowplayer_field_video_ads").selectedIndex = 2;
    } else if( sAds && sAds == "no" ) {
      document.getElementById("fv_wp_flowplayer_field_video_ads").selectedIndex = 1;
    } else if( sAds && iAds > 0 ) {
      document.getElementById("fv_wp_flowplayer_field_video_ads").selectedIndex = 2 + iAds;
    }
  }
  
  fv_wp_flowplayer_shortcode_parse_arg( shortcode, 'start', false, 'fv_wp_flowplayer_field_start' );
  fv_wp_flowplayer_shortcode_parse_arg( shortcode, 'end', false, 'fv_wp_flowplayer_field_end' );

  /*if( sloop != null && sloop[1] != null && sloop[1] == 'true' )
    document.getElementById("fv_wp_flowplayer_field_lightbox").checked = 1;*/
  
} );

jQuery(document).on('fv_flowplayer_shortcode_create', function(e) {
  if( document.getElementById("fv_wp_flowplayer_field_lightbox").checked ) {
    var iWidth = parseInt(document.getElementById("fv_wp_flowplayer_field_lightbox_width").value);
    var iHeight = parseInt(document.getElementById("fv_wp_flowplayer_field_lightbox_height").value);
    var sSize = ( iWidth && iHeight ) ? ';'+iWidth+';'+iHeight : '';
    var sCaption = ';'+document.getElementById("fv_wp_flowplayer_field_lightbox_caption").value.trim();
    fv_wp_fp_shortcode += ' lightbox="true'+sSize+sCaption+'"';
  }
  
  if( document.getElementById("fv_wp_flowplayer_field_ab").checked ) {
    fv_wp_fp_shortcode += ' ab="true"';
  }
  if( document.getElementById("fv_wp_flowplayer_field_qsel").checked ) {
    fv_wp_fp_shortcode += ' qsel="true"';
  }  
  
  fv_wp_flowplayer_shortcode_write_arg('fv_wp_flowplayer_field_video_ads', 'ads', false, false, ['no','random','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'] );
  
  fv_wp_flowplayer_shortcode_write_args('fv_wp_flowplayer_field_start','start');
  fv_wp_flowplayer_shortcode_write_args('fv_wp_flowplayer_field_end','end');
} );


setInterval( function() {
  if( typeof(fv_player_pro_has_qualities) == "undefined" || document.getElementById("fv_wp_flowplayer_field_src") == null ) return;
  
  var sURL = document.getElementById("fv_wp_flowplayer_field_src").value;
  if( sURL && document.getElementById("fv_wp_flowplayer_field_qsel").checked ) {
    var sQualityHint = '';
    var sMatched = '';
    for( var i in fv_player_shortcode_editor_qualities ){
      if( sURL.match(i) ) {
        var sQualityHint = 'Your primary video matches '+fv_player_shortcode_editor_qualities[i]+' quality. Make sure following is available: <ul>';
        sMatched = i;
      }
    }
      
    for( var i in fv_player_shortcode_editor_qualities ){
      if( i == sMatched ) continue;
      sQualityHint += '<li>'+fv_player_shortcode_editor_qualities[i]+': <strong>'+sURL.replace(sMatched,i)+'</strong></li>';
    }
    sQualityHint += '</ul>';
    
    if( !sMatched ){
      sQualityHint = "Your primary video is not matching the quality prefixes!";
      jQuery('#fv_player_shortcode_editor_qualities_sample_wrap').show();
    }
    jQuery('#fv_player_shortcode_editor_qualities_sample').html(sQualityHint);
  }
}, 250 );