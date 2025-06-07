<?php 
class TOROTUBE_Public {
    private $theme_name;
    private $version;

    public function __construct( $theme_name, $version ) {
        $this->theme_name = $theme_name;
        $this->version    = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style( 'torotube_public_main', TOROTUBE_DIR_URI . 'public/css/main.min.css', array(), $this->version, 'all' );
        //wp_enqueue_style( 'torotube_public_icons', TOROTUBE_DIR_URI . 'public/css/icons.min.css', array(), $this->version, 'all' );
    }
    
    public function enqueue_scripts() {
        //wp_enqueue_script( 'torotube_alpine', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js', [], $this->version, true );
        wp_enqueue_script ( 
            'torotube_public_functions', 
            TOROTUBE_DIR_URI . 'public/js/functions.js', 
            [], 
            filemtime(TOROTUBE_DIR_PATH . 'public/js/functions.js'),
            true 
        );

        $logo_dark   = get_theme_mod( 'logo_dark' );
        if($logo_dark && $logo_dark != ''){
            $cl = "'dno': darkm";
            $logoHeadDark = '<img id="logo-theme" width="191" height="48" src="'.$logo_dark.'" alt="'. get_bloginfo( "name" ).'">';
        } else {
            $logoHeadDark = get_bloginfo( "name" );
        }

        $logo_light = get_theme_mod( 'logo_light' ); 
        if($logo_light && $logo_light != ''){
            $cl = "'dib': darkm";
            $logoHeadLight = '<img id="logo-theme"  width="191" height="48" src="'.$logo_light.'" alt="'. get_bloginfo( 'name' ).'">';
        } else {
            $logoHeadLight = get_bloginfo( "name" );
        }

        $urlCurrent = false;
        if(is_tax()){
            $tax        = get_queried_object();
            $urlCurrent = get_term_link($tax);
        }

        $player_array = false;
        if(is_single()){
            global $post;
            $id = $post->ID;
            $player = false;
            $player_array = [];
            $field_video = get_option('torotube_meta_video');
            if(!$field_video) $field_video = 'videos';
            
            $player = get_post_meta( $id, $field_video, true );
            if($player) {
                $player_array[] = (filter_var($player, FILTER_VALIDATE_URL)) ? '<iframe width="929" height="523" src="'.$player.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' : $player;
            }
            $player1 = get_post_meta( $id, 'video_optional_1', true );
            if($player1) {
                $player_array[] = (filter_var($player1, FILTER_VALIDATE_URL)) ? '<iframe width="929" height="523" src="'.$player1.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' : $player1;
            }

            $player2 = get_post_meta( $id, 'video_optional_2', true );
            if($player2) {
                $player_array[] = (filter_var($player2, FILTER_VALIDATE_URL)) ? '<iframe width="929" height="523" src="'.$player2.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' : $player2;
            }

            $player3 = get_post_meta( $id, 'video_optional_3', true );
            if($player3) {
                $player_array[] = (filter_var($player3, FILTER_VALIDATE_URL)) ? '<iframe width="929" height="523" src="'.$player3.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' : $player3;
            }

            $player4 = get_post_meta( $id, 'video_optional_4', true );
            if($player4) {
                $player_array[] = (filter_var($player4, FILTER_VALIDATE_URL)) ? '<iframe width="929" height="523" src="'.$player4.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' : $player4;
            }

        }

        $text_report_sent_successfully   = lang_torotube('Report sent successfully', 'lang_report_sent_successfully');
        $text_somethings_wrong           = lang_torotube('Somethings wrong', 'lang_somethings_wrong');
        $text_enter_new_pass             = lang_torotube('Enter your new password', 'lang_enter_new_pass');
        $text_changes_saved_successfully = lang_torotube('changes saved successfully', 'lang_changes_saved_successfully');

        $redirect_login = get_option('torotube_redirect_login');
        if(!$redirect_login) $redirect_login = esc_url( home_url() );


        $torotube_Public = [
            'url'                           => admin_url( 'admin-ajax.php' ),
            'nonce'                         => wp_create_nonce( 'torotube_seg' ),
            'logoHeadDark'                  => $logoHeadDark,
            'logoHeadLight'                 => $logoHeadLight,
            'urlCurrent'                    => $urlCurrent,
            'player'                        => $player_array,
            'text_report_sent_successfully' => $text_report_sent_successfully,
            'text_somethings_wrong'         => $text_somethings_wrong,
            'redirect_login'                => $redirect_login,
            'text_enter_new_pass'           => $text_enter_new_pass,
            'text_changes_saved_successfully' => $text_changes_saved_successfully,
        ];
        wp_localize_script( 'torotube_public_functions', 'torotube_Public', $torotube_Public );
    }
}