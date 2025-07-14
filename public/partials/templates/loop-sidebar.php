<?php 
$id                = get_the_ID();
$data              = new TOROTUBE_Post;
$views             = $data->get_views($id);
$duration          = $data->get_duration($id);
$thumb             = $data->get_thumb($id);
$quality           = $data->get_quality_wdgt($id);
$favorite          = $args['favorite'];
$watch             = $args['watch'];
$video_favorites   = $args['video_favorites'];
$video_watch_later = $args['video_watch_later'];
$trailer           = $data->trailer($id);
?>
<article <?php echo ($trailer) ? 'preview="' . $trailer. '"' : ''; ?> class="loop-post vdeo snow-b sw03 pd08 por ovh c-dfx aic f14">
    <div class="thumb por fg0 c-w160 c-mr16">
        <figure class="por ovh">
            <?php the_post_thumbnail('wdgt', array('class' => 'poa w100p h100p ofc', 'loading'=>'lazy', 'alt' => get_the_title())) ?>
        </figure>
        
        <?php echo ($quality) ? $quality : ''; ?>
        <span class="rtng fwb poa lt0 bm0 m08 f12 dark-bgt-05 snow-c px08 mg08"><i class="fa-thumbs-up fal" aria-hidden="true"></i> <?php echo $thumb; ?></span>
        <div class="vdop poa rt0 tp0 my04 w48 f14 op0 tns zi3">
            <?php if($video_favorites && is_user_logged_in()){ 
                if($favorite){
                    $statusf = (in_array($id, $favorite )) ? 'favorite' : 'nofavorite';
                } else {
                    $statusf = 'nofavorite'; 
                } ?>
                <button data-post="<?php echo $id; ?>" data-status="<?php echo $statusf; ?>" class="favorite-user-loop btn sm mx08 my04 px0 dark-bgt-05 dark-b-h snow-c" type="button">
                    <i class="favorite-active fa-heart <?php echo ( $statusf == 'favorite' ) ? 'fa' : 'far' ; ?>"><span class="sr-only"><?php _e('favorites', 'torotube'); ?></span></i>
                </button>
            <?php } ?>

            <?php if($video_watch_later && is_user_logged_in()){ 
                if($watch){
                    $statusw = (in_array($id, $watch )) ? 'watch' : 'nowatch';
                } else {
                    $statusw = 'nowatch'; 
                } ?>
                <button data-post="<?php echo $id; ?>" data-status="<?php echo $statusw; ?>" class="watch-user-loop btn sm mx08 my04 px0 dark-bgt-05 dark-b-h snow-c" type="button">
                    <i class="watch-active fa-clock <?php echo ( $statusw == 'watch' ) ? '' : 'far' ; ?>"><span class="sr-only"><?php _e('watch later', 'torotube'); ?></span></i>
                </button>
            <?php } ?>
        </div>
    </div>
    <header class="mt08 c-mt0 c-fg1">
        <h2 class="ttl f14 fwn h123-c"><?php the_title(); ?></h2>
        <p class="meta dfx fww f12 mt04">
            <span><span class="fwb"><?php echo $views; ?></span> <?php _e('views', 'torotube'); ?></span>
            <?php echo ($duration) ? '<span><i class="fa-clock far op05"></i> '.$duration.'</span>' : ''; ?>
        </p>
    </header>
    <a class="lka" href="<?php the_permalink(); ?>"><span class="sr-only"><?php _e('watch video', 'torotube'); ?></span></a>
</article>