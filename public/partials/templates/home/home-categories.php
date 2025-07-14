<?php 

$dataTax = new TOROTUBE_Tax;

$block = $args['block']; 

if($block->categories_select == 'tag') {
    $tax = 'post_tag';
} elseif($block->categories_select == 'cat') {
    $tax = 'category';
} else {
    $tax = 'category';
}
$title_section      = ( $block->categories_title ) ? $block->categories_title : false;
$url_section        = ( $block->categories_url ) ? $block->categories_url : false;
$number = ( $block->categories_number && $block->categories_number != '' && $block->categories_number != 0 ) ? $block->categories_number : 6;

$order  = ( $block->categories_order && $block->categories_order != '' ) ? $block->categories_order : 'name';

if($order != 'random'){

    $or = ($order == 'count') ? 'DESC': 'ASC';

    $taxonomies = get_terms( array(
        'taxonomy'   => $tax,
        'hide_empty' => true,
        'number'     => $number,
        'orderby'    => $order,
        'order'      => $or,
    ) );

} else {

    $taxonomies = get_terms( array(
        'taxonomy'   => $tax,
        'hide_empty' => true,
        'number'     => $number,
    ) );

    shuffle( $taxonomies );
}

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
    
    <?php if ( !empty($taxonomies) ) : ?>
    <div class="dgd gtf gp08 mt16 d-mt24 rspl c-gt3 f-gt6">
        
        <?php
        foreach( $taxonomies as $cat ){ 
            $id       = $cat->term_id;
            $name     = $cat->name;
            $count    = $cat->count;
            $url      = get_term_link( $cat );
            $image    = $dataTax->get_image_url($id, 'mini'); ?>
            <div class="ctgr snow-b sw03 pd08 por ovh brp dfx aic">
                <div class="thumb por w64 mr16">
                    <figure class="por ovh brc">
                        <img class="poa w100p h100p ofc" height="64" width="64" loading="lazy" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
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
        ?>
    </div>
    <?php endif; ?>
</section>