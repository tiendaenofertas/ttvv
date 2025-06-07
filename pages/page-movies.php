<?php 
/*
template name: Movies
*/
get_header(); 
$type = ( isset($_GET['letter']) ) ? $_GET['letter'] : false;

$video_favorites    = get_option('video_favorites');
$video_watch_later  = get_option('video_watch_later');
$user_id            = get_current_user_id();
$favorite           = get_user_meta( $user_id, 'user_favorite', true ); 
$watch              = get_user_meta( $user_id, 'user_watch', true ); 

if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    $title_seo = get_post_meta( get_the_ID(), 'top_title_seo_page', true ); ?>
    
    <div id="content">

        <div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
          
            <main class="main dfx fdc" role="main">

                <section class="mt24 c-mt32">
					<header class="dfx aic fww f12 c-f16">
                        <?php if($title_seo){ ?>
						    <h2 class="ttl f24 h123-c py08 mr16"><?php the_title(); ?></h2>
                        <?php } else { ?>
                            <h1 class="ttl f24 h123-c py08 mr16"><?php the_title(); ?></h1>
                        <?php } ?>
					</header>

                    <?php 
                    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                        'post_type'           => 'movies_tt',
                        'posts_per_page'      => get_option( 'posts_per_page' ),
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => true,
                        'paged'               => $paged,
                    ); 
                    query_posts($args);
                    if(have_posts()) : 
                    ?>
                        <div class="dgd gt2 a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                            
                            <?php 
                            while(have_posts()) : the_post();
                                get_template_part( 'public/partials/templates/loop', 'movies', array(
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
                
            </main>
            
            <?php get_sidebar(); ?>
            
        </div>

        <aside class="cnt mt24 c-mt32">
            <div class="wdgt mt24 c-mt32">
                <div class="div">
                    <?php the_content(); ?>
                </div>
            </div>
        </aside>
    </div>

<?php endwhile; endif;
get_footer(); ?>