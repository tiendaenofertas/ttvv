<?php 

if(is_home() or is_front_page()) { 
    $title_seo = get_option('titles_seo_h1_home');
    if($title_seo) {
       echo '<h1 class="ttl tac f12 fwn py08 px16 gray-b or3 c-or0">'.$title_seo.'</h1>';
    } else {
        echo '<h1 class="ttl tac f12 fwn py08 px16 gray-b or3 c-or0">'.get_bloginfo('name').'</h1>';
    }
 } elseif(is_page()) {
    global $post;
    $title_seo = get_post_meta( $post->ID, 'top_title_seo_page', true );
    if($title_seo) {
        echo '<h1 class="ttl tac f12 fwn py08 px16 gray-b or3 c-or0">'.$title_seo.'</h1>';
    }
} elseif(is_single()){
    global $post;
    $title_seo = get_post_meta( $post->ID, 'title_seo_single', true );
    if($title_seo) {
        echo '<h1 class="ttl tac f12 fwn py08 px16 gray-b or3 c-or0">'.$title_seo.'</h1>';
    }
} elseif(is_tax() or is_category() or is_tag()){
    $id = get_queried_object_id();
    $metafieldArray = get_option('taxonomy_'. $id);
    if($metafieldArray){
        $metafieldoutput = $metafieldArray['custom_term_meta'];
        echo '<h1 class="ttl tac f12 fwn py08 px16 gray-b or3 c-or0">'.$metafieldoutput.'</h1>';
    } 
}
 
?>