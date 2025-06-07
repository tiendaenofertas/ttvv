<?php 

/*
template name: Categories
*/
get_header(); 
$dataTax = new TOROTUBE_Tax;
$category_archive_number = get_option('category_archive_number');
if( !$category_archive_number ) $category_archive_number = 5;

$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb'; 

if ( have_posts() ) : while ( have_posts() ) : the_post();
	$title_seo = get_post_meta( get_the_ID(), 'top_title_seo_page', true );  ?>

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
					<div class="dgd gtf gp08 mt16 d-mt24 c-gt3 f-gt6">

						<?php 

						$number = $category_archive_number;
						
						if(!$number)
							$number = 5;
						$posts_per_page = $number;
						$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$offset = ( $page - 1 );
						
						$categories =  get_terms( array(
							'taxonomy'   => 'category',
							'hide_empty' => true,
						) );


						$categorie = array_values($categories);

						for( $i = $offset * $posts_per_page; $i < ( $offset + 1 ) * $posts_per_page; $i++ ) {

                            if( isset($categorie[$i]) ){ $cat = $categorie[$i]; } else { $cat = null; }
                            if($cat!=null){ 
						
						
								$id    = $cat->term_id;
								$name  = $cat->name;
								$count = $cat->count;
								$url   = get_term_link( $cat );
								$image = $dataTax->get_image_url($id, 'mini');
								?>
								
								<div class="ctgr snow-b sw03 pd08 por ovh brp dfx aic">
									<div class="thumb por w64 mr16">
										<figure class="por ovh brc">
											<img class="poa w100p h100p ofc" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
										</figure>
									</div>
									<div>
										<div class="ttl f14 fwn h123-c tvw"><?php echo $name; ?></div>
										<p class="meta dfx fww f12 mt08">
											<span><i class="fa-play-circle co01-c mr04"></i><span class="fwb"><?php echo $count; ?></span> <?php echo lang_torotube('videos', 'lang_videos'); ?></span>
										</p>
									</div>
									<a class="lka" href="<?php echo $url; ?>"><span class="sr-only"><?php echo $name; ?></span></a>
								</div>
										  
								
							<?php }
						} ?>

					</div>
					
					<nav class="navigation pagination">
						<div class="nav-links">
							<?php pagination_categories(); ?>
						</div>
					</nav>
				</section>
				
			</main>
			
			<?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_category')!=false and get_option('torotube_sidebar_category') != 'tt-nsdb') ){
				get_sidebar();
			}
			?>
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