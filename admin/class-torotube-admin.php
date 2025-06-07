<?php 
class TOROTUBE_Admin {
    private $theme_name;
    private $version;
    private $build_menupage;
    
    public function __construct( $theme_name, $version ) {
        $this->theme_name     = $theme_name;
        $this->version        = $version;
        $this->build_menupage = new TOROTUBE_Build_Menupage();
    }
    
    public function enqueue_styles( $hook ) { 
        wp_enqueue_style( 'global_admin_css', TOROTUBE_DIR_URI . 'admin/css/global-admin.css', array(), $this->version, 'all' );
    }
    public function enqueue_scripts( $hook ) {
        wp_enqueue_media();
        wp_enqueue_script( 'torotube_order_js', TOROTUBE_DIR_URI . 'admin/partials/js/order.js', [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'torotube_admin_js', TOROTUBE_DIR_URI . 'admin/partials/js/torotube-admin.js', [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'torotube_global_js', TOROTUBE_DIR_URI . 'admin/js/global-admin.js', [ 'jquery' ], $this->version, true );

        $torotube_Admin = [
            'url'   => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'torotube_seg' ),
        ];
        wp_localize_script( 'torotube_admin_js', 'torotube_Admin', $torotube_Admin );
        
    }


    /**
     * METABOX
     *  L Add metabox
     *  L Save metabox
     */
    public function add_metabox()
    {
        add_meta_box('torotube_metabox', 'Options', [$this, 'torotube_function_metabox'], array('post', 'movies_tt'), 'normal', 'high', null);
        add_meta_box('torotube_metabox_page', 'Options', [$this, 'torotube_function_metabox_page'], 'page', 'normal', 'high', null);
    }
    public function save_metabox($post_id, $post, $update)
    {
        $input_video = get_option('torotube_meta_video', true);
        $input_duration = get_option('torotube_meta_duration', true);
        $input_trailer = get_option('torotube_meta_video_trailer', true);
        if (!isset($_POST['meta-box-nonce']) || !wp_verify_nonce($_POST['meta-box-nonce'], 'act_nonce_name'))
            return $post_id;
        if (!current_user_can('edit_post', $post_id))
            return $post_id;
        if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
            return $post_id;
        $input_metabox = '';
        if (isset($_POST[$input_video])) {
            $input_metabox = $_POST[$input_video];
        }
        update_post_meta($post_id, $input_video, $input_metabox);
        $input_metabox = '';
        if (isset($_POST[$input_duration])) {
            $input_metabox = $_POST[$input_duration];
        }
        update_post_meta($post_id, $input_duration, $input_metabox);
        $input_video_optional_1 = '';
        if (isset($_POST['video_optional_1'])) {
            $input_video_optional_1 = $_POST['video_optional_1'];
        }
        update_post_meta($post_id, 'video_optional_1', $input_video_optional_1);
        $input_video_optional_2 = '';
        if (isset($_POST['video_optional_2'])) {
            $input_video_optional_2 = $_POST['video_optional_2'];
        }
        update_post_meta($post_id, 'video_optional_2', $input_video_optional_2);
        $input_video_optional_3 = '';
        if (isset($_POST['video_optional_3'])) {
            $input_video_optional_3 = $_POST['video_optional_3'];
        }
        update_post_meta($post_id, 'video_optional_3', $input_video_optional_3);
        $input_video_optional_4 = '';
        if (isset($_POST['video_optional_4'])) {
            $input_video_optional_4 = $_POST['video_optional_4'];
        }
        update_post_meta($post_id, 'video_optional_4', $input_video_optional_4);
        
        $input_desc = '';
        if (isset($_POST['torotube_post_desc'])) {
            $input_desc = $_POST['torotube_post_desc'];
        }
        update_post_meta($post_id, 'torotube_post_desc', $input_desc);

        
        $input_title_seo_single = '';
        if (isset($_POST['title_seo_single'])) {
            $input_title_seo_single = $_POST['title_seo_single'];
        }
        update_post_meta($post_id, 'title_seo_single', $input_title_seo_single);

        
        $input_ads_player = '';
        if (isset($_POST['eroz_ads_link'])) {
            $input_ads_player = $_POST['eroz_ads_link'];
        }
        update_post_meta($post_id, 'eroz_ads_link', $input_ads_player);


        $input_ads_player_2 = '';
        if (isset($_POST['eroz_ads_link_2'])) {
            $input_ads_player_2 = $_POST['eroz_ads_link_2'];
        }
        update_post_meta($post_id, 'eroz_ads_link_2', $input_ads_player_2);

        $input_ads_player_3 = '';
        if (isset($_POST['eroz_ads_link_3'])) {
            $input_ads_player_3 = $_POST['eroz_ads_link_3'];
        }
        update_post_meta($post_id, 'eroz_ads_link_3', $input_ads_player_3);

        $input_ads_player_4 = '';
        if (isset($_POST['eroz_ads_link_4'])) {
            $input_ads_player_4 = $_POST['eroz_ads_link_4'];
        }
        update_post_meta($post_id, 'eroz_ads_link_4', $input_ads_player_4);

        $input_metabox = '';
        if (isset($_POST[$input_trailer])) {
            $input_metabox = $_POST[$input_trailer];
        }
        update_post_meta($post_id, $input_trailer, $input_metabox);


        $top_title_seo_page = '';
        if (isset($_POST['top_title_seo_page'])) {
            $top_title_seo_page = $_POST['top_title_seo_page'];
        }
        update_post_meta($post_id, 'top_title_seo_page', $top_title_seo_page);
       
    }

    public function torotube_function_metabox()
    {
        require_once TOROTUBE_DIR_PATH . 'admin/partials/torotube_function_metabox.php';
    }

    public function torotube_function_metabox_page()
    {
        require_once TOROTUBE_DIR_PATH . 'admin/partials/torotube_function_metabox_page.php';
    }

    public function add_menu()
    {
        $this->build_menupage->add_menu_page(
            __('Report videos', 'torotube'),
            __('Report videos', 'torotube'),
            'manage_options',
            'report_videos',
            [$this, 'report_videos'],
            'dashicons-admin-generic',
            32
        );
        $this->build_menupage->run();
    }
    public function report_videos()
    {
        require_once TOROTUBE_DIR_PATH . 'admin/partials/report_videos.php';
    }
   
}