<?php 
add_action( 'widgets_init', function(){
    register_widget( 'wdgt_recommended' );
});

class wdgt_recommended extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'wdgt_recommended',
            'description' => 'Show list post',
        );
        parent::__construct( 'wdgt_recommended', 'Torotube: List Post', $widget_ops );
    }


    # Display frontend

    public function widget( $argus, $instance ) {
        
        $number = ( ! empty( $instance['number'] ) ) ? (int) ( $instance['number'] ) : 5;

        $video_favorites    = get_option('video_favorites');
        $video_watch_later  = get_option('video_watch_later');
        $user_id            = get_current_user_id();
        $favorite           = get_user_meta( $user_id, 'user_favorite', true ); 
        $watch              = get_user_meta( $user_id, 'user_watch', true );

        /* order */
        $order = isset( $instance['order'] ) ? $instance['order'] : 1;

        echo $argus['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $argus['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $argus['after_title'];
        } ?>

            <div class="dgd a-gtf gp08 mt16 d-mt24">

                <?php $args = array(
                    'post_type'           => 'post',
                    'posts_per_page'      => $number,
                    'post_status'         => 'publish',
                    'no_found_rows'       => true,
                    'ignore_sticky_posts' => true,
                ); 

                if($order == 2){
                    $args['meta_key'] = 'views';
                    $args['orderby']  = 'meta_value_num';
                    $args['order']    = 'DESC';
                }
                if($order == 3){
                    $args['orderby']  = 'rand';
                }
                if($order == 4){
                    $category       = ( ! empty( $instance['categories'] ) ) ?  $instance['categories']  : 1;
                    $category_array = explode(',', $category);
                    $args['order']        = 'DESC';
                    $args['orderby']      = 'date';
                    $args['category__in'] = $category_array;
                }

                $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        get_template_part('public/partials/templates/loop', 'sidebar' , array(
                            'video_favorites'   => $video_favorites,
                            'favorite'          => $favorite,
                            'video_watch_later' => $video_watch_later,
                            'watch'             => $watch,
                        ));
                   endwhile;
                endif; wp_reset_query();  ?>

               
            </div>
        
        <?php echo $argus['after_widget'];
    }


    #Parameters Form of Widget
    public function form( $instance ) {
        $title      = ! empty( $instance['title'] ) ? $instance['title']         : false;
        $number     = isset( $instance['number'] ) ? (int)( $instance['number'] ): 5;
        $order      = isset( $instance['order'] ) ? (int) $instance['order']     : false; 
        $categories = isset($instance['categories']) ? $instance['categories']   :false;
        ?>

        <div class="wdgt-tt">
            <div>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'torotube' ); ?></label>
                <div class="fr-input">
                    <span class="dashicons dashicons-edit-large"></span>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
                </div>
            </div>

            <div>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number', 'torotube'); ?></label>
                <div class="fr-input">
                    <span class="dashicons dashicons-shortcode"></span>
                    <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
                </div>
            </div>

            <div>
                <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'torotube'); ?></label>
                <div class="fr-input">
                    <span class="dashicons dashicons-sort"></span>
                    <select id="<?php echo $this->get_field_id('order'); ?>" class="sel-filter" name="<?php echo $this->get_field_name('order'); ?>">
                        <option<?php selected($order, 1 ); ?> value="1"><?php _e('Latest', 'torotube'); ?></option>
                        <option<?php selected($order, 2 ); ?> value="2"><?php _e('Views', 'torotube'); ?></option>
                        <option<?php selected($order, 3 ); ?> value="3"><?php _e('Random', 'torotube'); ?></option>
                        <option<?php selected($order, 4 ); ?> value="4"><?php _e('Category', 'torotube'); ?></option>
                    </select>
                </div>         
            </div>

            <div class="select-cats">
                <label class="show-hide-cat" for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Category', 'torotube'); ?> <span class="dashicons dashicons-sort"></span></label>
                <div class="fr-input-cat hide">
                    <ul class="s-cat">
                        <?php 
                        $ar = '';
                        $ar = explode(',', $categories);
                        foreach ($ar as &$value) { $lst[$value] = $value; }
                        $categories = get_categories('hide_empty=1');
                        foreach ($categories as $category) { ?>
                            <li>
                                <label>
                                <input <?php if(isset($lst[$category->term_id])){checked( $lst[$category->term_id], $category->term_id); } ?> type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('categories'); ?>[]" value="<?php echo $category->term_id; ?>"  />
                                <?php echo $category->cat_name ?></label><br />
                            </li>
                        <?php } ?>
                    </ul>
                </div>          
            </div>



        </div>

        <?php
    }


    #Save Data
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        foreach( $new_instance as $key => $value )
        {
            $updated_instance[$key] = sanitize_text_field($value);
        }
        if(isset($new_instance['categories'])){
            $updated_instance['categories'] = strip_tags(implode(',', $new_instance['categories']));
        }

        return $updated_instance;
    }
}