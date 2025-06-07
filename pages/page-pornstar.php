<?php 
/*
template name: Pornstars
*/
get_header(); 
$dataTax = new TOROTUBE_Tax;
$type = ( isset($_GET['letter']) ) ? $_GET['letter'] : false;

$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb'; 

$enable_alphabet_pornstar_archive = get_option('enable_alphabet_pornstar_archive');
$pornstar_archive_number          = get_option('pornstar_archive_number');
if( !$pornstar_archive_number ) $pornstar_archive_number = 5;
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
                    <?php if($enable_alphabet_pornstar_archive ){ ?>
                        <div class="tagcloud fwb mt08">
                            <a <?php echo (!$type) ? 'class="co01-bt"' : ''; ?> href="<?php the_permalink(); ?>"><?php echo lang_torotube('All', 'lang_all'); ?></a>
                            <?php foreach (range('a', 'z') as $char) { ?>
                                <a <?php echo ($type == $char) ? 'class="co01-bt"' : ''; ?> href="<?php the_permalink(); ?>?letter=<?php echo $char; ?>"><?php echo strtoupper($char); ?></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php 
                    $number = $pornstar_archive_number;
                    if(!$number)
                        $number = 5;
                    $posts_per_page = $number;
                    $page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $offset = ( $page - 1 );
                    if($type){
                        $categories =  get_terms( array(
                            'taxonomy'   => 'toro_pornstar',
                            'hide_empty' => true,
                            'meta_query' => [[
                                'key'   => 'letter_tax',
                                'value' => $type,
                            ]],
                        ) );
                    } else {
                        $categories =  get_terms( array(
                            'taxonomy'   => 'toro_pornstar',
                            'hide_empty' => 1,
                        ) );
                    }
                    if($categories){
                        $categorie = array_values($categories);
                    ?>
                        <div class="dgd gt2 a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                        <?php 
                        for( $i = $offset * $posts_per_page; $i < ( $offset + 1 ) * $posts_per_page; $i++ ) {
                            if( isset($categorie[$i]) ){ $cat = $categorie[$i]; } else { $cat = null; }
                            if($cat!=null){ 
                                $id    = $cat->term_id;
                                $name  = $cat->name;
                                $count = $cat->count;
                                $url   = get_term_link( $cat );
                                $image = $dataTax->get_image_url($id, 'poster');
                                $thumb = $dataTax->thumb($id);
                                ?>
                                <article class="pstr snow-b sw03 pd08 por ovh">
                                    <div class="thumb por">
                                        <figure class="por ovh">
                                            <img class="poa w100p h100p ofc" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                                        </figure>
                                        <span class="rtng fwb poa lt0 bm0 m08 f12 dark-bgt-05 snow-c px08 mg08"><i class="fa-thumbs-up fal" aria-hidden="true"></i> <?php echo $thumb; ?></span>
                                    </div>
                                    <header class="mt08">
                                        <h2 class="ttl f14 fwn h123-c tvw"><?php echo $name; ?></h2>
                                        <p class="meta dfx fww f12 mt04">
                                            <span><i class="fa-play-circle co01-c mr04"></i><span class="fwb"><?php echo $count; ?></span> <?php echo lang_torotube('videos', 'lang_videos'); ?></span>
                                        </p>
                                    </header>
                                    <a class="lka" href="<?php echo $url; ?>"><span class="sr-only"><?php echo $name; ?></span></a>
                                </article>
                            <?php }
                        } ?>
                        </div>
                        <nav class="navigation pagination">
                            <div class="nav-links">
                                <?php pagination_pornstar($type); ?>
                            </div>
                        </nav>
                    <?php } else { 
                        get_template_part( 'public/partials/templates/loop', 'none' );
                    } ?>
				</section>
                
            </main>
            
            <?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_pornstar')!=false and get_option('torotube_sidebar_pornstar') != 'tt-nsdb') ){
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