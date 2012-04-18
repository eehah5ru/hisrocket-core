<?php include("header.php"); ?>
<?php include ("sidebar.php"); ?>	
	
		<div class="right">
			<h1 id="tagline"><?php printNewsIndexURL("News"); ?><?php printCurrentNewsCategory(" / Category - "); ?><?php printNewsTitle(" / "); printCurrentNewsArchive(" / "); ?></h1>
			<?php if ($zpfocus_logotype) { ?>
			<a style="display:block;" href="<?php echo getGalleryIndexURL(false); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/<?php echo $zpfocus_logofile; ?>" alt="<?php echo getBareGalleryTitle(); ?>" /></a>
			<?php } else { ?>
			<h2 id="logo"><a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo getBareGalleryTitle(); ?></a></h2>
			<?php } ?>
			
			<?php
			// single news article
			if(is_NewsArticle()) { ?>  

			<div class="newsarticle">
				<div class="newsarticlecredit">
					<span class="newsarticlecredit-left"><?php printNewsDate();?> | 
						<?php if ((function_exists('printCommentForm')) && (zenpageOpenedForComments())) { ?>
						<?php echo gettext("Comments:"); ?> <?php echo getCommentCount(); ?> | 
						<?php } ?>
					</span>
					<?php printNewsCategories(", ",gettext("Categories: "),"newscategories"); ?> |
					<?php printTags('links', gettext('Tags:').' ', 'taglist', ', '); ?>
				</div>
				<h3><?php printNewsTitleLink(); ?></h3>	
				<?php printNewsContent(); ?>
			</div>
			
			<?php if (function_exists('printRating')) { ?>
			<div id="rating" class="rating-news">
			<?php printRating(); ?>
			</div>
			<?php } ?>
			
			<?php if ((function_exists('printCommentForm')) && (zenpageOpenedForComments())) { ?>
			<a href="javascript:void(0);" id="comment-toggle"><?php echo gettext('Comments'); ?> (<?php echo getCommentCount(); ?>)</a>
			<div id="comments-block">
				<?php printCommentForm(); ?>
			</div>
			<?php } ?>
						
			<div id="img-topbar" class="clearfix" style="margin-top:15px;">
				<?php if (getNextNewsURL()) { ?>
				<div id="img-next"><?php printNextNewsLink('&gt;'); ?></div>
				<?php } ?>								
				<?php if (getPrevNewsURL()) { ?>
				<div id="img-prev"><?php printPrevNewsLink('&lt;'); ?></div>
				<?php } ?>
			</div>
			
			<?php } else {	
			// news article loop
			while (next_news()): ;?> 
			<div class="newsarticle"> 
				<div class="newsarticlecredit">
					<span class="newsarticlecredit-left"><?php printNewsDate();?> | 
						<?php if (function_exists('printCommentForm')) { ?>
						<?php echo gettext("Comments:"); ?> <?php echo getCommentCount(); ?> | 
						<?php } ?>
					</span>
					<?php printNewsCategories(", ",gettext("Categories: "),"newscategories"); ?>
					<?php printTags('links', gettext('Tags:').' ', 'taglist', ', '); ?>
				</div>
				<h3><?php printNewsTitleLink(); ?></h3>		
				<?php printNewsContent(); ?>
				<?php printCodeblock(1); ?>
			</div>	
			<?php endwhile; ?>
			<div class="page-nav">
				<?php printNewsPageListWithNav( '&gt;&gt;','&lt;&lt;','true','page-nav' ); ?>
			</div>
			<?php } ?> 
			
		</div>		

<?php include("footer.php"); ?>

