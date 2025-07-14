<?php 
class TOROTUBE_Ajax_Admin {

    public function torotube_clean_report() {
        if( isset( $_POST[ 'action' ] ) ) {
            $id = $_POST['id'];
            delete_post_meta( $id, '_repor' );
            $res = [
                'resultado' => 'correct'
            ];
            echo json_encode($res);
            wp_die();
        }
    }
}