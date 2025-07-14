<?php
global $wpdb;

$_details = wp_get_theme('torotube');

#Version
define('TOROTUBE_VERSION',  $_details['Version']);

$torotube_path = (substr(get_template_directory(),     -1) === '/') ? get_template_directory()     : get_template_directory()     . '/';
$torotube_uri  = (substr(get_template_directory_uri(), -1) === '/') ? get_template_directory_uri() : get_template_directory_uri() . '/';

define('TOROTUBE_DIR_PATH', $torotube_path);
define('TOROTUBE_DIR_URI',  $torotube_uri);

#Clase General
function torotube_init()
{
    load_theme_textdomain('torotube', TOROTUBE_DIR_PATH . 'languages');
}
add_action('init', 'torotube_init');

require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-master.php';

function run_torotube_master()
{
    $torotube_master = new TOROTUBE_Master;
    $torotube_master->run();
}

run_torotube_master();


function activate_torotube()
{
    require_once TOROTUBE_DIR_PATH . 'includes/class-torotube-activator.php';
    TOROTUBE_Activator::activate();
}
add_action('after_switch_theme', 'activate_torotube');


/* Number Post on Home Page Latest */
function wpdocs_posts_on_homepage($query)
{
    $home_blocks = get_theme_mod('torotube_panel_homet');

    if ($home_blocks) {
        $blocks = (array) json_decode($home_blocks);
        foreach ($blocks as $block) {
            if ($block->hidden == 'Latest post') {
                $number_section     = ($block->latest_number) ? $block->latest_number : 10;
            }
        }
        if ($query->is_home() && $query->is_main_query()) {
            $query->set('posts_per_page', $number_section);
        }
    }
}
add_action('pre_get_posts', 'wpdocs_posts_on_homepage');

/* Pagination */
function torotube_pagination()
{
    if (is_singular('post'))
        return;
    global $wp_query;
    if ($wp_query->max_num_pages <= 1)
        return;
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);
    if ($paged >= 1)
        $links[] = $paged;
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<div class="nav-links">' . "\n";
    if (get_previous_posts_link())
        printf('%s' . "\n", get_previous_posts_link('<i class="fa-chevron-left"></i> <span>' . __('Previews Page', 'torotube') . '</span>'));
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="page-item active"' : '';
        printf('<a class="page-numbers" href="' . get_pagenum_link(1) . '">1</a>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');
        if (!in_array(2, $links))
            echo '<a>...</a>';
    }
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="page-numbers current"' : '';
        printf('<a%s class="page-numbers" href="' . get_pagenum_link($link) . '">' . $link . '</a>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<a href="javascript:void(0)" class="extend">...</a>' . "\n";
        $class = $paged == $max ? ' class="page-item active"' : '';
        printf('<a class="page-numbers" href="' . get_pagenum_link($max) . '">' . $max . '</a>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }
    if (get_next_posts_link())
        printf('%s' . "\n", get_next_posts_link('<span>' . __('Next Page', 'torotube') . '</span> <i class="fa-chevron-right"></i>'));
    echo '</div>' . "\n";
}

/* Modify class for post_link_pagination */
add_filter('next_posts_link_attributes', 'next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'prev_posts_link_attributes');

function next_posts_link_attributes()
{
    return 'class="next page-numbers"';
}
function prev_posts_link_attributes()
{
    return 'class="prev page-numbers"';
}


add_filter('gettext', 'theme_change_label_names');
function theme_change_label_names($translated_text)
{
    if (is_admin()) {
        switch ($translated_text) {
            case 'Logo':
                $translated_text = __('Logo White', 'torotube');
                break;
        }
    }
    return $translated_text;
}


/* comments */
function comment_form_hidden_fields()
{
    comment_id_fields();
    if (current_user_can('unfiltered_html')) {
        wp_nonce_field('unfiltered-html-comment_' . get_the_ID(), '_wp_unfiltered_html_comment', false);
    }
}


function review_comment($comment, $args, $depth)
{
    global $wpdb;
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
?>
    <li class="dfx mt32">
        <figure class="w32 mr16"><?php echo get_avatar($comment, 32); ?></figure>
        <aside class="fg1">
            <span class="dbk fwb f14 op05"><?php echo $comment->comment_author; ?></span>
            <p><?php echo $comment->comment_content; ?></p>
        </aside>
    </li>
<?php
}



/* iMAGE ON CATEGORIES */
/**
 * ADD TERM META
 * SAVE TERM META
 * TERM META IMAGE
 */
function my_category_addform_termmeta()
{
    wp_nonce_field('my_category_termmeta', 'my_category_termmeta_nonce'); ?>
    <div class="form-field category-image-wrap">
        <label for="category-image"><?php _e('Featured Image', 'eroz'); ?></label>
        <div class="custom_media_item">
            <figure style="margin-top:0;margin-left:0"><img loading="lazy" src="" style="max-width:150px;display:none;" /></figure>
            <a href="#" class="button button-primary custom_media_item_upload"><?php _e('Upload image', 'eroz'); ?></a>
            <input type="hidden" id="category-image" name="category-image" value="" />
            <a href="#" class="button button-primary custom_media_item_delete" style="display:none;"><?php _e('Delete', 'eroz'); ?></a>
        </div>
    </div>
<?php }
add_action('category_add_form_fields', 'my_category_addform_termmeta');
add_action('post_tag_add_form_fields', 'my_category_addform_termmeta');
add_action('toro_pornstar_add_form_fields', 'my_category_addform_termmeta');
add_action('channel_tt_add_form_fields', 'my_category_addform_termmeta');
//Función para añadir campos personalizados al formulario de Editar taxonomía
function my_category_editform_termmeta($term)
{
    $category_image = get_term_meta($term->term_id, 'category-image', true);
    wp_nonce_field('my_category_termmeta', 'my_category_termmeta_nonce'); ?>
    <tr class="form-field category-image-wrap">
        <th scope="row"><label for="category-image"><?php _e('Featured Image', 'eroz'); ?></label></th>
        <td>
            <div class="custom_media_item">
                <?php
                $display = "";
                if (empty($category_image) || $category_image == "") {
                    $display = 'display:none';
                }
                $media_item_src = wp_get_attachment_url($category_image); ?>
                <figure style="margin-top:0;margin-left:0"><img loading="lazy" src="<?php echo $media_item_src; ?>" style="max-width:150px;<?php echo $display; ?>" /></figure>
                <a href="#" class="button button-primary custom_media_item_upload"><?php _e('Upload image', 'eroz'); ?></a>
                <input type="hidden" id="category-image" name="category-image" value="<?php echo $category_image; ?>" />
                <a href="#" class="button button-primary custom_media_item_delete" style="<?php echo $display; ?>"><?php _e('Delete', 'eroz'); ?></a>
            </div>
        </td>
    </tr>
<?php }
add_action('category_edit_form_fields', 'my_category_editform_termmeta');
add_action('post_tag_edit_form_fields', 'my_category_editform_termmeta');
add_action('toro_pornstar_edit_form_fields', 'my_category_editform_termmeta');
add_action('channel_tt_edit_form_fields', 'my_category_editform_termmeta');
function my_category_fields_save_data($term_id)
{
    // Comprobamos si se ha definido el nonce.
    if (!isset($_POST['my_category_termmeta_nonce'])) {
        return $term_id;
    }
    $nonce = $_POST['my_category_termmeta_nonce'];
    // Verificamos que el nonce es válido.
    if (!wp_verify_nonce($nonce, 'my_category_termmeta')) {
        return $term_id;
    }
    // Si existen entradas antiguas las recuperamos
    $old_category_image = get_term_meta($term_id, 'category-image', true);
    // Saneamos lo introducido por el usuario.
    $category_image = sanitize_text_field($_POST['category-image']);
    // Actualizamos el campo meta en la base de datos.
    update_term_meta($term_id, 'category-image', $category_image, $old_category_image);
}
add_action('edit_category', 'my_category_fields_save_data');
add_action('create_category', 'my_category_fields_save_data');
add_action('edit_post_tag', 'my_category_fields_save_data');
add_action('create_post_tag', 'my_category_fields_save_data');
add_action('edit_toro_pornstar', 'my_category_fields_save_data');
add_action('create_toro_pornstar', 'my_category_fields_save_data');
add_action('edit_channel_tt', 'my_category_fields_save_data');
add_action('create_channel_tt', 'my_category_fields_save_data');



/* PORNSTAR ASSIGN LETTER FIRST */
add_action('create_toro_pornstar', 'assign_letter_pornstar', 10, 2);
add_action('edited_toro_pornstar', 'assign_letter_pornstar');
function assign_letter_pornstar($term_id)
{
    $pornstar = get_term_by('id', $term_id, 'toro_pornstar');
    $name_pornstar = $pornstar->name;
    $letter = strtolower(mb_substr($name_pornstar, 0, 1, "UTF-8"));
    update_term_meta($term_id, 'letter_tax', $letter);
}

/* CHANNEL ASSIGN LETTER FIRST */
add_action('create_channel_tt', 'assign_letter_channel', 10, 2);
add_action('edited_channel_tt', 'assign_letter_channel');
function assign_letter_channel($term_id)
{
    $channel = get_term_by('id', $term_id, 'channel_tt');
    $name_channel = $channel->name;
    $letter = strtolower(mb_substr($name_channel, 0, 1, "UTF-8"));
    update_term_meta($term_id, 'letter_tax', $letter);
}

/* PORNSTAR ASSIGN LETTER FIRST */
add_action('create_category_tt', 'assign_letter_category', 10, 2);
add_action('edited_category_tt', 'assign_letter_category');
function assign_letter_category($term_id)
{
    $cat = get_term_by('id', $term_id, 'category');
    $name_cat = $cat->name;
    $letter = strtolower(mb_substr($name_cat, 0, 1, "UTF-8"));
    update_term_meta($term_id, 'letter_tax', $letter);
}


/* PAGINATION ON CATEGORIES */
function pagination_categories()
{
    $number = get_option('category_archive_number');
    
    if (!$number)
        $number = 5;
    $episodes = get_terms('category', array(
        'hide_empty'    => true,
        'number'        => 30000,
    ));
    $categories = count($episodes);
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base'      => @add_query_arg('paged', '%#%'),
        'format'    => '',
        'total'     => ceil($categories / $number),
        'current'   => $current,
        'prev_text' => '<p style="margin: 0;" class="prev-pagin"><i class="fa-chevron-left"></i>' . __("Previous", "torotube") . '</p>',
        'next_text' => '<p style="margin: 0;" class="next-pagin">' . __("Next", "torotube") . ' <i class="fa-chevron-right"></i></p>',
        'type'      => 'plain'
    );
    if ($wp_rewrite->using_permalinks())
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
    if (!empty($wp_query->query_vars['s']))
        $pagination['add_args'] = array('s' => get_query_var('s'));
    echo paginate_links($pagination);
};


/* PAGINATION ON CHANNEL */
function pagination_channel($letter)
{
    $number = get_option('channel_archive_number');
    if (!$number)
        $number = 5;

    if ($letter) {
        $episodes = get_terms('channel_tt', array(
            'hide_empty'    => true,
            'number'        => 30000,
            'meta_query' => [[
                'key'   => 'letter_tax',
                'value' => $letter,
            ]],
        ));
    } else {
        $episodes = get_terms('channel_tt', array(
            'hide_empty'    => true,
            'number'        => 30000,
        ));
    }


    $categories = count($episodes);
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base'      =>  preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
        'format'    => 'page/%#%',
        'total'     => ceil($categories / $number),
        'current'   => $current,
        'prev_text' => '<p style="margin: 0;" class="prev-pagin"><i class="fa-chevron-left"></i>' . __("Previous", "torotube") . '</p>',
        'next_text' => '<p style="margin: 0;" class="next-pagin">' . __("Next", "torotube") . ' <i class="fa-chevron-right"></i></p>',
        'type'      => 'plain',

    );

    if ($letter) {
        $pagination['add_args'] = array(
            'letter' => (!empty($_GET['letter'])) ? $_GET['letter'] : ''
        );
    }

    echo paginate_links($pagination);
};


/* PAGINATION ON PORNSTAR */
function pagination_pornstar($letter)
{
    $number = get_option('pornstar_archive_number');
    if (!$number)
        $number = 5;

    if ($letter) {
        $episodes = get_terms('toro_pornstar', array(
            'hide_empty'    => 1,
            'number'        => 30000,
            'meta_query' => [[
                'key'   => 'letter_tax',
                'value' => $letter,
            ]],
        ));
    } else {
        $episodes = get_terms('toro_pornstar', array(
            'hide_empty'    => 1,
            'number'        => 30000,
        ));
    }

    $categories = count($episodes);
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base'      =>  preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
        'format'    => 'page/%#%',
        'total'     => ceil($categories / $number),
        'current'   => $current,
        'prev_text' => '<p style="margin: 0;" class="prev-pagin"><i class="fa-chevron-left"></i>' . __("Previous", "torotube") . '</p>',
        'next_text' => '<p style="margin: 0;" class="next-pagin">' . __("Next", "torotube") . ' <i class="fa-chevron-right"></i></p>',
        'type'      => 'plain',

    );

    if ($letter) {
        $pagination['add_args'] = array(
            'letter' => (!empty($_GET['letter'])) ? $_GET['letter'] : ''
        );
    }

    echo paginate_links($pagination);
};



function secondtotime($seconds)
{
    if (is_numeric($seconds)) {
        if ($seconds >= 3600) {
            $timeFormat = gmdate("H:i:s", $seconds);
        } else {
            $timeFormat = gmdate("i:s", $seconds);
        }
        return $timeFormat;
    } else {
        return $seconds;
    }
}


function lang_torotube($text, $id_text)
{
    $text_database = get_option($id_text);
    if ($text_database) {
        $text = $text_database;
    } else {
        $text = __($text, 'torotube');
    }
    return $text;
}

/* images custom */
add_image_size('wdgt', 140, 80, true);
add_image_size('mini', 80, 80, true);
add_image_size('poster', 285, 420, true);


function wd_admin_menu_rename()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Video';
    $submenu['edit.php'][5][0] = 'All Videos';
}
add_action('admin_menu', 'wd_admin_menu_rename');



/* TITLE SEO TAX */

function tutorialshares_taxonomy_add_new_meta_field()
{
    // this will add the custom meta field to the add new term page
?>
    <div class="form-field">
        <label for="term_meta[custom_term_meta]"><?php _e('Top Title SEO', 'torotube'); ?></label>
        <input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
    </div>
<?php
}
add_action('category_add_form_fields', 'tutorialshares_taxonomy_add_new_meta_field', 10, 2);
add_action('toro_pornstar_add_form_fields', 'tutorialshares_taxonomy_add_new_meta_field', 10, 2);
add_action('channel_tt_add_form_fields', 'tutorialshares_taxonomy_add_new_meta_field', 10, 2);

// Edit term page
function tutorialshares_taxonomy_edit_meta_field($term)
{
    // put the term ID into a variable
    $t_id = $term->term_id;
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("taxonomy_$t_id"); ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e('Top Title SEO', 'torotube'); ?></label></th>
        <td>
            <input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr($term_meta['custom_term_meta']) ? esc_attr($term_meta['custom_term_meta']) : ''; ?>">
        </td>
    </tr>
<?php
}
add_action('category_edit_form_fields', 'tutorialshares_taxonomy_edit_meta_field', 10, 2);
add_action('toro_pornstar_edit_form_fields', 'tutorialshares_taxonomy_edit_meta_field', 10, 2);
add_action('channel_tt_edit_form_fields', 'tutorialshares_taxonomy_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta($term_id)
{
    if (isset($_POST['term_meta'])) {
        $t_id = $term_id;
        $term_meta = get_option("taxonomy_$t_id");
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option("taxonomy_$t_id", $term_meta);
    }
}
add_action('edited_category', 'save_taxonomy_custom_meta', 10, 2);
add_action('create_category', 'save_taxonomy_custom_meta', 10, 2);
add_action('edited_toro_pornstar', 'save_taxonomy_custom_meta', 10, 2);
add_action('create_toro_pornstar', 'save_taxonomy_custom_meta', 10, 2);
add_action('edited_channel_tt', 'save_taxonomy_custom_meta', 10, 2);
add_action('create_channel_tt', 'save_taxonomy_custom_meta', 10, 2);


/* remove page of search */
function remove_pages_from_search()
{
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'remove_pages_from_search');

/* movies */
add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_category() or is_tax()) {
            $query->set('post_type', array('movies_tt', 'post'));
        }
        if ($query->is_search()) {
            $query->set('post_type', array('movies_tt', 'post'));
        }
    }
});



load_theme_textdomain('torotube', get_template_directory() . '/languages');

function _body_class($wp_classes, $extra_classes)
{
  $class_delete = array('tag', 'archive', 'category', 'tax-episodes', 'tax-seasons', 'search', 'search-results');

  foreach ($wp_classes as $class_css_key => $class_css) {
    if (in_array($class_css, $class_delete)) {
      unset($wp_classes[$class_css_key]);
    }
  }

  return array_merge($wp_classes, (array) $extra_classes);
}
add_filter('body_class', '_body_class', 10, 2);
