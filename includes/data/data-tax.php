<?php 
class TOROTUBE_Tax {

    /* $size: mini poster thumbnail */
    public function get_image_url($id, $size){
        $image_id = get_term_meta( $id, 'category-image', true );
        if($image_id) {
            $image_atts = wp_get_attachment_image_src($image_id, $size);
			$image = $image_atts[0];
        } else {
            $image = TOROTUBE_DIR_URI . 'public/img/'.$size.'-default.svg';
        }
        return $image;
    }


    /* votes thumb */
    public function thumb_up($id){
        $thumb_up = get_term_meta( $id, 'thumb_up', true );
        if(!$thumb_up) $thumb_up = 0;
        return $thumb_up;
    }

    public function thumb_down($id){
        $thumb_down = get_term_meta( $id, 'thumb_down', true );
        if(!$thumb_down) $thumb_down = 0;
        return $thumb_down;
    }

    public function thumb($id){
        $thumb_up   = (int) get_term_meta( $id, 'thumb_up', true );
        if(!$thumb_up) $thumb_up = 0;
        $thumb_down = (int) get_term_meta( $id, 'thumb_down', true );
        if(!$thumb_up) $thumb_down = 0;
        $total = $thumb_up + $thumb_down;
        if($total == 0) {
            $perc = '0%';
        } else {
            $perc = ( $thumb_up * 100 ) / ($total);
            $perc = $perc . '%';
        }
        return $perc;
    }
}