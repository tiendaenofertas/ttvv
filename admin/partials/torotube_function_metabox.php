<?php
/**
 * Post Editor WP-admin
 * Metabox Post
 * Change: Add metabox over player
 */
global $post;
wp_nonce_field('act_nonce_name', 'meta-box-nonce');
$input_video    = get_option('torotube_meta_video', true);
$input_duration = get_option('torotube_meta_duration', true);
$input_trailer  = get_option('torotube_meta_video_trailer', true);
?>
<table class="form-table torotube-video-meta">
	<tbody>
		<tr>
			<td class="first"><span class="dashicons dashicons-clock wp-ui-text-highlight"></span><label for="input-duration"><?php _e('Duration', 'torotube'); ?></label></td>
			<td><input name="<?php echo $input_duration; ?>" type="text" value="<?php echo get_post_meta($post->ID, $input_duration, true); ?>"></td>
		</tr>
		<tr>
			<td class="first"><span class="dashicons dashicons-video-alt2 wp-ui-text-highlight"></span><label for="input-metabox"><?php _e('Video', 'torotube'); ?></label></td>
			<td><textarea name="<?php echo $input_video; ?>"><?php echo get_post_meta($post->ID, $input_video, true); ?></textarea></td>
		</tr>
		<tr>
			<td class="first"><span class="dashicons dashicons-video-alt2 wp-ui-text-highlight"></span><label for="input-metabox"><?php _e('Video Optional', 'torotube'); ?></label></td>
			<td><textarea name="video_optional_1"><?php echo get_post_meta($post->ID, 'video_optional_1', true); ?></textarea></td>
		</tr>
		<tr>
			<td class="first"><span class="dashicons dashicons-video-alt2 wp-ui-text-highlight"></span><label for="input-metabox"><?php _e('Video Optional', 'torotube'); ?></label></td>
			<td><textarea name="video_optional_2"><?php echo get_post_meta($post->ID, 'video_optional_2', true); ?></textarea></td>
		</tr>
		<tr>
			<td class="first"><span class="dashicons dashicons-video-alt2 wp-ui-text-highlight"></span><label for="input-metabox"><?php _e('Video Optional', 'torotube'); ?></label></td>
			<td><textarea name="video_optional_3"><?php echo get_post_meta($post->ID, 'video_optional_3', true); ?></textarea></td>
		</tr>
		<tr>
			<td class="first"><span class="dashicons dashicons-video-alt2 wp-ui-text-highlight"></span><label for="input-metabox"><?php _e('Video Optional', 'torotube'); ?></label></td>
			<td><textarea name="video_optional_4"><?php echo get_post_meta($post->ID, 'video_optional_4', true); ?></textarea></td>
		</tr>

		<tr>
			<td class="first"><span class="dashicons dashicons-format-aside wp-ui-text-highlight"></span><label><?php _e('Top title SEO', 'torotube'); ?></label></td>
			<td><input name="title_seo_single" type="text" value="<?php echo get_post_meta($post->ID, 'title_seo_single', true); ?>"></td>
		</tr>

		<!-- <tr>
			<td class="first"><span class="dashicons dashicons-format-aside wp-ui-text-highlight"></span><label for="input-duration"><?php# _e('Description', 'torotube'); ?></label></td>
			<td><textarea name="torotube_post_desc" cols="30" rows="10"><?php #echo get_post_meta($post->ID,# 'torotube_post_desc', true); ?></textarea></td>
		</tr> -->

	
		<tr>
			<td class="first"><span class="dashicons dashicons-download wp-ui-text-highlight"></span><label><?php _e('Download Link', 'torotube'); ?></label></td>
			<td><input name="eroz_ads_link" type="text" value="<?php echo get_post_meta($post->ID, 'eroz_ads_link', true); ?>"></td>
		</tr>

		<!-- <tr>
			<td class="first"><span class="dashicons dashicons-download wp-ui-text-highlight"></span><label><?php #_e('Download Optional', 'torotube'); ?></label></td>
			<td><input name="eroz_ads_link_2" type="text" value="<?php #echo get_post_meta($post->ID, 'eroz_ads_link_2', true); ?>"></td>
		</tr>

		<tr>
			<td class="first"><span class="dashicons dashicons-download wp-ui-text-highlight"></span><label><?php #_e('Download Optional', 'torotube'); ?></label></td>
			<td><input name="eroz_ads_link_3" type="text" value="<?php #echo get_post_meta($post->ID, 'eroz_ads_link_3', true); ?>"></td>
		</tr>

		<tr>
			<td class="first"><span class="dashicons dashicons-download wp-ui-text-highlight"></span><label><?php #_e('Download Optional', 'torotube'); ?></label></td>
			<td><input name="eroz_ads_link_4" type="text" value="<?php #echo get_post_meta($post->ID, 'eroz_ads_link_4', true); ?>"></td>
		</tr> -->


		<tr>
			<td class="first"><span class="dashicons dashicons-video-alt2 wp-ui-text-highlight"></span><label><?php _e('Video Trailer', 'torotube'); ?></label></td>
			<td><input name="<?php echo $input_trailer; ?>" type="text" value="<?php echo get_post_meta($post->ID, $input_trailer, true); ?>"></td>
		</tr>

	</tbody>
</table>