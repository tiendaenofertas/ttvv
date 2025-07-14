<?php
class TOROTUBE_Activator{
	public static function activate(){

        if(!get_option('torotube_meta_video'))
		    update_option( 'torotube_meta_video', 'embed' );
        
        if(!get_option('torotube_meta_duration'))
            update_option( 'torotube_meta_duration', 'duration' );
		
        if(!get_option('torotube_meta_video_trailer'))
            update_option( 'torotube_meta_video_trailer', 'trailer_url' );
		
        update_option('thumbnail_size_w', 285);
		update_option('thumbnail_size_h', 160);
	}
}