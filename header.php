<!doctype html>
<?php 
if(isset($_COOKIE["mode_theme"])) {
	$mode = $_COOKIE["mode_theme"];
} else { 
	$mode = get_theme_mod('thememode_option','light');	
} ?>
<html <?php language_attributes(); ?> class="<?php if($mode == 'dark') echo 'dm-on'; ?>"  x-data="{ menu: false, search: false, userm: false, darkm: false}"
:class="{ 'mn-on': menu, 'sr-on': search, 'um-on': userm }"
@keydown.escape="{ menu = false, search = false, userm = false }">
<head>
	
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?php $icons_version = filemtime( TOROTUBE_DIR_PATH . 'public/css/icons.min.css' ); ?>
        <link rel="preload" href="<?php echo TOROTUBE_DIR_URI; ?>public/css/icons.min.css?v=<?php echo $icons_version; ?>" as="style" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo TOROTUBE_DIR_URI; ?>public/css/icons.min.css?v=<?php echo $icons_version; ?>" media="print" onload="this.media='all'">


    <?php wp_head(); 
	#code scripts
	$code_script_header = base64_decode(get_option('script_code_header'));
	if($code_script_header) echo $code_script_header; ?>
	<script data-host="https://analytics.tiendaenoferta.com/public" data-dnt="false" src="https://analytics.tiendaenoferta.com/js/script.js" id="ZwSg9rf6GA" async defer></script>
	
	
<body <?php body_class(); ?>>

    <?php get_template_part( 'public/partials/templates/titles', 'h1' ); ?>

	<header id="header" role="banner" class="body-b zi6">
		<div class="cnt dfx aic fww">
			<?php do_action('header_block'); 
				#10: toggle_menu 
				#20: logo 
				#30: user_menu 
				#40: navigation ?>
		</div>
	</header>