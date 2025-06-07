<?php get_header(); ?>
<div id="content">
	<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
		<main class="main dfx fdc" role="main">

			<?php
			$home_blocks = get_theme_mod('torotube_panel_homet');
			if ($home_blocks) {
				$blocks = (array) json_decode($home_blocks);

				foreach ($blocks as $block) {

					if ($block->tags_enabled == '1') {
						get_template_part('public/partials/templates/home/home', 'tags', array('block' => $block));
					}
					
					if ($block->latest_enabled == '1') {
						get_template_part('public/partials/templates/home/home', 'latest', array('block' => $block));
					}

					if ($block->channel_enabled == '1') {
						get_template_part('public/partials/templates/home/home', 'channel', array('block' => $block));
					}

					if ($block->pornstar_enabled == '1') {
						get_template_part('public/partials/templates/home/home', 'pornstar', array('block' => $block));
					}

					if ($block->categories_enabled == '1') {
						get_template_part('public/partials/templates/home/home', 'categories', array('block' => $block));
					}

					if ($block->movies_enabled == '1') {
						get_template_part('public/partials/templates/home/home', 'movies', array('block' => $block));
					}
				}
			} else {
				$block = array();
				get_template_part('public/partials/templates/home/home', 'latestinitial', array('block' => $block));
			}
			?>

		</main>
		<?php
		if ((get_option('torotube_sidebar_general') != false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  (get_option('torotube_sidebar_home') != false and get_option('torotube_sidebar_home') != 'tt-nsdb')) {
			get_sidebar();
		}
		?>
	</div>
	<?php
	$text_seo  = get_option('sample_tinymce_editor');
	$title_seo = get_option('text_seo_title');
	if ($text_seo or $title_seo) {
	?>
		<aside class="cnt mt24 c-mt32">
			<div class="wdgt mt24 c-mt32">
				<?php if ($title_seo) { ?>
					<div class="ttl f20 text-c py04"><?php echo $title_seo; ?></div>
				<?php }
				if ($text_seo) { ?>
					<div class="entry">
						<?php echo wpautop($text_seo); ?>
					</div>
				<?php } ?>
			</div>
		</aside>
	<?php } ?>
</div>
<?php get_footer(); ?>