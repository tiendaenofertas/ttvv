<?php


class TOROTUBE_Create_CustomPostType {
    public function movies() {
        $slugd = get_option( 'slug_movies');
        if(!$slugd) $slugd = 'movies';
        self::create_CustomPostType($slugd, 'Movies', 'movies_tt');
    }
   
    public static function create_CustomPostType($slug, $name, $cpt){
        $labels = array(
            'name'                  => $name,
            'singular_name'         => $name,
            'menu_name'             => $name,
            'name_admin_bar'        => $name,
            'archives'              => __( 'Item Archives', 'torotube' ),
            'attributes'            => __( 'Item Attributes', 'torotube' ),
            'parent_item_colon'     => __( 'Parent Item:', 'torotube' ),
            'all_items'             => __( 'All Items', 'torotube' ),
            'add_new_item'          => __( 'Add New Item', 'torotube' ),
            'add_new'               => __( 'Add New', 'torotube' ),
            'new_item'              => __( 'New Item', 'torotube' ),
            'edit_item'             => __( 'Edit Item', 'torotube' ),
            'update_item'           => __( 'Update Item', 'torotube' ),
            'view_item'             => __( 'View Item', 'torotube' ),
            'view_items'            => __( 'View Items', 'torotube' ),
            'search_items'          => __( 'Search Item', 'torotube' ),
            'not_found'             => __( 'Not found', 'torotube' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'torotube' ),
            'featured_image'        => __( 'Featured Image', 'torotube' ),
            'set_featured_image'    => __( 'Set featured image', 'torotube' ),
            'remove_featured_image' => __( 'Remove featured image', 'torotube' ),
            'use_featured_image'    => __( 'Use as featured image', 'torotube' ),
            'insert_into_item'      => __( 'Insert into item', 'torotube' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'torotube' ),
            'items_list'            => __( 'Items list', 'torotube' ),
            'items_list_navigation' => __( 'Items list navigation', 'torotube' ),
            'filter_items_list'     => __( 'Filter items list', 'torotube' ),
        );
        $rewrite = array(
            'with_front' => true,
            'slug'       => $slug
        );
        $args = array(
            'label'                 => __( 'Post Type', 'torotube' ),
            'description'           => __( 'Post Type Description', 'torotube' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
            'taxonomies'            => array( 'category', 'post_tag'),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'query_var'             => true,
            'capability_type'       => 'post',
        );
        register_post_type( $cpt, $args );
    }
}				  