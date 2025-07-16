<?php 
class TOROTUBE_Ajax_Public {

    public function edit_profile() {
        if( isset( $_POST[ 'action' ] ) ) {
            
            $pass   = $_POST['pass'];
            $name   = $_POST['named'];
            $userid = $_POST['userid'];

            if( $pass && $pass != '' ){
                wp_update_user( array( 'ID' => $userid, 'user_pass' => $pass ) );
            }

            if( $name && $name != '' ){
                wp_update_user( array( 'ID' => $userid, 'display_name' => $name ) );
            }
    
            $res = [
              'res' => 'conexion',
              'name' => $name,
            ];
            echo json_encode($res);
            wp_die();
        }
    }

    public function reportform() {
        if( isset( $_POST[ 'action' ] ) ) {
            
            $desc = $_POST['desc'];
            if(!$desc) $desc = '';

            $reas = $_POST['reas'];
            if(!$reas) $reas = '';
            $ide  = $_POST['ide'];

            $reason = array('desc' => $desc, 'reas' => $reas);

            add_post_meta( $ide, '_repor', $reason);
            
    
            $res = [
              'res' => 'conexion'
            ];
            echo json_encode($res);
            wp_die();
        }
    }

    public function search_suggest() {
        if( isset( $_POST[ 'action' ] ) ) {
            $number = get_option('number_items_search_ajax');
            if(!$number) $number = 5;
            $list = array();
            $args = array(
                'post_type'      => array('post'),
                'post_status'    => 'publish',
                'order'          => 'DESC',
                'orderby'        => 'date',
                's'              => $_POST['term'],
                'posts_per_page' => $number
            );
            $query_movie = new WP_Query($args);
            if ($query_movie->post_count > 0) {
                if ($query_movie->have_posts()) :
                    while ($query_movie->have_posts()) {
                        $query_movie->the_post();
                        $list[] = array('name' => get_the_title(), 'url' => get_the_permalink());                        
                    }
                endif;
                wp_reset_query();
            } 

            $res = [
              'res'  => 'conexion',
              'list' => $list,
            ];
            echo json_encode($res);
            wp_die();
        }
    }

    public function login() {
        if( isset( $_POST[ 'action' ] ) ) {
            #Data
            $name = $_POST['name'];
            $pass = esc_attr($_POST['pass']);
            #Security of Form
            $username = sanitize_text_field($name);
            $password = sanitize_text_field($pass);
            if($remember) $remember = "true";
            else $remember = "false";
            #Verify Login
            $login_data = array();
            $login_data['user_login'] = $username;
            $login_data['user_password'] = $password;
            $login_data['remember'] = $remember;
            $user_verify = wp_signon( $login_data, false );
            if ( is_wp_error($user_verify) ) {
               $error = 'true';
            } else {    
                $error = 'false';
            }
            $res = [
                'error' => $error
            ];
            echo json_encode($res);
            wp_die();
        }
    }

   
    public function register() {
        if( isset( $_POST[ 'action' ] ) ) {
            #Data
            $name = $_POST['name'];
            $pwd1 = esc_attr($_POST['pass']);
            $email = esc_attr($_POST['email']);
            $email = sanitize_email($email);
            $username = sanitize_user($name);
            if( $email == "" || $pwd1 == "" || $username == "") {
                $err = 'true';
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err = 'true';
            } else if(email_exists($email) ) {
                $err = 'true';
            } else {
                $userdata = array(
                    'user_login'    =>   $username,
                    'user_email'    =>   $email,
                    'user_pass'     =>   $pwd1,
                );
                $user = wp_insert_user( $userdata );
                $err = 'false';
            }
            $res = [
                'error' => $err
            ];
            echo json_encode($res);
            wp_die();
        }
    }
   
    public function favorite() {
        if( isset( $_POST[ 'action' ] ) ) {
            $post_id = $_POST['postid'];
            $status  = $_POST['status'];
            $user_id = get_current_user_id();
            $data    = get_user_meta( $user_id, 'user_favorite', true );
            if($status == 'favorite') {
                if (( $key = array_search($post_id, $data) ) !== false) {
                    unset($data[$key]);
                }
                update_user_meta( $user_id, 'user_favorite', $data );
            } elseif ($status == 'nofavorite') {
                if($data) {
                    if(!in_array($post_id, $data)){
                        array_push($data, $post_id);
                        update_user_meta( $user_id, 'user_favorite', $data );
                    }
                } else {
                    $data = array($post_id);
                    update_user_meta( $user_id, 'user_favorite', $data );
                } 
            }
            $res = [
                'res' => $user_id,
                'postid' => $post_id,
                'status' => $status,
            ];
            echo json_encode($res);
            wp_die();
        }
    }

    public function remove_favorite() {
        if( isset( $_POST[ 'action' ] ) ) {
            $post_id   = $_POST['postid'];
            $post_type = $_POST['posttype'];
            $user_id = get_current_user_id();
            $data    = get_user_meta( $user_id, 'user_'.$post_type , true );

            if (($key = array_search($post_id, $data)) !== false) {
                unset($data[$key]);
                $a = 2;
            }

            $newdata = array_values($data);
            update_user_meta( $user_id, 'user_'.$post_type, $newdata );

            $res = [
              'res' => 'conn',
            ];
            echo json_encode($res);
            wp_die();
        }
    }


    public function watch() {
        if( isset( $_POST[ 'action' ] ) ) {
            $post_id = $_POST['postid'];
            $status  = $_POST['status'];
            $user_id = get_current_user_id();
            $data    = get_user_meta( $user_id, 'user_watch', true );
            if($status == 'watch') {
                if (( $key = array_search($post_id, $data) ) !== false) {
                    unset($data[$key]);
                }
                update_user_meta( $user_id, 'user_watch', $data );
            } elseif ($status == 'nowatch') {
                if($data) {
                    if(!in_array($post_id, $data)){
                        array_push($data, $post_id);
                        update_user_meta( $user_id, 'user_watch', $data );
                    }
                } else {
                    $data = array($post_id);
                    update_user_meta( $user_id, 'user_watch', $data );
                } 
            }
            $res = [
                'res' => $user_id,
                'postid' => $post_id,
                'status' => $status,
            ];
            echo json_encode($res);
            wp_die();
        }
    }



    public function vote_up() {
        if( isset( $_POST[ 'action' ] ) ) {
            $id_post = $_POST['postid'];
            $currentvotes = get_post_meta($id_post, 'like', true);
            if(!$currentvotes) $currentvotes = 0;
            $currentvotes = $currentvotes + 1;
            update_post_meta($id_post, 'like', $currentvotes);

            /* vote negative */
            $currentvotesneg = get_post_meta($id_post, 'unlike', true);
            if(!$currentvotesneg) $currentvotesneg = 0;

            /* total */
            $total = $currentvotes - $currentvotesneg;
            update_post_meta($id_post, 'liketotal', $total);

            $res = [
                  'res' => 'conexion',
                  'num' => $currentvotes
            ];
            echo json_encode($res);
            wp_die();
        }
    }

    public function vote_down() {
        
        if( isset( $_POST[ 'action' ] ) ) {

            $id_post = $_POST['postid'];
            $currentvotes = get_post_meta($id_post, 'unlike', true);
            if(!$currentvotes) $currentvotes = 0;
            $currentvotes = $currentvotes + 1;
            update_post_meta($id_post, 'unlike', $currentvotes);

            /* vote negative */
            $currentvotespos = get_post_meta($id_post, 'like', true);
            if(!$currentvotespos) $currentvotespos = 0;

            /* total */
            $total = $currentvotespos - $currentvotes;
            update_post_meta($id_post, 'liketotal', $total);

            $res = [
                  'res' => 'conexion',
                  'num' => $currentvotes
            ];
            echo json_encode($res);
            wp_die();
        }
    }

    public function vote_up_tax() {
        if( isset( $_POST[ 'action' ] ) ) {
            $id_post = $_POST['postid'];
            $currentvotes = get_term_meta($id_post, 'thumb_up', true);
            if(!$currentvotes) $currentvotes = 0;
            $currentvotes = $currentvotes + 1;
            update_term_meta($id_post, 'thumb_up', $currentvotes);

            /* vote negative */
            $currentvotesneg = get_term_meta($id_post, 'thumb_down', true);
            if(!$currentvotesneg) $currentvotesneg = 0;

            /* total */
            $total = $currentvotes - $currentvotesneg;
            update_term_meta($id_post, 'liketotal', $total);

            $res = [
                  'res' => 'conexion',
                  'num' => $currentvotes
            ];
            echo json_encode($res);
            wp_die();
        }
    }

    public function vote_down_tax() {
        
        if( isset( $_POST[ 'action' ] ) ) {

            $id_post = $_POST['postid'];
            $currentvotes = get_term_meta($id_post, 'thumb_down', true);
            if(!$currentvotes) $currentvotes = 0;
            $currentvotes = $currentvotes + 1;
            update_term_meta($id_post, 'thumb_down', $currentvotes);

            /* vote positive */
            $currentvotespos = get_term_meta($id_post, 'thumb_up', true);
            if(!$currentvotespos) $currentvotespos = 0;

            /* total */
            $total = $currentvotespos - $currentvotes;
            update_term_meta($id_post, 'liketotal', $total);

            $res = [
                  'res' => 'conexion',
                  'num' => $currentvotes
            ];
            echo json_encode($res);
            wp_die();
        }
    }

}