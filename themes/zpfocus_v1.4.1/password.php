<?php include ("header.php"); ?>
<?php include ("sidebar.php"); ?>

		<div class="right">
			<h1 id="tagline"><?php echo $zpfocus_tagline; ?></h1>
			<?php if ($zpfocus_logotype) { ?>
			<a style="display:block;" href="<?php echo getGalleryIndexURL(false); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/<?php echo $zpfocus_logofile; ?>" alt="<?php echo getBareGalleryTitle(); ?>" /></a>
			<?php } else { ?>
			<h2 id="logo"><a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo getBareGalleryTitle(); ?></a></h2>
			<?php } ?>
			
			<div class="error"><?php echo gettext("A password is required for the page you requested"); ?></div>	
			<?php printPasswordForm(NULL, false); ?>
		
		</div>
		
<?php include("footer.php"); ?>

