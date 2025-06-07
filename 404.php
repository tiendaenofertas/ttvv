<?php get_header(); 
$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb'; ?>
    <div id="content">
		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			<main class="main dfx fdc" role="main">
				<p class="tac pd32 gray-bgt-02 sw03">
					<span class="dbk f64 fwb op02">404</span>
					<span class="dbk py08"><?php _e('Page not found', 'torotube'); ?></span>
				</p>
				<section class="mt24 c-mt32">
					<header class="dfx aic fww f12 c-f16">
						<h1 class="ttl f24 h123-c py08 mr16"><?php _e('Best HD Porn videos', 'torotube'); ?></h1>
					</header>
					<div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
						<?php $args = array(
							'post_type'           => 'post',
							'posts_per_page'      => get_option( 'posts_per_page' ),
							'post_status'         => 'publish',
							'no_found_rows'       => true,
							'ignore_sticky_posts' => true,
						); 
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) :
							$video_favorites    = get_option('video_favorites');
							$video_watch_later  = get_option('video_watch_later');
							$user_id            = get_current_user_id();
							$favorite           = get_user_meta( $user_id, 'user_favorite', true ); 
							$watch              = get_user_meta( $user_id, 'user_watch', true );
							while ( $the_query->have_posts() ) : $the_query->the_post();
								get_template_part( 'public/partials/templates/loop', 'principal', array(
									'video_favorites'   => $video_favorites,
									'favorite'          => $favorite,
									'video_watch_later' => $video_watch_later,
									'watch'             => $watch,
								) );
							endwhile;
						endif; wp_reset_query(); ?>
					</div>
				</section>
			</main>
            <?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_404')!=false and get_option('torotube_sidebar_404') != 'tt-nsdb') ){
				get_sidebar();
			}
			?>
		</div>
	</div>
<?php get_footer(); ?>