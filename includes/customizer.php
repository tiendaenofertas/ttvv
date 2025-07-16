<?php
if (class_exists('WP_Customize_Control')) :
    class Eroz_TinyMCE_Custom_control extends WP_Customize_Control
    {
        public $type = 'tinymce_editor';
        public function enqueue()
        {
            wp_enqueue_script('skyrocket-custom-controls-js', TOROTUBE_DIR_URI . 'helpers/customizer/customizer.js', array('jquery'), '1.0', true);
            wp_enqueue_style('skyrocket-custom-controls-css', TOROTUBE_DIR_URI . 'helpers/customizer/customizer.css', array(), '1.0', 'all');
            wp_enqueue_editor();
        }
        public function to_json()
        {
            parent::to_json();
            $this->json['skyrockettinymcetoolbar1'] = isset($this->input_attrs['toolbar1']) ? esc_attr($this->input_attrs['toolbar1']) : 'bold italic bullist numlist alignleft aligncenter alignright link';
            $this->json['skyrockettinymcetoolbar2'] = isset($this->input_attrs['toolbar2']) ? esc_attr($this->input_attrs['toolbar2']) : '';
        }
        public function render_content()
        {
?>
            <div class="tinymce-control">
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) { ?>
                    <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php } ?>
                <textarea id="<?php echo esc_attr($this->id); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr($this->value()); ?></textarea>
            </div>
<?php
        }
    }
endif;

function themeslug_sanitize_radio($input, $setting)
{
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}


function theme_slug_sanitize_js_code($input)
{
    return base64_encode($input);
}

//output escape function    
function theme_slug_escape_js_output($input)
{
    return esc_textarea(base64_decode($input));
}


if (class_exists('WP_Customize_Control')) {
    class Separator_Custom_control extends WP_Customize_Control
    {
        public $type = 'separator';

        public function render_content()
        {

            echo '<h2 style="color: #051e31">' . $this->label . '</h2>';
            echo '<hr>';
        }
    }
}


require_once TOROTUBE_DIR_PATH . 'helpers/customizer-repeater-production/functions.php';


function my_customize_register($wp_customize)
{

    function theme_slug_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    function theme_slug_sanitize_checkbox($input)
    {
        return ((isset($input) && true == $input) ? true : false);
    }

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('header_image');


    /* ADD LOGO */
    $wp_customize->add_setting('logo_dark');
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'theme_logo',
            array(
                'label'    => __('Logo Dark', 'torotube'),
                'section'  => 'title_tagline',
                'settings' => 'logo_dark',
                'priority' => 128
            )
        )
    );

    $wp_customize->add_setting('logo_light');
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'theme_logo_light',
            array(
                'label'    => __('Logo Light', 'torotube'),
                'section'  => 'title_tagline',
                'settings' => 'logo_light',
                'priority' => 128
            )
        )
    );



    $wp_customize->add_panel('torotube_options', array(
        'title' => 'Torotube',
        'priority' => 30,
        'capability' => 'edit_theme_options',
    ));

    /**
     * Section General
     * * Theme mode: dark or light
     */

    $wp_customize->add_section('general_section', array(
        'title'      => __('General', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_sticky_header_thememode');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_sticky_header_thememode',
        array(
            'settings' => 'separator_sticky_header_thememode',
            'section'  => 'general_section',
            'label'    => __('Theme mode', 'torotube'),
            'priority' => 2,
        )
    ));

    $wp_customize->add_setting('thememode_option', array(
        'capability'        => 'edit_theme_options',
        'default'           => 'light',
        'sanitize_callback' => 'themeslug_sanitize_radio',
    ));

    $wp_customize->add_control('thememode_option', array(
        'type'    => 'radio',
        'section' => 'general_section',
        'label'   => __('Select theme mode by default'),
        'choices' => array(
            'dark'  => __('Dark', 'torotube'),
            'light' => __('Light', 'torotube'),
        ),
    ));



    #Header
    $wp_customize->add_section('header_section', array(
        'title'      => __('Header', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_sticky_header');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_sticky_header',
        array(
            'settings' => 'separator_sticky_header',
            'section' => 'header_section',
            'label'   => __('Sticky Header', 'torotube'),
            'priority'   => 2,
        )
    ));


    $wp_customize->add_setting('sticky_header_enable', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('sticky_header_enable', array(
        'label' => __('Enable', 'torotube'),
        'section' => 'header_section',
        'priority' => 2,
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('separator_settin_header_search');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_settin_header_search',
        array(
            'settings' => 'separator_settin_header_search',
            'section' => 'header_section',
            'label'   => __('Search form', 'torotube'),
            'priority'   => 2,
        )
    ));

    $wp_customize->add_setting('search_header_enable', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('search_header_enable', array(
        'label' => __('Enable', 'torotube'),
        'section' => 'header_section',
        'priority' => 2,
        'type' => 'checkbox'
    ));
    $wp_customize->add_setting('search_enable_ajax', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('search_enable_ajax', array(
        'label' => __('Suggested search', 'torotube'),
        'section' => 'header_section',
        'priority' => 2,
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('number_items_search_ajax', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('number_items_search_ajax', array(
        'label' => __('Number of items', 'torotube'),
        'section' => 'header_section',
        'priority' => 2,
        'type' => 'number',
    ));

    $wp_customize->add_setting('search_placeholder', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('search_placeholder', array(
        'label'    => __('Placeholder of search form', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'text'
    ));


    $wp_customize->add_setting('separator_settin_header_menu_user');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_settin_header_menu_user',
        array(
            'settings' => 'separator_settin_header_menu_user',
            'section' => 'header_section',
            'label'   => __('User Menu', 'torotube'),
            'priority'   => 2,
        )
    ));

    $wp_customize->add_setting('user_menu_enable', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('user_menu_enable', array(
        'label' => __('Enable', 'torotube'),
        'section' => 'header_section',
        'priority' => 2,
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('user_menu_profile', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('user_menu_profile', array(
        'label'    => __('Profile', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('user_menu_favorite', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('user_menu_favorite', array(
        'label'    => __('Favorites', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'checkbox'
    ));


    $wp_customize->add_setting('user_menu_watch_later', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('user_menu_watch_later', array(
        'label'    => __('Watch Later', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('user_menu_login', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('user_menu_login', array(
        'label'    => __('Log in', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'checkbox'
    ));
    $wp_customize->add_setting('user_menu_signin', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('user_menu_signin', array(
        'label'    => __('Sign in', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'checkbox'
    ));
    $wp_customize->add_setting('user_menu_dark_mode', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('user_menu_dark_mode', array(
        'label'    => __('Dark mode', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('separator_header_scripts');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_header_scripts',
        array(
            'settings' => 'separator_header_scripts',
            'section' => 'header_section',
            'label'   => __('Scripts Code', 'torotube'),
            'priority'   => 2,
        )
    ));

    $wp_customize->add_setting('script_code_header', array(
        'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'theme_slug_sanitize_js_code',
        'sanitize_js_callback' => 'theme_slug_escape_js_output'
    ));
    $wp_customize->add_control('script_code_header', array(
        'label'    => __('Insert your scripts code', 'torotube'),
        'section'  => 'header_section',
        'priority' => 2,
        'type'     => 'textarea',
    ));



    #Home section
    $wp_customize->add_section('home_section', array(
        'title'      => __('Home', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_titles_h1');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_titles_h1',
        array(
            'settings' => 'separator_titles_h1',
            'section' => 'home_section',
            'label'   => __('Title Seo', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('titles_seo_h1_home', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('titles_seo_h1_home', array(
        'label'    => __('Title h1', 'torotube'),
        'section'  => 'home_section',
        'priority' => 1,
        'type'     => 'text',
    ));


    $wp_customize->add_setting('separator_blocks_homes');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_blocks_homes',
        array(
            'settings' => 'separator_blocks_homes',
            'section'  => 'home_section',
            'label'    => __('Blocks Home', 'torotube'),
            'priority' => 1,
        )
    ));
    /* panels of home */
    $wp_customize->add_setting('torotube_panel_homet', array(
        /* 'sanitize_callback' => 'customizer_repeater_sanitize', */
        'label' => 'Blocks Home'
    ));
    $wp_customize->add_control(new Customizer_Repeater($wp_customize, 'torotube_panel_homet', array(
        'label'                              => esc_html__('Blocks of Home', 'torotube'),
        'section'                            => 'home_section',
        'priority'                           => 1,
        'customizer_repeater_hidden_control' => true,
        'label'                              => 'Blocks Home'
    )));



    /* text editor */
    $wp_customize->add_setting('separator_setting222');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting222',
        array(
            'settings' => 'separator_setting222',
            'section' => 'home_section',
            'label'   => __('Text SEO Home', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('text_seo_title', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('text_seo_title', array(
        'label'    => __('Title', 'torotube'),
        'section'  => 'home_section',
        'priority' => 2,
        'type'     => 'text'
    ));

    $wp_customize->add_setting(
        'sample_tinymce_editor',
        array(
            'type'              => 'option',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'wp_kses_post'
        )
    );
    $wp_customize->add_control(new Eroz_TinyMCE_Custom_control(
        $wp_customize,
        'sample_tinymce_editor',
        array(
            'label' => __('Description', 'torotube'),
            'section' => 'home_section',
            'input_attrs' => array(
                'toolbar1' => 'formatselect bold italic bullist numlist alignleft aligncenter alignright link',
            )
        )
    ));


    #Single section
    $wp_customize->add_section('video_section', array(
        'title'      => __('Video', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_setting');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting',
        array(
            'settings' => 'separator_setting',
            'section' => 'video_section',
            'label'   => __('ADS or banner above the player', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('player_above_text', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('player_above_text', array(
        'label' => __('Text', 'torotube'),
        'section' => 'video_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('player_above_url', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('player_above_url', array(
        'label' => __('URL', 'torotube'),
        'section' => 'video_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('player_above_target', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('player_above_target', array(
        'label'    => 'Open new window',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('separator_setting2');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting2',
        array(
            'settings' => 'separator_setting',
            'section' => 'video_section',
            'label'   => __('ADS lateral Player', 'torotube'),
            'priority'   => 1,
        )
    ));



    $wp_customize->add_setting('player_ads_lateral', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('player_ads_lateral', array(
        'label'    => __('Player ADS Lateral', 'torotube'),
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('separator_setting3');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting3',
        array(
            'settings' => 'separator_setting',
            'section' => 'video_section',
            'label'   => __('ADS inside the player', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('player_inside', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('player_inside', array(
        'label' => __('ADS Inside Player', 'torotube'),
        'section' => 'video_section',
        'priority' => 1,
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('separator_setting4');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting4',
        array(
            'settings' => 'separator_setting',
            'section' => 'video_section',
            'label'   => __('Features video player', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('video_center', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('video_center', array(
        'label'    => 'Enabled video center',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('video_views', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('video_views', array(
        'label'    => 'Enabled views',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('video_comments', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('video_comments', array(
        'label'    => 'Enabled comments',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('video_favorites', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('video_favorites', array(
        'label'    => 'Enabled favorite',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));
    $wp_customize->add_setting('video_watch_later', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('video_watch_later', array(
        'label'    => 'Enabled Watch Later',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('video_share', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('video_share', array(
        'label'    => 'Enable Share',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('video_thumbs', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('video_thumbs', array(
        'label'    => 'Enable Thumbs',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('separator_setting_video_report');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting_video_report',
        array(
            'settings' => 'separator_setting_video_report',
            'section' => 'video_section',
            'label'   => __('Report form', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('enable_report_form', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('enable_report_form', array(
        'label'    => 'Enable Report Form',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));


    $wp_customize->add_setting('torotube_enable_user', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_enable_user', array(
        'label'    => __('Report form visible for', 'torotube'),
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'select',
        'choices'  => array(
            'user_register'    => __('Registered users', 'torotube'),
            'user_no_register' => __('Unregistered users', 'torotube'),
            'user_all'         => __('All users', 'torotube')
        )
    ));


    $wp_customize->add_setting('list_reason_form', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('list_reason_form', array(
        'label'    => __('list of reasons (one per line)', 'torotube'),
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'textarea',
    ));


    $wp_customize->add_setting('separator_setting5');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting5',
        array(
            'settings' => 'separator_setting',
            'section' => 'video_section',
            'label'   => __('Related videos', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('enable_related', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('enable_related', array(
        'label'    => 'Enable Related',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));


    $wp_customize->add_setting('single_related_title', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('single_related_title', array(
        'label' => __('Title of section', 'torotube'),
        'section' => 'video_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('single_related_number', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('single_related_number', array(
        'label' => __('Number of items', 'torotube'),
        'section' => 'video_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('separator_video_trailer');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_video_trailer',
        array(
            'settings' => 'separator_video_trailer',
            'section' => 'video_section',
            'label'   => __('Video Trailer', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('enable_video_trailer', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('enable_video_trailer', array(
        'label'    => 'Enable video trailer on loop',
        'section'  => 'video_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    #comments section
    $wp_customize->add_section('comment_section', array(
        'title'      => __('Comments', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_comment_video');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_comment_video',
        array(
            'settings' => 'separator_comment_video',
            'section' => 'comment_section',
            'label'   => __('Configuration', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('disable_section_comment', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('disable_section_comment', array(
        'label'    => 'Disable comment section',
        'section'  => 'comment_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('disable_form_comment', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('disable_form_comment', array(
        'label'    => 'Disable comment form',
        'section'  => 'comment_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));
    $wp_customize->add_setting('disable_list_comment', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('disable_list_comment', array(
        'label'    => 'Disable comment list',
        'section'  => 'comment_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('separator_comment_disqus');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_comment_disqus',
        array(
            'settings' => 'separator_comment_disqus',
            'section' => 'comment_section',
            'label'   => __('Disqus Option', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('enable_disqus', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('enable_disqus', array(
        'label'    => 'Enable Disquz',
        'section'  => 'comment_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('disqus_code', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_js_code',
        'sanitize_js_callback' => 'theme_slug_escape_js_output'
    ));
    $wp_customize->add_control('disqus_code', array(
        'label'    => __('Disqus code', 'torotube'),
        'section'  => 'comment_section',
        'priority' => 1,
        'type'     => 'textarea',
    ));

    #Category section
    $wp_customize->add_section('category_section', array(
        'title'      => __('Category', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_setting('separator_category_archive');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_category_archive',
        array(
            'settings' => 'separator_category_archive',
            'section' => 'category_section',
            'label'   => __('Category Archive', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('category_archive_number', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('category_archive_number', array(
        'label' => __('Number of items', 'torotube'),
        'section' => 'category_section',
        'priority' => 1,
        'type' => 'number',
    ));

    #Pornstar section
    $wp_customize->add_section('pornstar_section', array(
        'title'      => __('Pornstar', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_setting('separator_pornstar_archive');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_pornstar_archive',
        array(
            'settings' => 'separator_pornstar_archive',
            'section' => 'pornstar_section',
            'label'   => __('Pornstar Archive', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('enable_alphabet_pornstar_archive', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('enable_alphabet_pornstar_archive', array(
        'label'    => __('Enable alphabet', 'torotube'),
        'section'  => 'pornstar_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('pornstar_archive_number', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('pornstar_archive_number', array(
        'label' => __('Number of items', 'torotube'),
        'section' => 'pornstar_section',
        'priority' => 1,
        'type' => 'number',
    ));




    #Channel section
    $wp_customize->add_section('channel_section', array(
        'title'      => __('Channel', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_channel_archive');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_channel_archive',
        array(
            'settings' => 'separator_channel_archive',
            'section' => 'channel_section',
            'label'   => __('Channel Archive', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('enable_alphabet_channel_archive', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox',
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('enable_alphabet_channel_archive', array(
        'label'    => __('Enable alphabet', 'torotube'),
        'section'  => 'channel_section',
        'priority' => 1,
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('channel_archive_number', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('channel_archive_number', array(
        'label' => __('Number of items', 'torotube'),
        'section' => 'channel_section',
        'priority' => 1,
        'type' => 'number',
    ));




    #Footer section
    $wp_customize->add_section('footer_section', array(
        'title'      => __('Footer', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('footer_logo', array(
        'default' => '', // Add Default Image URL 
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_control', array(
        'label' => 'Upload Logo',
        'priority' => 1,
        'section' => 'footer_section',
        'settings' => 'footer_logo',
        'button_labels' => array( // All These labels are optional
            'select' => 'Select Logo',
            'remove' => 'Remove Logo',
            'change' => 'Change Logo',
        )
    )));


    $wp_customize->add_setting('separator_footer_scripts');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_footer_scripts',
        array(
            'settings' => 'separator_footer_scripts',
            'section' => 'footer_section',
            'label'   => __('Scripts Code', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('script_code_footer', array(
        'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'theme_slug_sanitize_js_code',
        'sanitize_js_callback' => 'theme_slug_escape_js_output'
    ));
    $wp_customize->add_control('script_code_footer', array(
        'label'    => __('Insert your scripts code', 'torotube'),
        'section'  => 'footer_section',
        'priority' => 1,
        'type'     => 'textarea',
    ));


    #Sidebar
    $wp_customize->add_section('sidebar_section', array(
        'title'      => __('Sidebar', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));


    $wp_customize->add_setting('separator_sticky_sidebar');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_sticky_sidebar',
        array(
            'settings' => 'separator_sticky_sidebar',
            'section' => 'sidebar_section',
            'label'   => __('Sticky Sidebar', 'torotube'),
            'priority'   => 2,
        )
    ));

    $wp_customize->add_setting('sticky_sidebar_enable', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));
    $wp_customize->add_control('sticky_sidebar_enable', array(
        'label' => __('Enable', 'torotube'),
        'section' => 'sidebar_section',
        'priority' => 2,
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('separator_sidebar_position');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_sidebar_position',
        array(
            'settings' => 'separator_sidebar_position',
            'section' => 'sidebar_section',
            'label'   => __('Sidebar Position', 'torotube'),
            'priority'   => 2,
        )
    ));

    $wp_customize->add_setting('torotube_sidebar_general', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_general', array(
        'label'    => __('Sidebar General', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* sidebar home */
    $wp_customize->add_setting('torotube_sidebar_home', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_home', array(
        'label'    => __('Sidebar Home', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* sidebar single */
    $wp_customize->add_setting('torotube_sidebar_single', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_single', array(
        'label'    => __('Sidebar Video', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* sidebar category */
    $wp_customize->add_setting('torotube_sidebar_category', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_category', array(
        'label'    => __('Sidebar Category', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* sidebar pornstar and page pornstar */
    $wp_customize->add_setting('torotube_sidebar_pornstar', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_pornstar', array(
        'label'    => __('Sidebar Pornstar', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* sidebar channel and page channels */
    $wp_customize->add_setting('torotube_sidebar_channel', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_channel', array(
        'label'    => __('Sidebar Channel', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* search sidebar */
    $wp_customize->add_setting('torotube_sidebar_search', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_search', array(
        'label'    => __('Sidebar Search', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* 404 sidebar */
    $wp_customize->add_setting('torotube_sidebar_404', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_404', array(
        'label'    => __('Sidebar 404', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    /* user sidebar */
    $wp_customize->add_setting('torotube_sidebar_user', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_slug_sanitize_select'
    ));
    $wp_customize->add_control('torotube_sidebar_user', array(
        'label'    => __('Sidebar User', 'torotube'),
        'section'  => 'sidebar_section',
        'priority' => 2,
        'type'     => 'select',
        'choices'  => array(
            'tt-sdbl'  => __('Left', 'torotube'),
            'tt-sdbr' => __('Right', 'torotube'),
            'tt-nsdb'  => __('None', 'torotube')
        )
    ));

    #Login
    $wp_customize->add_section('login_section', array(
        'title'      => __('Login', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_pages_login');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_pages_login',
        array(
            'settings' => 'separator_pages_login',
            'section'  => 'login_section',
            'label'    => __('URL Pages', 'torotube'),
            'priority' => 1,
        )
    ));


    $wp_customize->add_setting('torotube_login_url', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('torotube_login_url', array(
        'label'    => __('Login URL Page', 'torotube'),
        'section'  => 'login_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('torotube_register_url', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('torotube_register_url', array(
        'label'    => __('Register URL Page', 'torotube'),
        'section'  => 'login_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('torotube_user_profile_url', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('torotube_user_profile_url', array(
        'label'    => __('User Profile URL Page', 'torotube'),
        'section'  => 'login_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('torotube_user_favorite_url', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('torotube_user_favorite_url', array(
        'label'    => __('Favorite URL Page', 'torotube'),
        'section'  => 'login_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('torotube_user_watch_url', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('torotube_user_watch_url', array(
        'label'    => __('Watch later URL Page', 'torotube'),
        'section'  => 'login_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('separator_redirect');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_redirect',
        array(
            'settings' => 'separator_redirect',
            'section'  => 'login_section',
            'label'    => __('Redirect', 'torotube'),
            'priority' => 1,
        )
    ));

    $wp_customize->add_setting('torotube_redirect_login', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('torotube_redirect_login', array(
        'label'    => __('Redirect after login URL Page', 'torotube'),
        'section'  => 'login_section',
        'priority' => 1,
        'type'     => 'text',
    ));


    #Metabox section
    $wp_customize->add_section('metabox_section', array(
        'title' => __('Metabox', 'torotube'),
        'panel' => 'torotube_options',
        'priority' => 1,
        'capability' => 'edit_theme_options',
    ));
    #metabox video
    $wp_customize->add_setting('torotube_meta_video', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('torotube_meta_video', array(
        'label'    => __('Metabox video', 'torotube'),
        'section'  => 'metabox_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    #metabox duration
    $wp_customize->add_setting('torotube_meta_duration', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('torotube_meta_duration', array(
        'label' => __('Metabox duration', 'torotube'),
        'section' => 'metabox_section',
        'priority' => 1,
        'type' => 'text',
    ));
    #metabox duration
    $wp_customize->add_setting('torotube_meta_video_trailer', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('torotube_meta_video_trailer', array(
        'label' => __('Metabox Video Trailer', 'torotube'),
        'section' => 'metabox_section',
        'priority' => 1,
        'type' => 'text',
    ));

    #Metabox section
    $wp_customize->add_section('language_section', array(
        'title'      => __('Language', 'torotube'),
        'panel'      => 'torotube_options',
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('separator_setting_general_terms');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting_general_terms',
        array(
            'settings' => 'separator_setting_general_terms',
            'section' => 'language_section',
            'label'   => __('General Terms', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('lang_views', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_views', array(
        'label'    => __('views', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_watch_video', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_watch_video', array(
        'label'    => __('watch video', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_watch_later', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_watch_later', array(
        'label'    => __('watch later', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_comments', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_comments', array(
        'label'    => __('Comments', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_favorites', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_favorites', array(
        'label'    => __('Favorites', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_watch_later', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_watch_later', array(
        'label'    => __('Watch Later', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_download', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_download', array(
        'label'    => __('Download', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_share', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_share', array(
        'label'    => __('Share', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_load_more', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_load_more', array(
        'label'    => __('Load more', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));


    $wp_customize->add_setting('lang_view_more', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_view_more', array(
        'label'    => __('View more', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_videos_found', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_videos_found', array(
        'label'    => __('Videos ', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_videos', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_videos', array(
        'label'    => __('videos', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_movies', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_movies', array(
        'label'    => __('Movies', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_all', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_all', array(
        'label'    => __('All', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('separator_report_form');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_report_form',
        array(
            'settings' => 'separator_report_form',
            'section' => 'language_section',
            'label'   => __('Report Form', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('lang_report', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_report', array(
        'label'    => __('Report', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_give_us', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_give_us', array(
        'label'    => __('Give us more details', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_send_report', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_send_report', array(
        'label'    => __('Send Report', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_report_sent_successfully', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_report_sent_successfully', array(
        'label'    => __('Report sent successfully', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_somethings_wrong', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_somethings_wrong', array(
        'label'    => __('Somethings wrong', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));


    $wp_customize->add_setting('separator_setting_lang_player');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting_lang_player',
        array(
            'settings' => 'separator_setting_lang_player',
            'section' => 'language_section',
            'label'   => __('Player', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('lang_option', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_option', array(
        'label'    => __('Option', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_custom_option1', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_custom_option1', array(
        'label'    => __('Option 1', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_custom_option2', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_custom_option2', array(
        'label'    => __('Option 2', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_custom_option3', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_custom_option3', array(
        'label'    => __('Option 3', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_custom_option4', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_custom_option4', array(
        'label'    => __('Option 4', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_custom_option5', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_custom_option5', array(
        'label'    => __('Option 5', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('separator_setting_lang_comments');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting_lang_comments',
        array(
            'settings' => 'separator_setting_lang_comments',
            'section' => 'language_section',
            'label'   => __('Comments', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('lang_comments', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_comments', array(
        'label'    => __('Comments', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_name', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_name', array(
        'label'    => __('Name', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_email', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_email', array(
        'label'    => __('Email', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_your_comment', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_your_comment', array(
        'label'    => __('Your comment', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_send_comment', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_send_comment', array(
        'label'    => __('Send comment', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_no_comments', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_no_comments', array(
        'label'    => __('No comments yet', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));


    $wp_customize->add_setting('separator_lang_login');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_lang_login',
        array(
            'settings' => 'separator_lang_login',
            'section' => 'language_section',
            'label'   => __('Login and Register', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('lang_login', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_login', array(
        'label'    => __('Login', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_sign_in', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_sign_in', array(
        'label'    => __('Sign in', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_profile', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_profile', array(
        'label'    => __('Profile', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_dark_mode', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_dark_mode', array(
        'label'    => __('Dark mode', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_sign_out', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_sign_out', array(
        'label'    => __('Sign out', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_welcome_back', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_welcome_back', array(
        'label'    => __('No comments yet', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_user_email', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_user_email', array(
        'label'    => __('User or email', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_password', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_password', array(
        'label'    => __('Password', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_remember_me', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_remember_me', array(
        'label'    => __('Remember me', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_enter_new_pass', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_enter_new_pass', array(
        'label'    => __('Enter your new password', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_changes_saved_successfully', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_changes_saved_successfully', array(
        'label'    => __('changes saved successfully', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_forgot_password', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_forgot_password', array(
        'label'    => __('Forgot password', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_email', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_email', array(
        'label'    => __('Email', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_my_account', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_my_account', array(
        'label'    => __('My Account', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_save_changes', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_save_changes', array(
        'label'    => __('Save changes', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_not_registered', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_not_registered', array(
        'label'    => __('Not registered yet?', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_create_account', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_create_account', array(
        'label'    => __('Create an Account', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_create_acc', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_create_acc', array(
        'label'    => __('Create account', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_create_your_account', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_create_your_account', array(
        'label'    => __('Create your account', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
    $wp_customize->add_setting('lang_please_fill_outs', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_please_fill_outs', array(
        'label'    => __('Please fill out the following fields to signup', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_user', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_user', array(
        'label'    => __('User', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));

    $wp_customize->add_setting('lang_already_have', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_already_have', array(
        'label'    => __('Already have an account?', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));


    $wp_customize->add_setting('lang_go_back', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_go_back', array(
        'label'    => __('Go Back', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));


    $wp_customize->add_setting('separator_setting_lang_ads');
    $wp_customize->add_control(new Separator_Custom_control(
        $wp_customize,
        'separator_setting_lang_ads',
        array(
            'settings' => 'separator_setting_lang_ads',
            'section' => 'language_section',
            'label'   => __('ADS', 'torotube'),
            'priority'   => 1,
        )
    ));

    $wp_customize->add_setting('lang_close_play', array(
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('lang_close_play', array(
        'label'    => __('Close and play', 'torotube'),
        'section'  => 'language_section',
        'priority' => 1,
        'type'     => 'text',
    ));
}
add_action('customize_register', 'my_customize_register');
