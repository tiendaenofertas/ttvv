<?php 
class TOROTUBE_Post {

    public function get_image_featured($id, $size){
        $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size ); 
        return $image_attributes[0];
    }

    public function trailer($id){

        $enable_trailer = get_option('enable_video_trailer');
        if($enable_trailer){
            $trailer_field = get_option('torotube_meta_video_trailer', true);
            $trailer       = get_post_meta($id, $trailer_field, true);
        } else{ $trailer = false; }

  
		return $trailer;
	}
   
    public function get_thumb_up($id){
        $thumb_up   = get_post_meta( $id, 'like', true );
        if(!$thumb_up) $thumb_up = 0;
        return $thumb_up;
    }

    public function get_thumb_down($id){
        $thumb_down   = get_post_meta( $id, 'unlike', true );
        if(!$thumb_down) $thumb_down = 0;
        return $thumb_down;
    }

    public function get_thumb($id){
        $thumb_up   = (int) get_post_meta( $id, 'like', true );
        if(!$thumb_up) $thumb_up = 0;

        $thumb_down = (int) get_post_meta( $id, 'unlike', true );
        if(!$thumb_up) $thumb_down = 0;

        $total = $thumb_up + $thumb_down;

        if($total == 0) {
            $perc = '0%';
        } else {
            $perc = ( $thumb_up * 100 ) / ($total);
            $perc = round($perc, 0) . '%';
        }

        return $perc;

    }

    public function get_views($id){
        $views = get_post_meta( $id, 'views', true );
        if(!$views) $views = 0;
        return $views;
    }

    public function get_duration($id){
        $second_time = false;
        $input_duration = get_option('torotube_meta_duration', true);
        if(!$input_duration) $input_duration = 'duration';

        $duration = get_post_meta( $id, $input_duration, true );
        if($duration) $second_time = secondtotime($duration);
        return $second_time;
    }


    /* single */
    public function get_quality($id){
        $quality_list = false;
        $quality      = get_the_terms( $id, 'quality_tt' );
        if ( $quality && ! is_wp_error( $quality ) ){
            foreach ($quality as $key => $por) {
                $name = $por->name;
                $quality_array[] = '<span class="co01-b snow-c fwb f12 px08 dib vam">'.$name.'</span>';
            }
            $quality_list = implode(' ', $quality_array);
        }
        return $quality_list;
    }

    public function get_quality_wdgt($id){
        $quality_list = false;
        $quality      = get_the_terms( $id, 'quality_tt' );
        if ( $quality && ! is_wp_error( $quality ) ){
            foreach ($quality as $key => $por) {
                $name = $por->name;
                $quality_array[] = '<span class="qlty ttu fwb poa lt0 tp0 m08 f12 co01-b snow-c px08 mg08">'.$name.'</span>';
            }
            $quality_list = implode(' ', $quality_array);
        }
        return $quality_list;
    }

    public function get_tags($id){
        $cats    = get_the_terms( $id, 'post_tag' );
        $catList = false;
        if( !empty($cats) ) {
            $catArray = array();
            foreach ($cats as $key => $cat) {
                $name = $cat->name;
                $link = get_term_link( $cat );
                $catArray[] = '<a href="'.$link.'">'.$name.'</a>';
            }
            $catList = implode(' ', $catArray);
        }
        return $catList;
    }

    public function get_categories($id){
        $cats    = get_the_terms( $id, 'category' );
        $catList = false;
        if( !empty($cats) ) {
            $catArray = array();
            foreach ($cats as $key => $cat) {
                $name = $cat->name;
                $link = get_term_link( $cat );
                $catArray[] = '<a href="'.$link.'">'.$name.'</a>';
            }
            $catList = implode(' ', $catArray);
        }
        return $catList;
    }

    public function get_categories_one($id){
        $cats    = get_the_terms( $id, 'category' );
        $catList = false;
        if( !empty($cats) ) {
            foreach ($cats as $key => $cat) {
                if($key == 0){
                    $name = $cat->name;
                    $link = get_term_link( $cat );
                    $catList = '<a href="'.$link.'">'.$name.'</a>';
                }
            }
        }
        return $catList;
    }

    public function get_pornstar($id) {
        $pornstar_list = false;
        $pornstar      = get_the_terms( $id, 'toro_pornstar' );
        if ( $pornstar && ! is_wp_error( $pornstar ) ){
            foreach ($pornstar as $key => $por) {
                $name = $por->name;
                $url  = get_term_link($por);
                $pornstar_array[] = '<a class="tag-prst" href="'.$url.'">'.$name.'</a>';
            }
            $pornstar_list = implode(' ', $pornstar_array);
        }
        return $pornstar_list;
    }

    public function get_channel($id) {
        $channel_list = false;
        $channel      = get_the_terms( $id, 'channel_tt' );
        if( $channel && ! is_wp_error( $channel ) ) {
            foreach ($channel as $key => $por) {
                $name = $por->name;
                $url  = get_term_link($por);
                $channel_array[] = '<a class="tag-chnl" href="'.$url.'">'.$name.'</a>';
            }
            $channel_list = implode(' ', $channel_array);
        }
        return $channel_list;
    }

    public function get_player($id) {
        $player = false;
        $player_array = [];
        $field_video = get_option('torotube_meta_video');
        if(!$field_video) $field_video = 'videos';
        
        $player = get_post_meta( $id, $field_video, true );
        if($player) $player_array[] = $player;
        
        $player1 = get_post_meta( $id, 'video_optional_1', true );
        if($player1) $player_array[] = $player1;

        $player2 = get_post_meta( $id, 'video_optional_2', true );
        if($player2) $player_array[] = $player2;

        $player3 = get_post_meta( $id, 'video_optional_3', true );
        if($player3) $player_array[] = $player3;

        $player4 = get_post_meta( $id, 'video_optional_4', true );
        if($player4) $player_array[] = $player4;

        
        return $player_array;
    }



}