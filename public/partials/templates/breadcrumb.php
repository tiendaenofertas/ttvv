<?php 
$id         = get_the_ID();
$data       = new TOROTUBE_Post;
$categories = $data->get_categories_one($id);
?>

<nav class="breadcrumb fb1 c-col-2 or3 c-or0">
    <p class="f12 text-c cci-c">
        <a href="<?php echo esc_url( home_url() ); ?>"><i class="fa-home far mr08 op05"></i><?php _e('Home', 'torotube'); ?></a>
        <i class="fa-angle-right far op05 px08"></i>
        <?php if($categories){
            echo $categories; ?>
            <i class="fa-angle-right far op05 px08"></i>
        <?php } ?>
        <span><?php the_title(); ?></span>
    </p>
</nav>