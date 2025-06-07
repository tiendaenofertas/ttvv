<?php get_header(); 
    $type              = ( isset($_GET['filter']) ) ? $_GET['filter'] : false;
    $term              = get_queried_object();
    $term_id           = get_queried_object_id();
    $image_id          = get_term_meta( $term_id, 'category-image', true );
    $paged             = (get_query_var('paged')) ? get_query_var('paged'): 1;
    $dataTax           = new TOROTUBE_Tax;
    $thumb_up          = $dataTax->thumb_up($term_id);
    $thumb_down        = $dataTax->thumb_down($term_id);
    $thumb             = $dataTax->thumb($term_id);
    $image             = $dataTax->get_image_url($term_id, 'thumbnail');
    $video_favorites   = get_option('video_favorites');
    $video_watch_later = get_option('video_watch_later');
    $user_id           = get_current_user_id();
    $favorite          = get_user_meta( $user_id, 'user_favorite', true );
    $watch             = get_user_meta( $user_id, 'user_watch', true );

    $metafieldArray = get_option('taxonomy_'. $term_id); 
    $sidebar = get_option( 'torotube_sidebar_general' );
    if(!$sidebar) $sidebar = 'tt-nsdb'; 
?>

    <div id="content" data-tax="<?php echo $term_id; ?>">

        <div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
            
            <main class="main dfx fdc" role="main">

                <?php if(1 == $paged) { ?>
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
                            <?php if(category_description()){ ?>
                                <div class="entry mt08">
                                    <?php echo category_description(); ?>
                                </div>
                            <?php } ?>
                            <ul class="dfx py08 bwt1 line-d aic fww mt06 tac jcc">
                                <li>
                                    <i class="fa-play-circle co01-c mr04"></i> <span class="fwb"><?php echo $term->count; ?> <span class="f14 fwn"><?php _e('videos', 'torotube'); ?></span></span>
                                </li>
                                <li class="mr0 mga e-or3">
                                    <div class="dfx fww">
                                        <button id="vote-up-tax" class="btn py0 bgt text-c link-c-h f14 px16 fg1" type="button"><i class="fa-thumbs-up far mr08"></i> <span id="num_vote_up"><?php echo $thumb_up; ?></span></button>
                                        <button id="vote-down-tax" class="btn py0 bgt text-c link-c-h f14 px16 fg1" type="button"><i class="fa-thumbs-down far mr08"></i> <span id="num_vote_down"><?php echo $thumb_down; ?></span></button>
                                        <div class="progress co01-bgt-01 fb1">
                                            <span style="width: <?php echo $thumb; ?>;" class="co01-b h08 dbk f08"></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </header>
                    </article>
                <?php } ?>

                <section class="mt24 c-mt32">
                    <header class="dfx aic fww f12 c-f16">
                        <h2 class="ttl f24 h123-c py08 mr16"><?php single_cat_title(); ?></h2>
                        <p class="mt0 mr0">
                            <select id="filter-tax">
                                <option <?php echo (!$type) ? 'selected' : ''; ?> value="latest"><?php _e('Recently added videos', 'torotube'); ?></option>
                                <option <?php echo ($type == 'viewed') ? 'selected' : ''; ?> value="viewed"><?php _e('Most viewed videos', 'torotube'); ?></option>
                                <option <?php echo ($type == 'popular') ? 'selected' : ''; ?> value="popular"><?php _e('Popular videos', 'torotube'); ?></option>
                                <option <?php echo ($type == 'random') ? 'selected' : ''; ?> value="random"><?php _e('Random videos', 'torotube'); ?></option>
                            </select>
                        </p>
                    </header>
                    
                    <?php if( $type == 'viewed' ){ 

                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type'           => 'post',
                            'paged'               => $paged,
                            'meta_key'            => 'views',
                            'orderby'             => 'meta_value_num',
                            'ignore_sticky_posts' => true,
                            'order'               => 'DESC'
                        );
                        $wp_query = new WP_Query($args);

                        if($wp_query->have_posts()) : ?>

                            <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                                <?php while($wp_query->have_posts()) : $wp_query->the_post(); 
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
                        <?php else: ?>
                        <?php endif; wp_reset_query(); ?>

                    <?php } elseif( $type == 'random' ){ 

                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type'           => 'post',
                            'paged'               => $paged,
                            'ignore_sticky_posts' => true,
                            'orderby'             => 'rand',
                        );
                        $wp_query = new WP_Query($args);

                        if($wp_query->have_posts()) : ?>

                            <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                                <?php while($wp_query->have_posts()) : $wp_query->the_post(); 
                                    get_template_part( 'public/partials/templates/loop', 'principal', array(
                                        'video_favorites'   => $video_favorites,
                                        'favorite'          => $favorite,
                                        'video_watch_later' => $video_watch_later,
                                        'watch'             => $watch,
                                    ) );
                                endwhile; ?> 
                            </div>
                        <?php else: ?>
                        <?php endif; wp_reset_query(); ?>

                    
                    <?php } elseif( $type == 'popular' ){ 

                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type'           => 'post',
                            'paged'               => $paged,
                            'meta_key'            => 'liketotal',
                            'orderby'             => 'meta_value_num',
                            'ignore_sticky_posts' => true,
                            'order'               => 'DESC'
                        );
                        $wp_query = new WP_Query($args);

                        if($wp_query->have_posts()) :
                             ?>

                            <div class="dgd a-gtf gp08 mt16 d-mt24 c-gt3 f-gt6">
                                <?php while($wp_query->have_posts()) : $wp_query->the_post(); 
                                    get_template_part( 'public/partials/templates/loop', 'principal', array(
                                        'video_favorites'   => $video_favorites,
                                        'favorite'          => $favorite,
                                        'video_watch_later' => $video_watch_later,
                                        'watch'             => $watch,
                                    ) );
                                endwhile; ?> 
                            </div>
                        <?php else: ?>
                        <?php endif; wp_reset_query(); ?>



                    <?php } else { ?>

                        <?php if(have_posts()) : ?>
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
                        <?php else: ?>
                        <?php endif; wp_reset_query(); ?>

                    <?php } ?>
                </section>
                
            </main>
            <?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_channel')!=false and get_option('torotube_sidebar_channel') != 'tt-nsdb') ){
				get_sidebar();
			}
			?>
        </div>

       

    </div>
        
<?php get_footer(); ?>