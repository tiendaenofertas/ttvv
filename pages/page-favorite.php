<?php 
/*
template name: Favorites
*/
get_header();
global $post;
$user_id  = get_current_user_id();
$favorite = get_user_meta( $user_id, 'user_favorite', true );
$title_seo = get_post_meta( $post->ID, 'top_title_seo_page', true );
$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb';  ?>
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
					if($favorite){
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'post_type'           => array('post', 'movies_tt'),
							'posts_per_page'      => get_option( 'posts_per_page' ),
							'post_status'         => 'publish',
							'ignore_sticky_posts' => true,
							'paged'               => $paged,
							'post__in'            => $favorite,
						); 
                                                global $wp_query;
                                                $temp_query = $wp_query;
                                                $wp_query = new WP_Query($args);
                                                if ( $wp_query->have_posts() ) : ?>
                                                        <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                                                                <?php
                                                                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                                                                        get_template_part( 'public/partials/templates/loop', 'favorites' );
                                                                endwhile;
                                                                ?>
                                                        </div>
                                                        <nav class="navigation pagination">
                                                                <?php echo torotube_pagination(); ?>
                                                        </nav>
                                                <?php endif; $wp_query = $temp_query; wp_reset_postdata();
                                        } else {
						get_template_part( 'public/partials/templates/loop', 'none' );
					} ?>
				</section>
			</main>
            <?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_user')!=false and get_option('torotube_sidebar_user') != 'tt-nsdb') ){
				get_sidebar();
			}
			?>
		</div>
	</div>
<?php get_footer(); ?>