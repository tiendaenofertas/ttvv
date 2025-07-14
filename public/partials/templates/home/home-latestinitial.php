<?php 

$block = $args['block']; 

$title_section      = false;
$url_section        = false;
$number_section     = false;
$enable_ads_section = false;
$enable_ads         = false;
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
                $ads_mobile  = get_option( 'home_latest_ads_mobile' );
                $ads_desktop = get_option( 'home_latest_ads_desktop' );
                ?>
                <div class="dvr-bx b-row-2 a-col-2 dfx aic jcc">
                    <div class="dvr">
                        <?php echo ( wp_is_mobile() ) ? $ads_mobile : $ads_desktop; ?>
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