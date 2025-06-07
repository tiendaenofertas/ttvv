<?php

/* toggle menu */
if (!function_exists('header_block_toggle_menu')) {
	function header_block_toggle_menu()
	{ ?>
		<button class="btn px0 snow-b bd0 sw02 text-c brc c-dno" type="button" @click="menu = !menu">
			<i class="fa-bars far" :class="{ 'dno': menu }"><span class="sr-only">menu</span></i>
			<i class="fa-times fal dno" :class="{ 'dbk co01-c f20': menu }"><span class="sr-only">menu</span></i>
		</button>
	<?php }
}
add_action('header_block', 'header_block_toggle_menu', 10);



/* Logo */
if (!function_exists('header_block_logo')) {
	function header_block_logo()
	{
		$logo_dark   = get_theme_mod('logo_dark');
		$logo_light  = get_theme_mod('logo_light');

		if (isset($_COOKIE["mode_theme"])) {
			$mode = $_COOKIE["mode_theme"];
		} else {
			$mode = get_theme_mod('thememode_option', 'light');
		}

	?>
		<?php if (display_header_text()) {  ?>
			<figure class="logo py16 c-py24 tac fg1 mx16 c-tai c-ml0 c-fg0">
				<a id="logo-theme-url" href="<?php echo esc_url(home_url()); ?>">
					<?php if ($mode == 'dark') {
						if ($logo_dark && $logo_dark != '') { ?>
							<img id="logo-theme" width="191" height="48" src="<?php echo $logo_dark; ?>" alt="<?php bloginfo('name'); ?>">
						<?php } else {
							bloginfo('name');
							?>  <p><?php bloginfo('description') ?></p> <?php
						}
					} else {
						if ($logo_light && $logo_light != '') { ?>
							<img id="logo-theme" width="191" height="48" src="<?php echo $logo_light; ?>" alt="<?php bloginfo('name'); ?>">
					<?php } else {
							bloginfo('name');
							?>  <p><?php bloginfo('description') ?></p> <?php
						}
					} ?>
				</a>
			</figure>
		<?php } else { ?>
			<figure class="logo py16 c-py24 tac fg1 mx16 c-tai c-ml0 c-fg0">
				<a id="logo-theme-url" href="<?php echo esc_url(home_url()); ?>">
					<?php if ($mode == 'dark') {
						if ($logo_dark && $logo_dark != '') { ?>
							<img id="logo-theme" width="191" height="48" src="<?php echo $logo_dark; ?>" alt="<?php bloginfo('name'); ?>">
						<?php }
					} else {
						if ($logo_light && $logo_light != '') { ?>
							<img id="logo-theme" width="191" height="48" src="<?php echo $logo_light; ?>" alt="<?php bloginfo('name'); ?>">
					<?php }
					} ?>
				</a>
			</figure>
		<?php }
	}
}
add_action('header_block', 'header_block_logo', 20);



/* user_menu */
if (!function_exists('header_block_user_menu')) {
	function header_block_user_menu()
	{

		/* user menu */
		$user_enable      = get_option('user_menu_enable');
		$user_profile     = get_option('user_menu_profile');
		$user_favorite    = get_option('user_menu_favorite');
		$user_watch_later = get_option('user_menu_watch_later');
		$user_login       = get_option('user_menu_login');
		$user_signin      = get_option('user_menu_signin');
		$user_dark_mode   = get_option('user_menu_dark_mode');

		$page_profile  = get_option('torotube_user_profile_url');
		if (!$page_profile) $page_profile = 'javascript:void(0)';

		$page_login    = get_option('torotube_login_url');
		if (!$page_login) $page_login = 'javascript:void(0)';

		$page_register = get_option('torotube_register_url');
		if (!$page_register) $page_register = 'javascript:void(0)';

		$page_favorite = get_option('torotube_user_favorite_url');
		if (!$page_favorite) $page_favorite = 'javascript:void(0)';

		$page_watch = get_option('torotube_user_watch_url');
		if (!$page_watch) $page_watch = 'javascript:void(0)';

		if ($user_enable  != '' or $user_enable != false) {

			if (isset($_COOKIE["mode_theme"])) {
				$mode = $_COOKIE["mode_theme"];
			} else {
				$mode = get_theme_mod('thememode_option', 'light');
			} ?>

			<div class="user-bx c-or3 por">
				<button class="btn px0 pd0 brc snow-c" :class="{ 'on': userm }" type="button" @click="userm = !userm">
					<i class="fa-user-circle f32"></i>
				</button>
				<ul class="sub-menu poa dno rt0 t100p snow-b sw02 br04 mt16 f14 py08" :class="{ 'dbk': userm }" x-show.transition="userm" @click.away="userm = false" x-cloak>
					<?php
					if (is_user_logged_in()) {
						echo ($user_profile != '') ? '<li><a href="' . $page_profile . '">' . lang_torotube("Profile", "lang_profile") . ' </a></li>' : '';
						echo ($user_favorite != '') ? '<li><a href="' . $page_favorite . '">' . lang_torotube("Favorites", "lang_favorites") . ' </a></li>' : '';
						echo ($user_watch_later != '') ? '<li><a href="' . $page_watch . '">' . lang_torotube("Watch Later", "lang_watch_later") . ' </a></li>' : '';
					} else {
						echo ($user_login != '') ? '<li><a href="' . $page_login . '">' . lang_torotube("Login", "lang_login") . ' </a></li>' : '';
						echo ($user_signin != '') ? '<li><a href="' . $page_register . '">' . lang_torotube("Sign in", "lang_sign_in") . ' </a></li>' : '';
					}
					?>

					<?php if ($user_dark_mode != '') { ?>
						<li>
							<button id="mode-theme" class="btn dark-btn bgt w100p body-b-h text-c link-c-h" type="button" @click="darkm = !darkm">
								<div class="dfx jcb w100p">
									<span><?php echo lang_torotube('Dark mode', 'lang_dark_mode'); ?></span>
									<i id="mode-theme-change" class="fa-toggle-off text-c f20 <?php if ($mode == "dark") echo 'fa-toggle-on co01-c'; ?>"></i>
								</div>
							</button>
						</li>
					<?php } ?>
					<?php if (is_user_logged_in()) { ?>
						<li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php echo lang_torotube('Sign out', 'lang_sign_out'); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		<?php }
	}
}
add_action('header_block', 'header_block_user_menu', 30);



/* navigation */
if (!function_exists('header_block_navigation')) {
	function header_block_navigation()
	{
		$search_enable      = get_option('search_header_enable');
		?>
		<nav class="menu fb1 c-dfx c-fg1 c-mx16 poa c-pos lt0 rt0 px16 pb16 body-b c-pd0 c-f14 d-f16" x-show.transition="menu" @click.away="menu = false" x-cloak>
			<?php if ($search_enable) { ?>
				<div class="search mb16 c-mb0 c-or2 w100p por">
					<?php get_search_form(); ?>
				</div>
			<?php }
			if (has_nav_menu('header')) {
				wp_nav_menu(
					array(
						'menu'           => 'headermenu',
						'theme_location' => 'header',
						'container'      => false,
						'items_wrap'     => '<ul class="c-dfx aic c-fg1">%3$s</ul>',
					)
				);
			}
			?>

		</nav>
<?php }
}
add_action('header_block', 'header_block_navigation', 40);
