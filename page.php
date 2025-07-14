<?php get_header(); 
$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb';  ?>   
    <div id="content">
		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			<main class="main dfx fdc" role="main">
			    <article>
                   <?php the_content(); ?>
                </article>
			</main>
            <?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_search')!=false and get_option('torotube_sidebar_search') != 'tt-nsdb') ){
				get_sidebar();
			}
			?>
		</div>
	</div>
<?php get_footer(); ?>