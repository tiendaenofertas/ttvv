<?php 
class TOROTUBE_Theme_Support {

    public function add_support(){
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        //add_theme_support( 'custom-logo' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background');
    }

    public function remove_elements_wordpress(){

        remove_action( 'wp_head', 'feed_links', 2 ); //removes feed links.
        remove_action('wp_head', 'feed_links_extra', 3 );  //removes comments feed. 
        remove_filter('the_content', 'wptexturize');
        remove_filter('the_title', 'wptexturize');
        remove_filter('single_post_title', 'wptexturize');
        remove_filter('comment_text', 'wptexturize');
        remove_filter('the_excerpt', 'wptexturize');
        remove_filter('content_save_pre', 'wp_filter_post_kses');
        remove_filter('content_filtered_save_pre', 'wp_filter_post_kses'); 
        add_filter( 'emoji_svg_url', '__return_false' );
        remove_action( 'wp_head', 'wp_resource_hints' );
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'adjacent_posts_rel_link');
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script');
        //add_filter('show_admin_bar','__return_false');
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
        add_filter('the_generator', '__return_false');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action( 'wp_head', 'dns-prefetch' );
        remove_action( 'wp_head', 'rest_output_link_wp_head' );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        
        // all actions related to emojis
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_action('wp_head', 'wp_oembed_add_host_js');
    }


    public function remove_gutemberg(){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' ); 
    }

    /* ADD CLASS */
    public function add_class_body( $classes ){

        /* sidebar position */
        $sidebar_general = get_option( 'torotube_sidebar_general' );
        if(!$sidebar_general) $sidebar_general = 'tt-nsdb';
		
        if( is_home() or is_front_page() ){
			$sp = get_option( 'torotube_sidebar_home' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;	
		} elseif(is_single() or is_page_template( 'pages/page-videos.php' ) or is_single('movies_tt') or is_archive('movies_tt')){
			$sp = get_option( 'torotube_sidebar_single' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;
		} elseif(is_category() or is_tag() or is_page_template( 'pages/page-category.php' ) ){
			$sp = get_option( 'torotube_sidebar_category' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;
		} elseif( is_tax( 'channel_tt' ) or is_page_template( 'pages/page-channel.php' ) ) {
            $sp = get_option( 'torotube_sidebar_channel' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;
        } elseif( is_tax( 'toro_pornstar' ) or is_page_template( 'pages/page-pornstar.php' ) ) {
            $sp = get_option( 'torotube_sidebar_pornstar' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;
        } elseif( is_search() ){
            $sp = get_option( 'torotube_sidebar_search' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;
        } elseif( is_page_template( 'pages/page-favorite.php' ) or is_page_template( 'pages/page-watch.php' ) or is_page_template( 'pages/page-user.php' ) ){
            $sp = get_option( 'torotube_sidebar_user' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;
        } elseif( is_404() ){
            $sp = get_option( 'torotube_sidebar_404' );
			$sidebar_position = ($sp) ? $sp : $sidebar_general;
        } else{
			$sidebar_position = 'tt-nsdb';
		} 
		$classes[] = $sidebar_position;

        /* video center */
        $video_center = get_option( 'video_center' );
        if($video_center && (is_singular('post') or is_singular('movies_tt')) ) $classes[] = 'tt-vbox';

        /* header sticky */
        $header_sticky = get_option( 'sticky_header_enable' );

        if($header_sticky === true) $classes[] = 'tt-hdfx';

        /* sidebar sticky */
        $sidebar_sticky = get_option( 'sticky_sidebar_enable' );

        if($sidebar_sticky === true) $classes[] = 'tt-sdfx';

		return $classes;
	}


}