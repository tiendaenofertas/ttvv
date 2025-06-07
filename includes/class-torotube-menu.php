<?php 
class TOROTUBE_Menus {

    public function create_menu() {
        register_nav_menus
        (
            array(
                'header' => 'Header',
                'footer' => 'Footer',
            )
        );
    }
}			  