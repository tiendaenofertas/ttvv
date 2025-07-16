<?php 
class TOROTUBE_Create_Taxonomy {
    public function pornstar(){
        $slugd = get_option( 'slug_pornstar');
        if(!$slugd) $slugd = 'pornstar';
        self::create_taxonomy('toro_pornstar', 'Pornstar', array('post', 'movies_tt'), true, $slugd);
    }

    public function channel(){
        $slugd = get_option( 'slug_channel');
        if(!$slugd) $slugd = 'channel';
        self::create_taxonomy('channel_tt', 'Channel', array('post', 'movies_tt'), true, $slugd);
    }

    public function quality(){
        self::create_taxonomy('quality_tt', 'Quality', array('post', 'movies_tt'), true, 'quality');
    }

    public static function create_taxonomy($term, $name, $cpt, $tipo, $slug){
        $labels = array(
            'name'                       => $name,
            'singular_name'              => $name,
            'menu_name'                  => $name,
            'all_items'                  => 'All',
            'parent_item'                => 'Category parent',
            'parent_item_colon'          => 'Parent Item:',
            'new_item_name'              => 'New Item Name',
            'add_new_item'               => 'Add new ' . $name,
            'edit_item'                  => 'Edit ' . $name,
            'update_item'                => 'Update ' . $name,
            'view_item'                  => 'View ' . $name,
            'separate_items_with_commas' => 'Separate with dots',
            'add_or_remove_items'        => 'add o remove ' . $name,
            'choose_from_most_used'      => 'Choose most used',
            'popular_items'              => $name . ' populars',
            'search_items'               => 'search ' . $name,
            'not_found'                  => 'Not found',
            'no_terms'                   => 'No items',
            'items_list'                 => 'Items list',
            'items_list_navigation'      => 'Items list navigation',
        );
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => $tipo,
            'public'            => true,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'rewrite'           => array('slug' => $slug, 'with_front' => false)
        );
        register_taxonomy( $term, $cpt, $args );
    }
}		  