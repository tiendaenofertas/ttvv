<?php 
/*
template name: User Profile
*/
get_header(); 

$current_user = wp_get_current_user();

$sidebar = get_option( 'torotube_sidebar_general' );
if(!$sidebar) $sidebar = 'tt-nsdb'; 

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div id="content">

		<div class="site dgd gt1 gr16 gc32 e-gc64 cnt mt24 c-mt32">
			<main class="main dfx fdc" role="main">
				<div class="user-f w100p mga py24">
					<div class="snow-b pd24 sw03 mt24 b-pd48">
						<form id="edit-user-profile" data-user="<?php echo $current_user->ID; ?>">
							<div class="ttl f24 h123-c tac pb16"><?php echo lang_torotube('My Account', 'lang_my_account'); ?></div>
							<p class="inp ph xl mt16 por">
								<input id="name" type="text" placeholder="<?php echo lang_torotube('User', 'lang_user'); ?>" value="<?php echo $current_user->display_name; ?>">
								<label class="poa lt0 tp0 op0" for="name"><span class="f10 fwb pt16 pl04 dbk"><?php echo lang_torotube('User', 'lang_user'); ?></span></label>
								
							</p>
							<p class="inp ph xl mt16 por">
								<input readonly id="email" type="email" placeholder="<?php echo lang_torotube('Email', 'lang_email'); ?>" value="<?php echo $current_user->user_email; ?>">
								<label class="poa lt0 tp0 op0" for="email"><span class="f10 fwb pt16 pl04 dbk"><?php echo lang_torotube('Email', 'lang_email'); ?></span></label>
							
							</p>
							<p class="inp ph xl mt16 por">
								<input id="pass" type="password" placeholder="<?php echo lang_torotube('Password', 'lang_password'); ?>" value="">
								<label class="poa lt0 tp0 op0" for="pass"><span class="f10 fwb pt16 pl04 dbk"><?php echo lang_torotube('Password', 'lang_password'); ?></span></label>
							</p>
							<p id="res-profile" class="mt16">
								<button id="submit-edit-profile" class="btn w100p fwb xl" type="submit"><?php echo lang_torotube('Save changes', 'lang_save_changes'); ?></button>
							</p>
						</form>
					</div>
				</div>
			</main>
			<?php
			if( (get_option('torotube_sidebar_general')!=false and get_option('torotube_sidebar_general') != 'tt-nsdb') or  ( get_option('torotube_sidebar_user')!=false and get_option('torotube_sidebar_user') != 'tt-nsdb') ){
				get_sidebar();
			}
			?>
		</div>

		<aside class="cnt mt24 c-mt32">
            <div class="wdgt mt24 c-mt32">
                <div class="div">
                    <?php the_content(); ?>
                </div>
            </div>
        </aside>
		
	</div>

	<?php endwhile; endif;
get_footer(); ?>