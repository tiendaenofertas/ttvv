<?php 
$dataTax        = new TOROTUBE_Tax;
$block          = $args['block'];
$title_section  = ( $block->pornstar_title ) ? $block->pornstar_title : false;
$url_section    = ( $block->pornstar_url ) ? $block->pornstar_url : false;
$number_section = ( $block->pornstar_number ) ? $block->pornstar_number : 6;
?>

<section class="mt24 c-mt32">

    <?php if($title_section or $url_section){ ?>
        <header class="dfx aic fww f12 c-f16">
            <?php 
            echo ($title_section) ? '<h2 class="ttl f24 h123-c py08 mr16">'.$title_section.'</h2>' : '';
            echo ($url_section) ? '<a class="view-more btn bgt fwb text-c co01-c-h" href="'.$url_section.'">'. lang_torotube('View more', 'lang_view_more') .'</a>' : '';
            ?>
        </header>
    <?php } ?>

    <div class="dgd gtf gp08 mt16 d-mt24 rspl c-gt3 f-gt6">

        <?php
        $pornstars =  get_terms( array(
            'taxonomy'   => 'toro_pornstar',
            'hide_empty' => true,
            'number'     => $number_section,
        ) );
        
        if ( ! empty( $pornstars ) && ! is_wp_error( $pornstars ) ){
            foreach( $pornstars as $pornstar ){
                $id       = $pornstar->term_id;
                $name     = $pornstar->name;
                $count    = $pornstar->count;
                $image    = $dataTax->get_image_url($id, 'poster');
                $url      = get_term_link( $pornstar ); 
                $thumb    = $dataTax->thumb($id); ?>

                <article class="pstr snow-b sw03 pd08 por ovh">
                    <div class="thumb por">
                        <figure class="por ovh">
                            <img width="250" height="400" src="<?php echo $image; ?>" class="poa w100p h100p ofc" loading="lazy" title="<?php echo $name; ?>" alt="<?php echo $name; ?>">
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
</section>