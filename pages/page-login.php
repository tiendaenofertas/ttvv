<?php 
/*
template name: Login
*/
get_header('none');

$logo_dark   = get_theme_mod( 'logo_dark' ); 
$logo_light  = get_theme_mod( 'logo_light' );  

if(isset($_COOKIE["mode_theme"])) {
	$mode = $_COOKIE["mode_theme"];
} else { $mode = get_theme_mod('thememode_option','light'); }

$register_page = get_option('torotube_register_url');

?>
    <p class="pd24">
		<a href="<?php echo esc_url( home_url() ); ?>"><i class="fa-arrow-left far co01-c mr08"></i> <span class="fwb"><?php echo lang_torotube('Go Back', 'lang_go_back'); ?></span></a>
	</p>
    <div id="content">

		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			<main class="main dfx fdc" role="main">				

				<form id="form-login">
					<div class="user-f w100p mga py24">
						<figure class="logo tac"><a href="<?php echo esc_url( home_url() ); ?>">

						<?php if($mode == 'dark'){
							if($logo_dark && $logo_dark != ''){ ?>
								<img id="logo-theme"  width="191" height="48" src="<?php echo $logo_dark; ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php } else {
								bloginfo( 'name' ); 
							}
						} else { 
							if($logo_light && $logo_light != ''){ ?>
								<img id="logo-theme"  width="191" height="48" src="<?php echo $logo_light; ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php } else {
								bloginfo( 'name' );
							}
						} ?>
						</a></figure>

						<?php if(!is_user_logged_in()){ ?>
						
							<div class="snow-b pd24 sw03 mt24 b-pd48">
								<div class="ttl f24 h123-c tac"><?php echo lang_torotube('Login', 'lang_login'); ?></div>
								<p class="tac mt08"><?php echo lang_torotube('Welcome back', 'lang_welcome_back'); ?></p>
								<p class="inp lg mt16">
									<input required id="form-login-names" placeholder="<?php echo lang_torotube('User or email', 'lang_user_email'); ?>">
								</p>
								<p class="inp lg mt16">
									<input type="password" required id="form-login-pat" placeholder="<?php echo lang_torotube('Password', 'lang_password'); ?>">
								</p>
								<p class="chk mt16">
									<input type="checkbox">
									<span class="fa-check"><?php echo lang_torotube('Remember me', 'lang_remember_me'); ?></span>
								</p>
								<p class="mt16">
									<button class="btn w100p fwb lg" type="submit"><?php echo lang_torotube('Login', 'lang_login'); ?></button>
								</p>
								<p class="fwb f14 tac">
									<a href="<?php echo wp_lostpassword_url(); ?>"><?php echo lang_torotube('Forgot password?', 'lang_forgot_password'); ?></a>
								</p>
							</div>
							<?php if($register_page){ ?>
								<p class="tac"><?php echo lang_torotube('Not registered yet?', 'lang_not_registered'); ?> <a href="<?php echo $register_page; ?>"><?php echo lang_torotube('Create an Account', 'lang_create_account'); ?></a></p>
							<?php }

						} ?>
					</div>
				</form>
			</main>
		</div>
	</div>
<?php get_footer('none'); ?>