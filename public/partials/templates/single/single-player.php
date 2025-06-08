<?php 
$id         = get_the_ID();
$data       = new TOROTUBE_Post;
$playerp    = $data->get_player($id);
$thumb      = $data->get_thumb($id);
$thumb_up   = $data->get_thumb_up($id);
$thumb_down = $data->get_thumb_down($id);
$views      = $data->get_views($id);
$duration   = $data->get_duration($id);
?>


<div class="bx-video snow-b mt16 bw1 line-d"
	x-data="{ opt: '01' }">
    
    <?php if( count($playerp) > 0 ){ ?>
    <div class="vdop dfx body-b">
        <?php foreach ($playerp as $key => $pl) { 
            $it = $key + 1; 
            $itf = sprintf('%02d', $it);
            $lang_opt = lang_torotube('Option', 'lang_option');
            $lang_opt_cust = get_option( 'lang_custom_option' . $it );
            ?>
            <button data-position="<?php echo $key; ?>" class="pl-tk btn body-b text-c bwl1 bwr1 line-d fg0" :class="{ 'snow-b link-c on': opt === '<?php echo $itf; ?>' }" @click="opt = '<?php echo $itf ; ?>'">
                <span class="fwb f12 ttu"> <?php echo ($lang_opt_cust) ? $lang_opt_cust : $lang_opt . ' ' . $it; ?></span>
            </button>
        <?php } ?>
    </div>

    <div class="frm dark-b zi1">
        <?php $player_inside = get_option( 'player_inside' );
        if($player_inside){ ?>
            <div id="player-inside" class="clsnply poa lt0 tp0 w100p h100p dfx aic jcc py08 dark-bgt-05 zi2">
                <div class="w100p">
                    <div class="dvr"><?php echo $player_inside; ?></div>
                    <button id="player-inside-btn" class="btn w100p mt08 fwb op08-h" type="button"><?php echo lang_torotube('Close and play', 'lang_close_play'); ?></button>
                </div>
            </div>
        <?php } ?>
        
        <div id="player-torotube">
            <?php if(filter_var($playerp[0], FILTER_VALIDATE_URL)) { ?>
                <iframe width="929" height="523" src="<?php echo $playerp[0]; ?>" title="<?php the_title(); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php }  else { 
                echo $playerp[0]; 
            } ?>
        </div>
        
    </div>

    <?php 
    $video_views       = get_option('video_views');
    $video_comments    = get_option('video_comments');
    $video_favorites   = get_option('video_favorites');
    $video_watch_later = get_option('video_watch_later');
    $video_share       = get_option('video_share');
    $video_thumbs      = get_option('video_thumbs');
    
    ?>

    <ul class="dfx py08 bwb1 line-d aic fww mt0 tac jcc">
        <?php if($video_views){ ?>
            <li class="px16">
                <span class="fwb"><?php echo $views; ?> <span class="f14 fwn"><?php echo lang_torotube('views', 'lang_views'); ?></span></span>
            </li>
        <?php } ?>

        <?php if($video_thumbs){ ?>
            <li class="mr0 mga e-or3">
                <div class="dfx fww">
                    <button id="vote-up" class="btn py0 bgt text-c link-c-h f14 px16 fg1" type="button"><i class="fa-thumbs-up far mr08"></i> <span id="num_vote_up"><?php echo $thumb_up; ?></span></button>
                    <button id="vote-down" class="btn py0 bgt text-c link-c-h f14 px16 fg1" type="button"><i class="fa-thumbs-down far mr08"></i> <span id="num_vote_down"><?php echo $thumb_down; ?></span></button>
                    <div class="progress co01-bgt-01 fb1">
                        <span style="width: <?php echo $thumb; ?>;" class="co01-b h08 dbk f08"></span>
                    </div>
                </div>
            </li>
        <?php } ?>

        <li class="dvbr fb1 pt08 mt08 px08 bwt1 line-d e-dno"><span class="sr-only">separator</span></li>
        
        <?php 
        if($video_comments){ ?>
            <li class="fg1 b-fg0 px04 c-f14 d-f16">
                <a class="f14 text-c link-c-h btn py0 px08 bgt" href="#comments"><i class="fa-comment far b-mr08"></i><span class="dno b-dbk"><?php echo lang_torotube('Comments', 'lang_comments'); ?> <span class="fwb ml04"><?php echo get_comments_number($id); ?></span></span></a>
            </li>
        <?php } ?>

        <?php
        /* FAVORITE */
        if($video_favorites && is_user_logged_in()){ 
            $user_id  = get_current_user_id();
            $favorite = get_user_meta( $user_id, 'user_favorite', true );
            if($favorite){
                $statusf = (in_array($id, $favorite )) ? 'favorite' : 'nofavorite';
            } else {
                $statusf = 'nofavorite'; 
            }
        ?>
            <li class="fg1 b-fg0 px04 c-f14 d-f16">
                <button data-status="<?php echo $statusf; ?>" id="favorite-user" class=" btn f14 py0 px08 bgt text-c link-c-h" type="button"><i id="favorite-active" class="fa-heart <?php echo ( $statusf == 'favorite' ) ? 'fa' : 'far' ; ?> b-mr08"></i><span class="dno b-dbk"><?php echo lang_torotube('Favorites', 'lang_favorites'); ?></span></button>
            </li>
        <?php } 

        /* WATCH LATER */
        if($video_watch_later && is_user_logged_in()){ 
            $user_id  = get_current_user_id();
            $watch    = get_user_meta( $user_id, 'user_watch', true );
            if($watch){
                $statusw = (in_array($id, $watch )) ? 'watch' : 'nowatch';
            } else {
                $statusw = 'nowatch'; 
            }
        ?>
            <li class="fg1 b-fg0 px04 c-f14 d-f16">         
                <button data-status="<?php echo $statusw; ?>" id="watch-user" class="btn f14 py0 px08 bgt text-c link-c-h" type="button"><i id="watch-active" class="<?php echo ( $statusw == 'watch' ) ? 'fa-check' : 'fa-clock' ; ?> far b-mr08"></i><span class="dno b-dbk"><?php echo lang_torotube('Watch Later', 'lang_watch_later'); ?></span></button>
              
            </li>
        <?php } ?>
        
        <?php $download_link = get_post_meta($id, 'eroz_ads_link', true); 
        if($download_link){ ?>
            <li class="fg1 b-fg0 px04 c-f14 d-f16">
                <a href="<?php echo $download_link; ?>" target="_blank" rel="noopener noreferrer" class="btn f14 py0 px08 bgt text-c link-c-h"><i class="fa-arrow-to-bottom far b-mr08"></i><span class="dno b-dbk"><?php echo lang_torotube('Download', 'lang_download'); ?></span></a>
            </li>
        <?php } ?>

        <?php if($video_share){ ?>
            <li class="fg1 b-fg0 px04 c-f14 d-f16 por"
            x-data="{ dpd: false }"
            @keydown.escape="{ dpd = false }">
                <button class="btn f14 py0 px08 bgt text-c link-c-h" type="button"
                :class="{ 'co01-c': dpd }"
                @click="dpd = !dpd">
                    <i class="fa-share-alt far b-mr08"></i><span class="dno b-dbk"><?php echo lang_torotube('Share', 'lang_share'); ?></span>
                </button>
                <ul class="dpd share-dpd sub-menu b-poa tp100 mt04 snow-b line-d bw1 br04 pd08 zi9 f14 tai" 
                :class="{ 'dbk': dpd }"
                x-show.transition="dpd" 
                @click.away="dpd = false"
                x-cloak>
                    <li class="fa-facebook-f fab"><a href="javascript:void(0)" onclick="window.open ('https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');">Facebook</a></li>
                    <li class="fa-twitter fab"><a href="javascript:void(0)" onclick="javascript:window.open('https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');">Twitter</a></li>
                </ul>
            </li>
        <?php } ?>

        
        <?php 
        $report_user = get_option('torotube_enable_user');

        switch ($report_user) {
            case 'user_register':
                if(is_user_logged_in()){ get_template_part( 'public/partials/templates/single/single', 'report' ); }
                break;
            case 'user_no_register':
                if(!is_user_logged_in()){ get_template_part( 'public/partials/templates/single/single', 'report' ); }
                break;
            default:
                get_template_part( 'public/partials/templates/single/single', 'report' );
                break;
        }
        
        ?>
    </ul>
    <?php } ?>
    <div class="entry pd16 c-pd24">
        <?php the_content(); ?>
        <p class="f12"><?php echo get_the_date(); ?></p>
    </div>
</div>