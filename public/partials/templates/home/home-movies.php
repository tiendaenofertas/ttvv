<?php 
$dataTax        = new TOROTUBE_Tax;
$block          = $args['block'];
$title_section  = ( $block->movies_title ) ? $block->movies_title : false;
$url_section    = ( $block->movies_url ) ? $block->movies_url : false;
$number_section = ( $block->movies_number ) ? $block->movies_number : 6;
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

    <div class="dgd gtf gp08 mt16 d-mt24 rspl c-gt3 f-gt6">

        <?php $args = array(
            'post_type'           => 'movies_tt',
            'posts_per_page'      => $number_section,
            'post_status'         => 'publish',
            'no_found_rows'       => true,
            'ignore_sticky_posts' => true,
        ); 
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
                get_template_part( 'public/partials/templates/loop', 'movies', array(
                    'video_favorites'   => $video_favorites,
                    'favorite'          => $favorite,
                    'video_watch_later' => $video_watch_later,
                    'watch'             => $watch,
                ) );
           endwhile;
        endif; wp_reset_query();  ?>

        
    </div>
</section>