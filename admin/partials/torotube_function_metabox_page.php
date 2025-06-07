<?php
/**
 * Post Editor WP-admin
 * Metabox Post
 * Change: Add metabox over player
 */
global $post;
wp_nonce_field('act_nonce_name', 'meta-box-nonce');
?>
<table class="form-table torotube-video-meta">
	<tbody>
		<tr>
			<td class="first"><span class="dashicons dashicons-format-aside wp-ui-text-highlight"></span><label><?php _e('Top Title SEO', 'torotube'); ?></label></td>
			<td><input name="top_title_seo_page" type="text" value="<?php echo get_post_meta($post->ID, 'top_title_seo_page', true); ?>"></td>
		</tr>
	</tbody>
</table>