<?php include("header.php"); ?>
<?php include ("sidebar.php"); ?>	
	
		<div class="right">
			<h1 id="tagline"><?php printPageTitle(); ?></h1>
			<?php if ($zpfocus_logotype) { ?>
			<a style="display:block;" href="<?php echo getGalleryIndexURL(false); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/<?php echo $zpfocus_logofile; ?>" alt="<?php echo getBareGalleryTitle(); ?>" /></a>
			<?php } else { ?>
			<h2 id="logo"><a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo getBareGalleryTitle(); ?></a></h2>
			<?php } ?>
			
			<div class="post">
				<?php printPageContent(); 
				printCodeblock(1); ?>
				<div class="newsarticlecredit">
					<?php printTags('links', gettext('Tags:').' ', 'taglist', ', '); ?>
				</div>	
				<?php if (function_exists('printRating')) { printRating(); } ?>
			</div>
		
			<?php if ((function_exists('printCommentForm')) && (zenpageOpenedForComments())) { ?>
			<a href="javascript:void(0);" id="comment-toggle"><?php echo gettext('Comments'); ?> (<?php echo getCommentCount(); ?>)</a>
			<div id="comments-block">
				<?php printCommentForm(); ?>
			</div>
			<?php } ?>
			
		</div>		

<?php include("footer.php"); ?>

