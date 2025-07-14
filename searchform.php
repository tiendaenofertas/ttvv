<?php 
$search_enable_ajax = get_option('search_enable_ajax');
$search_placeholder = get_option('search_placeholder');
$enable_ajax = get_option( 'search_enable_ajax' );
?>

<form method="get" action="<?php echo get_home_url(); ?>" class="dfx sw02 brp snow-b">
    <input <?php echo ($enable_ajax) ? 'id="tr_live_search"' : ''; ?> name="s" class="bgt bd0 brp pl24" placeholder="<?php echo ($search_placeholder) ? $search_placeholder : ''; ?>" type="search" aria-label="Search" class="bd0">
    <button class="btn bgt text-c mr04 op05 op1-h" type="submit"><i class="fa-search far f20"></i></button>
</form>

<?php echo ($enable_ajax) ? '<ul id="list-search" class="sub-menu dno lt0 rt0 w100p mt16 f14 pos c-poa snow-b sw02 zi3 py08 br04 mx0"></ul>' : ''; ?>