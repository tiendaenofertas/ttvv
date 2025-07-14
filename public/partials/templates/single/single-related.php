<?php 
$id = get_the_ID();
$enable_related = get_option('enable_related');
$single_related_title = get_option('single_related_title');
$single_related_number = get_option('single_related_number');

if($enable_related){
    if(!$single_related_number) $single_related_number = 5;
?>
    <section class="mt24 c-mt32">
        <header class="dfx aic fww f12 c-f16">
            <?php echo ($single_related_title) ? '<h2 class="ttl f24 h123-c py08 mr16">'.$single_related_title.'</h2>' : ''; ?>
        </header>
        <div class="dgd a-gtf gp08 mt16 d-mt24 rspl c-gt3 f-gt6">
            <?php $custom_taxterms = wp_get_object_terms( $id, 'category', array('fields' => 'ids') );
            $args = array(
                'post_type'           => 'post',
                'posts_per_page'      => $single_related_number,
                'post_status'         => 'publish',
                'no_found_rows'       => true,
                'ignore_sticky_posts' => true,
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    => $custom_taxterms
                    )
                ),
                'post__not_in' => array ($id),
            ); 
            $the_query = new WP_Query( $args );

            $count_related_post = $the_query->found_posts;
            if ( $the_query->have_posts() ) :
                $video_favorites    = get_option('video_favorites');
                $video_watch_later  = get_option('video_watch_later');
                $user_id            = get_current_user_id();
                $favorite           = get_user_meta( $user_id, 'user_favorite', true ); 
                $watch              = get_user_meta( $user_id, 'user_watch', true );
                $count              = 0;
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    get_template_part( 'public/partials/templates/loop', 'principal', array(
                        'video_favorites'   => $video_favorites,
                        'favorite'          => $favorite,
                        'video_watch_later' => $video_watch_later,
                        'watch'             => $watch,
                        'related'           => true,
                        'count'             => $count,
                    ) );
                    $count++;
                endwhile;
            endif; wp_reset_query();  ?>
        </div>
        <?php if( $single_related_number > 6 && $count_related_post  > 6){ ?>
            <p>
                <button id="related-more" class="btn w100p snow-b text-c fwb ttu bd0 f14 sw03 pd08 gray-b-h link-c-h" type="button"><?php echo lang_torotube('Load more', 'lang_load_more'); ?></button>
            </p>
        <?php } ?>
    </section>
<?php } ?>