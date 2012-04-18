	</div> <!-- END WRAP -->
	<div class="footerwrap">
		<div class="left">
			<div id="copyright">
				<p>&copy; <?php echo getBareGalleryTitle(); ?>, <?php echo gettext('all rights reserved'); ?></p>
			</div>
			<div id="zpcredit">
				<?php if ($zpfocus_show_credit) { printZenphotoLink(); } ?>
			</div>
			<!--<div id="validators">
				<a href="http://validator.w3.org/check/referer"><?php echo gettext('Valid XHTML 1.0'); ?></a>
				&nbsp;|&nbsp;
				<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3"><?php echo gettext('Valid CSS'); ?></a>
			</div>-->
		</div>
		<div class="right">
			<ul id="login_menu">
				<?php
				if (!zp_loggedin() && function_exists('printRegistrationForm')) { ?>
				<li><a href="<?php echo getCustomPageURL('register'); ?>" title="<?php echo gettext('Register'); ?>"><?php echo gettext('Register'); ?></a></li>
				<?php } ?>
				
				<?php if(function_exists("printUserLogin_out")) {
				if (zp_loggedin()) { ?>
				<li><?php printUserLogin_out("",""); ?></li>
				<?php } else { ?>
				<li> | <a href="#" class="cbLogin"><?php echo gettext('Login'); ?></a></li>
				<?php } ?>
				<?php } ?>	
			</ul>
			<div style="display:none;">
				<?php if ((function_exists("printUserLogin_out")) && (!zp_loggedin()) ) { ?>
				<div id="cbLogin">
				<?php printUserLogin_out("","",true); ?>
				</div>
				<?php } ?>
			</div>
			<div id="rsslinks">
				<span><?php echo gettext('Subscribe: '); ?></span>
				<?php 
				if (in_context(ZP_ALBUM)) { printRSSLink( "Collection","",gettext('This Album'),"  |  ", false,"rsslink" ); }
				printRSSLink( "Gallery","",(gettext('Gallery Images')),"",false,"rsslink" ); 
				if (function_exists('getBarePageTitle')) { printZenpageRSSLink( "News",'','  |  ',gettext('News'),'',false ); }		
				?>
			</div>
			<br />
			<?php if (function_exists('printLanguageSelector')) { printLanguageSelector("langselector"); } ?>
		</div>
	</div>
	<?php zp_apply_filter('theme_body_close'); ?>	
</body>
</html>