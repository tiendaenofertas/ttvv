<?php 
$block = $args['block']; 

if($block->tags_select == 'tag') {
    $tax = 'post_tag';
} elseif($block->tags_select == 'cat') {
    $tax = 'category';
} else {
    $tax = 'post_tag';
}

$number = ( $block->tags_number && $block->tags_number != '' && $block->tags_number != 0 ) ? $block->tags_number : 10;

$order  = ( $block->tags_order && $block->tags_order != '' ) ? $block->tags_order : 'name';

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

if ( !empty($taxonomies) ) :
?>
    <div class="tagcloud">
        <?php foreach( $taxonomies as $category ){ 
            $name = $category->name;
            $url  = get_term_link( $category );
            ?>
            <a href="<?php echo $url; ?>"><?php echo $name; ?></a>
        <?php } ?>
    </div>
<?php endif; ?>