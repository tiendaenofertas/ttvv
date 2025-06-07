<?php 

$block = $args['block']; 

$title_section      = ( $block->latest_title ) ? $block->latest_title : false;
$url_section        = ( $block->latest_url ) ? $block->latest_url : false;
$number_section     = ( $block->latest_number ) ? $block->latest_number : 10;
$enable_ads_section = ( $block->latest_ads_enabled ) ? $block->latest_ads_enabled : 0;
$enable_ads         = ( $block->latest_ads ) ? $block->latest_ads : false;
$video_favorites    = get_option('video_favorites');
$video_watch_later  = get_option('video_watch_later');
$user_id            = get_current_user_id();
$favorite           = get_user_meta( $user_id, 'user_favorite', true ); 
$watch              = get_user_meta( $user_id, 'user_watch', true );

?>

<section class="mt24 c-mt32">

    <?php if($title_section or $url_section){ ?>
        <header class="dfx aic fww f12 c-f16">
            <?php 
            echo ($title_section) ? '<h2 class="ttl f24 h123-c py08 mr16">'.$title_section.'</h2>' : '';
            echo ($url_section) ? '<a class="view-more btn bgt fwb text-c co01-c-h" href="'.$url_section.'">'. lang_torotube('View more', 'lang_view_more') .'</a>' : '';
            ?>
        </header>
    <?php } ?>

    <?php 
    if(have_posts()) :  ?>
        <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
            <?php if($enable_ads_section == 1){ 
                ?>
                <div class="dvr-bx b-row-2 a-col-2 dfx aic jcc">
                    <div class="dvr">
                        <?php echo $enable_ads; ?>
                    </div>
                </div>
            <?php } ?>

            <?php 
            while(have_posts()) : the_post();
                get_template_part( 'public/partials/templates/loop', 'principal', array(
                    'video_favorites'   => $video_favorites,
                    'favorite'          => $favorite,
                    'video_watch_later' => $video_watch_later,
                    'watch'             => $watch,
                ) );
            endwhile; ?>
        </div>
        
        <nav class="navigation pagination">
            <?php torotube_pagination(); ?>
        </nav>
    <?php endif; wp_reset_query(); ?>
</section>