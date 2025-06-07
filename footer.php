<?php 
$logo_footer = get_theme_mod('footer_logo');

if( $logo_footer or has_nav_menu( 'footer' ) ){ ?>
	<footer id="footer" role="contentinfo" class="mt24 c-mt32 gray-b py16 c-py0">
		<div class="cnt c-dfx aic fww jcb">

			<?php echo ($logo_footer) ? '<figure class="logo py16 c-py24 tac fg1 mx16 c-tai c-ml0 c-fg0"><img width="191" height="48" src="'.$logo_footer.'" alt="torotube"></figure>' : ''; ?>
			
			<?php if ( has_nav_menu( 'footer' ) ) { ?>
				<nav class="menu">
					<?php 
					wp_nav_menu(
						array(
							'menu'           => 'MenuFooter', 
							'theme_location' => 'footer',
							'container'      => false,
							'items_wrap'     => '<ul class="dfx aic fww jcc">%3$s</ul>',
						)
					);
					?>
				</nav>
			<?php } ?>
		</div>
	</footer>
<?php } 
wp_footer();
$disqus_enable = get_option('enable_disqus');
if($disqus_enable) echo base64_decode(get_option('disqus_code')); 

#code scripts
$code_script_footer = base64_decode(get_option('script_code_footer'));
if($code_script_footer) echo $code_script_footer;
?>


</body>
</html>