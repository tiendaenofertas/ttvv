<?php 
class TOROTUBE_Master {
    protected $cargador;
    protected $theme_name;
    protected $version;
    /** Dynamic properties defined for PHP 8.2+ compatibility */
    protected $support;
    protected $torotube_admin;
    protected $torotube_public;
    protected $ajax_admin;
    protected $ajax_public;
    protected $sidebar;
    protected $menu;
    protected $tax;
    protected $cpt;
    protected $permalinks;
    public function __construct() {
        $this->theme_name = 'TOROTUBE_Theme';
        $this->version = TOROTUBE_VERSION;
        $this->load_dependencies();
        $this->load_instances();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    private function load_dependencies() {

        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-cargador.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-build-menupage.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-support.php';
        require_once TOROTUBE_DIR_PATH . 'admin/class-torotube-admin.php';
        require_once TOROTUBE_DIR_PATH . 'public/class-torotube-public.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-cpt.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-ajax.admin.php';
        require_once TOROTUBE_DIR_PATH . 'includes/data/data-post.php';
        require_once TOROTUBE_DIR_PATH . 'includes/data/data-tax.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-sidebar.php';
        require_once TOROTUBE_DIR_PATH . 'includes/widgets/wdgt_recommend.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-menu.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-tax.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-cpt.php';
        require_once TOROTUBE_DIR_PATH . 'public/partials/do_action/do_action_header.php';
        require_once TOROTUBE_DIR_PATH . 'includes/customizer.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-ajax-public.php';
        require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-permalinks.php';
    }
    private function load_instances() {
        $this->cargador        = new TOROTUBE_Cargador;
        $this->support         = new TOROTUBE_Theme_Support;
        $this->torotube_admin  = new TOROTUBE_Admin( $this->get_theme_name(), $this->get_version() );
        $this->torotube_public = new TOROTUBE_Public( $this->get_theme_name(), $this->get_version() );
        $this->ajax_admin      = new TOROTUBE_Ajax_Admin;
        $this->ajax_public     = new TOROTUBE_Ajax_Public;
        $this->sidebar         = new TOROTUBE_Sidebar;
        $this->menu            = new TOROTUBE_Menus;
        $this->tax             = new TOROTUBE_Create_Taxonomy;
        $this->cpt             = new TOROTUBE_Create_CustomPostType;
        $this->permalinks      = new TOROTUBE_permalinks;
    }
    private function define_admin_hooks() {
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->torotube_admin, 'enqueue_styles' );
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->torotube_admin, 'enqueue_scripts' );
        $this->cargador->add_action( 'init', $this->support, 'add_support' );
        $this->cargador->add_action( 'init', $this->support, 'remove_elements_wordpress' );
        $this->cargador->add_action( 'wp_enqueue_scripts', $this->support, 'remove_gutemberg' );
        			  
        $this->cargador->add_action( 'init', $this->sidebar, 'create_sidebar');		  
        $this->cargador->add_action( 'init', $this->menu, 'create_menu');	  
        $this->cargador->add_action( 'init', $this->tax, 'pornstar');	  
        $this->cargador->add_action( 'init', $this->tax, 'channel');	  
        $this->cargador->add_action( 'init', $this->tax, 'quality');
        $this->cargador->add_action( 'init', $this->cpt, 'movies');
        $this->cargador->add_filter( 'body_class', $this->support, 'add_class_body' );

        $this->cargador->add_action('add_meta_boxes', $this->torotube_admin, 'add_metabox');
        $this->cargador->add_action('save_post', $this->torotube_admin, 'save_metabox', 10, 3);

        
        $report_enable  = get_option( 'enable_report_form' );
        if($report_enable)
            $this->cargador->add_action('admin_menu', $this->torotube_admin, 'add_menu');

        $this->cargador->add_action('wp_ajax_action_torotube_clean_report', $this->ajax_admin, 'torotube_clean_report');
    }

    private function define_public_hooks() {
        $this->cargador->add_action( 'wp_enqueue_scripts', $this->torotube_public, 'enqueue_styles' );
        $this->cargador->add_action( 'wp_footer', $this->torotube_public, 'enqueue_scripts' );
        
        $this->cargador->add_action( 'wp_ajax_action_favorite', $this->ajax_public , 'favorite' );
        $this->cargador->add_action( 'wp_ajax_action_watch', $this->ajax_public , 'watch' );
        $this->cargador->add_action( 'wp_ajax_action_vote_up', $this->ajax_public , 'vote_up' );
        $this->cargador->add_action( 'wp_ajax_nopriv_action_vote_up', $this->ajax_public , 'vote_up' );
        $this->cargador->add_action( 'wp_ajax_action_vote_down', $this->ajax_public , 'vote_down' );
        $this->cargador->add_action( 'wp_ajax_nopriv_action_vote_down', $this->ajax_public , 'vote_down' );

        $this->cargador->add_action( 'wp_ajax_action_vote_up_tax', $this->ajax_public , 'vote_up_tax' );
        $this->cargador->add_action( 'wp_ajax_nopriv_action_vote_up_tax', $this->ajax_public , 'vote_up_tax' );
        $this->cargador->add_action( 'wp_ajax_action_vote_down_tax', $this->ajax_public , 'vote_down_tax' );
        $this->cargador->add_action( 'wp_ajax_nopriv_action_vote_down_tax', $this->ajax_public , 'vote_down_tax' );
        
        $this->cargador->add_action( 'wp_ajax_nopriv_action_login', $this->ajax_public , 'login' );
        $this->cargador->add_action( 'wp_ajax_nopriv_action_register', $this->ajax_public , 'register' );

        $this->cargador->add_action( 'wp_ajax_action_search_suggest', $this->ajax_public , 'search_suggest' );
        $this->cargador->add_action( 'wp_ajax_nopriv_action_search_suggest', $this->ajax_public , 'search_suggest' );

        $this->cargador->add_action( 'wp_ajax_action_reportform', $this->ajax_public , 'reportform' );
        $this->cargador->add_action( 'wp_ajax_nopriv_action_reportform', $this->ajax_public , 'reportform' );

        $this->cargador->add_action( 'wp_ajax_action_edit_profile', $this->ajax_public , 'edit_profile' );
        $this->cargador->add_action( 'wp_ajax_action_remove_favorite', $this->ajax_public , 'remove_favorite' );
    }

    public function run() {
        $this->cargador->run();
    }
    public function get_theme_name() {
        return $this->theme_name;
    }
    public function get_cargador() {
        return $this->cargador;
    }
    public function get_version() {
        return $this->version;
    }
}
