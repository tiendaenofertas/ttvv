<?php get_header();

$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb'; ?>

    <div id="content">

	
		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			
			<main class="main dfx fdc" role="main">

			
				<article class="category b-dgd b-gt3 e-gt4 gp16 aic e-gp32 f14 e-f16">
					<div class="vdeo snow-b sw03 pd08 por ovh dno b-dbk ast">
						<div class="thumb por">
							<figure class="por ovh">
								<img class="poa w100p h100p ofc" src="https://img-hw.xvideos-cdn.com/videos/thumbs169ll/53/b1/63/53b163da57ffa372b81f5ce85108433f/53b163da57ffa372b81f5ce85108433f.4.jpg" width="350" height="200" alt="video">
							</figure>
						</div>
					</div>
					<header class="col-2 e-col-3">
						<h1 class="ttl f24 h123-c py04"><?php single_cat_title(); ?></h1>
						<p class="meta dfx fww f12 mt08">
							<span><i class="fa-play-circle co01-c mr04"></i><span class="fwb">227</span> videos</span>
						</p>
						<div class="entry mt08">
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et <a href="#">justo duo dolores</a> et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
						</div>
					</header>
				</article>

				<section class="mt24 c-mt32">
					<header class="dfx aic fww f12 c-f16">
						<h2 class="ttl f24 h123-c py08 mr16"><?php single_cat_title(); ?></h2>
					</header>
                    <?php if(have_posts()) : ?>

                        <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                            <?php while(have_posts()) : the_post(); 
                                get_template_part( 'public/partials/templates/loop', 'principal' );
                            endwhile; ?>
                        </div>
					
                        <nav class="navigation pagination">
                            <?php torotube_pagination(); ?>
                        </nav>

                    <?php endif; ?>
				</section>
				
			</main>
			
            <?php if($sidebar!='tt-nsdb') { get_sidebar(); } ?>
		</div>

		<!-- area -->
		<aside class="cnt mt24 c-mt32">
			<!-- widget -->
			<div class="wdgt mt24 c-mt32">
				<div class="ttl f20 text-c py04">Text for SEO</div>
				<div class="div">
					Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
				</div>
			</div>
		</aside>
		
	</div>

<?php get_footer(); ?>