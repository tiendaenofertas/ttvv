<?php 
/*
template name: Register
*/
get_header('none');

$logo_dark   = get_theme_mod( 'logo_dark' ); 
$logo_light  = get_theme_mod( 'logo_light' );  

if(isset($_COOKIE["mode_theme"])) {
	$mode = $_COOKIE["mode_theme"];
} else { $mode = get_theme_mod('thememode_option','light'); }

$login_page = get_option('torotube_login_url');

?>
    <p class="pd24">
		<a href="<?php echo esc_url( home_url() ); ?>"><i class="fa-arrow-left far co01-c mr08"></i> <span class="fwb"><?php echo lang_torotube('Go Back', 'lang_go_back'); ?></span></a>
	</p>

	<div id="content">
		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			<main class="main dfx fdc" role="main">
				<form id="form-register-user">
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
								<div class="ttl f24 h123-c tac"><?php echo lang_torotube('Create your account', 'lang_create_your_account'); ?></div>
								<p class="tac mt08"><?php echo lang_torotube('Please fill out the following fields to signup', 'lang_please_fill_outs'); ?></p>
								<p class="inp lg mt32">
									<input type="text" id="form-register-names" placeholder="<?php echo lang_torotube('User', 'lang_user'); ?>">
								</p>
								<p class="inp lg mt16">
									<input id="form-register-emails" type="email" placeholder="<?php echo lang_torotube('Email', 'lang_email'); ?>">
								</p>
								<p class="inp lg mt16">
									<input id="form-register-passs" type="password" placeholder="<?php echo lang_torotube('Password', 'lang_password'); ?>">
								</p>
								<p class="mt16">
									<button class="btn w100p fwb lg" type="submit"><?php echo lang_torotube('Create account', 'lang_create_acc'); ?></button>
								</p>
							</div>
							<?php if($login_page){ ?>
								<p class="tac"><?php echo lang_torotube('Already have an account?', 'lang_already_have'); ?> <a href="<?php echo $login_page; ?>"><?php echo lang_torotube('Log in', 'lang_login'); ?></a></p>
							<?php } ?>
						<?php } ?>
					</div>
				</form>
			</main>
			
		</div>
		
	</div>
<?php get_footer('none'); ?>