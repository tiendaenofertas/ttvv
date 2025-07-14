<?php get_header();
$dataTax        = new TOROTUBE_Tax;
$term           = get_queried_object();
$term_id        = get_queried_object_id();
$image          = $dataTax->get_image_url($term_id, 'thumbnail');
$metafieldArray = get_option('taxonomy_'. $term_id); 
$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb'; ?>

    <div id="content">
		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			<main class="main dfx fdc" role="main">
				<article class="category b-dgd b-gt3 e-gt4 gp16 aic e-gp32 f14 e-f16">
					
					<div class="vdeo snow-b sw03 pd08 por ovh dno b-dbk ast">
						<div class="thumb por">
							<figure class="por ovh">
								<img src="<?php echo $image; ?>" class="poa w100p h100p ofc" alt="<?php single_cat_title(); ?>">
							</figure>
						</div>
					</div>
					
					<header class="col-2 e-col-3">
						<?php if($metafieldArray ){ ?>
							<h2 class="ttl f24 h123-c py04"><?php single_cat_title(); ?></h2>
						<?php } else { ?>
							<h1 class="ttl f24 h123-c py04"><?php single_cat_title(); ?></h1>
						<?php } ?>
						
						<p class="meta dfx fww f12 mt08">
							<span><i class="fa-play-circle co01-c mr04"></i><span class="fwb"><?php echo $term->count; ?></span> <?php _e('videos', 'torotube'); ?></span>
						</p>
						<div class="entry mt08">
							<?php echo category_description(); ?>
						</div>
					</header>
				</article>

				<section class="mt24 c-mt32">
					<header class="dfx aic fww f12 c-f16">
						<h2 class="ttl f24 h123-c py08 mr16"><?php single_cat_title(); ?></h2>
					</header>
					
                    <?php  if(have_posts()) :
						$video_favorites    = get_option('video_favorites');
						$video_watch_later  = get_option('video_watch_later');
						$user_id            = get_current_user_id();
						$favorite           = get_user_meta( $user_id, 'user_favorite', true ); 
						$watch              = get_user_meta( $user_id, 'user_watch', true ); ?>
                        <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                            <?php while(have_posts()) : the_post(); 
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
                    <?php endif; ?>
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