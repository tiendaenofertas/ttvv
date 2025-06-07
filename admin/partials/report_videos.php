<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Post Reported', 'torotube'); ?></h1>
    <p><?php _e('These are all reports, please consider solving them.', 'torotube'); ?></p>
    <div>
        <div>
            <?php global $wpdb;
            $res = $wpdb->get_results( 
                    "
                    SELECT *
                    FROM $wpdb->postmeta
                    WHERE meta_key = '_repor'
                    "
                );
            $post = array();
            foreach ( $res as $re ) 
            {
                $post[] =  $re->post_id;
            }
            ?>
            <table class="widefat striped">
                <thead>
                    <tr>
                        <th class="frst">#</th>
                        <th><?php _e('Post', 'torotube'); ?></th>
                        <th><?php _e('Reason', 'torotube'); ?></th>
                        <th><?php _e('Description', 'torotube'); ?></th>
                        <th><?php _e('Action', 'torotube'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($post){ ?>
                    <?php 
                        $args = array(
                            'posts_per_page' => -1,
                            'post__in' => $post,
                            'post_type' => 'post'   
                        ); 
                        $the_query = new WP_Query( $args );
                        if ( $the_query->have_posts() ) :
                            $con = 1;
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                            $r = get_post_meta( get_the_ID(), '_repor', true );
                    ?>
                     <tr>
                        <td class="frst"><?php echo $con; ?></td>
                        <td><a class="row-title" target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                        <td><?php echo $r['reas']; ?></td>
                        <td><?php echo $r['desc']; ?></td>
                        <td><a data-id="<?php the_ID(); ?>" class="clean-report"><span class="dashicons dashicons-trash"></span> <?php _e('Delete', 'torotube'); ?></a></td>
                    </tr>
                    <?php 
                        $con++; endwhile; endif; wp_reset_query();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="clear"></div>