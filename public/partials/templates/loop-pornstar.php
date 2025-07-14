<article class="pstr snow-b sw03 pd08 por ovh">
    <div class="thumb por">
        <figure class="por ovh">
            <?php the_post_thumbnail( 'medium', array('class' => 'poa w100p h100p ofc', 'loading'=>'lazy', 'alt' => get_the_title()) ); ?>
        </figure>
        <span class="rtng fwb poa lt0 bm0 m08 f12 dark-bgt-05 snow-c px08 mg08"><i class="fa-thumbs-up fal" aria-hidden="true"></i> 96%</span>
    </div>
    <header class="mt08">
        <h2 class="ttl f14 fwn h123-c tvw"><?php the_title(); ?></h2>
        <p class="meta dfx fww f12 mt04">
            <span><i class="fa-play-circle co01-c mr04"></i><span class="fwb">227</span> <?php _e('videos', 'torotube'); ?></span>
        </p>
    </header>
    <a class="lka" href="<?php the_permalink(); ?>"><span class="sr-only"><?php the_title(); ?></span></a>
</article>