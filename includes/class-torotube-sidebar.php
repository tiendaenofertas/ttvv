<?php 
Class TOROTUBE_Sidebar {

    public function create_sidebar() {

        register_sidebar( array(
            'name'          => __( 'Sidebar Lateral', 'torotube' ),
            'id'            => 'sidebar-principal',
            'description'   => __( 'Sidebar principal del theme', 'torotube' ),
            'before_widget' => '<div id="%1$s" class="wdgt mt24 c-mt32 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="ttl f20 text-c py04">',
            'after_title'   => '</div>',
        ) );

    }

}		  