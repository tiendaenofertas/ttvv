<?php get_header(); 
if ( have_posts() ) : while ( have_posts() ) : the_post();
    $id = get_the_ID();
    $data       = new TOROTUBE_Post;
    $views      = $data->get_views($id);
    $duration   = $data->get_duration($id);
    $thumb      = $data->get_thumb($id);
    $thumb_up   = $data->get_thumb_up($id);
    $thumb_down = $data->get_thumb_down($id);
    $tags       = $data->get_tags($id);
    $categories = $data->get_categories($id);
    $pornstar   = $data->get_pornstar($id);
    $channel    = $data->get_channel($id);
    $quality    = $data->get_quality($id);
	$title_seo  = get_post_meta( $id, 'title_seo_single', true ); 
?>

	<div id="content" data-post="<?php echo $id; ?>">
		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			
			<?php get_template_part( 'public/partials/templates/breadcrumb' ); ?>
			
			<main class="main dfx fdc" role="main">
				<article class="vdeo-single">
					<header>
						<?php if($title_seo){ ?>
						    <h2 class="ttl f24 h123-c py08 mr16"><?php the_title(); ?></h2>
                        <?php } else { ?>
                            <h1 class="ttl f24 h123-c py08 mr16"><?php the_title(); ?></h1>
                        <?php } ?>
                        <?php echo ($duration) ? '<span class="text-b snow-c fwb f12 px08 dib vam">'.$duration.'</span>' : ''; ?>
						<?php echo ($quality) ? $quality : ''; ?>
                        <?php if($pornstar or $channel or $tags){ ?>
                            <div class="tagcloud mt08">
                                <?php
                                    echo ($channel) ? $channel : '';
                                    echo ($pornstar) ? $pornstar : '';
                                    echo ($categories) ? $categories : '';
                                    echo ($tags) ? $tags : '';
                                ?>
                            </div>
                        <?php } ?>
					</header>
					<?php 
					$player_above_text   = get_option( 'player_above_text');
					$player_above_url    = get_option( 'player_above_url');
					$player_above_target = get_option( 'player_above_target' );
					$target = ($player_above_target) ? 'target="_blank"' : '';
					echo ($player_above_text) ? '<p class="mt08"><a '.$target.' class="btn pd08 ttu fwb w100p f12 a-f14 op08-h" href="'.$player_above_url.'"> '.$player_above_text.'</a></p>' : '';
					?>
                    <?php get_template_part( 'public/partials/templates/single/single', 'player' ); ?>
				</article>
			</main>
			<?php 
			$player_ads_lateral = get_option('player_ads_lateral');
			if(!wp_is_mobile()){
			?>
				<aside class="sidebar">
					<?php if($player_ads_lateral){ ?>
						<div class="dfc">
							<?php echo $player_ads_lateral ?>
						</div>
					<?php } ?>
				</aside>
			<?php } ?>
		</div>
		<aside class="cnt mt24 c-mt32">
			<?php 
			get_template_part( 'public/partials/templates/single/single', 'related' );
            comments_template(); 
			?>
		</aside>
	</div>
<?php endwhile; endif;
get_footer(); ?>