<?php get_header(); 

$video_favorites    = get_option('video_favorites');
$video_watch_later  = get_option('video_watch_later');
$user_id            = get_current_user_id();
$favorite           = get_user_meta( $user_id, 'user_favorite', true ); 
$watch              = get_user_meta( $user_id, 'user_watch', true );
$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb';  ?>   
    <div id="content">
		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			<main class="main dfx fdc" role="main">
			    <section class="mt24 c-mt32">
                        <header class="dfx aic fww f12 c-f16">
                            <h1 class="ttl f24 h123-c py08 mr16"><?php single_tag_title(); ?></h1>
                        </header>
                    <?php 
                    if(have_posts()) :  ?>
                        <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                            
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
			</main>
			<?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_category')!=false and get_option('torotube_sidebar_category') != 'tt-nsdb') ){
				get_sidebar();
			}
			?>
		</div>
	</div>
<?php get_footer(); ?>