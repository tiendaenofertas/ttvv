<?php 
$id       = get_the_ID();
$data     = new TOROTUBE_Post;
$views    = $data->get_views($id);
$duration = $data->get_duration($id);
$thumb    = $data->get_thumb($id);
$quality  = $data->get_quality_wdgt($id);
$trailer  = $data->trailer($id);
?>
<article <?php echo ($trailer) ? 'preview="' . $trailer. '"' : ''; ?> class="loop-post vdeo snow-b sw03 pd08 por ovh">
    <div class="thumb por">
        <figure class="por ovh">
            <?php the_post_thumbnail('thumbnail', array('class' => 'poa w100p h100p ofc', 'loading'=>'lazy', 'alt' => get_the_title())) ?>
        </figure>
        <?php echo ($quality) ? $quality : ''; ?>
        <span class="rtng fwb poa lt0 bm0 m08 f12 dark-bgt-05 snow-c px08 mg08"><i class="fa-thumbs-up fal" aria-hidden="true"></i> <?php echo $thumb; ?></span>
        <div class="vdop poa rt0 tp0 my04 w48 f14 tns zi3">
            <button data-type="watch" data-post="<?php echo $id; ?>" class="btn sm mx08 my04 px0 co01-b dark-b-h bd0 snow-c dlt" type="button">
                <i class="fa-times"><span class="sr-only"><?php echo lang_torotube('favorites', 'lang_favorites'); ?></span></i>
            </button>
        </div>
    </div>
    <header class="mt08">
        <h2 class="ttl f14 fwn h123-c tvw"><?php the_title(); ?></h2>
        <p class="meta dfx fww f12 mt04">
            <span><span class="fwb"><?php echo $views; ?></span> <?php echo lang_torotube('views', 'lang_views'); ?></span>
            <?php echo ($duration) ? '<span><i class="fa-clock far op05"></i> '.$duration.'</span>' : ''; ?>
        </p>
    </header>
    <a class="lka" href="<?php the_permalink(); ?>"><span class="sr-only"><?php echo lang_torotube('watch video', 'lang_watch_video'); ?></span></a>
</article>