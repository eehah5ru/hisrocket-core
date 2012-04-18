		<div class="left">
			
			<?php if (($zpfocus_showrandom) == 'single') { ?>
			<!-- PRINTS SINGLE RANDOM IMAGE, FROM ALBUM IF ON ALBUM OR IMAGE CONTEXT -->
			<div id="random-wrap">
				<?php
				if ((in_context(ZP_ALBUM)) || (in_context(ZP_IMAGE))) {
				printRandomImages(1,'','album','',300,300,true);
				} else {
				printRandomImages(1,'','all','',300,300,true); 
				} ?>
				
				<div id="random-title">
				<?php if ((in_context(ZP_ALBUM)) || (in_context(ZP_IMAGE))) {
				echo gettext('Random Album Image');
				} else { 
				echo gettext('Random Gallery Image');
				} ?>
				</div>
			</div>
			<?php } ?>
			
			<?php if (($zpfocus_showrandom) == 'rotator') { ?>
			<!-- PRINTS SLIDER OF RANDOM IMAGES, FROM ALBUM IF ON ALBUM OR IMAGE CONTEXT -->
			<div id="random-wrap">
				<?php
				if ((in_context(ZP_ALBUM)) || (in_context(ZP_IMAGE))) {
				printRandomImagesCustom(5,'','album','',300,300,true);
				} else {
				printRandomImagesCustom(5,'','all','',300,300,true); 
				} ?>
			</div>
			
			<?php } ?>

			
			<!-- PRINTS ZENPAGE EXTRA CONTENT FOR NEW ITEMS, IF APPLICABLE -->
			<?php if ((function_exists("printNewsExtraContent")) && (getNewsExtraContent()) ) { ?>
			<div class="extracontent">
			<?php printNewsExtraContent(); ?>
			</div>
			<?php } ?>
			
			<!-- PRINTS ZENPAGE EXTRA CONTENT FOR PAGE ITEMS, IF APPLICABLE -->
			<?php if ((function_exists("printPageExtraContent")) && (getPageExtraContent()) ) { ?>
			<div class="extracontent">
			<?php printPageExtraContent(); ?>
			</div>
			<?php } ?>
			
			<!-- PRINTS GALLERY DESCRIPTION -->
			<h4 class="blockhead"><span><?php echo gettext('About'); ?></span></h4>
			<?php printGalleryDesc( ); ?>
			
			<!-- PRINTS ZENPAGE LATEST NEWS, IF APPLICABLE -->
			<?php if ((function_exists("printLatestNews")) && (getLatestNews()) &&  ($_zp_gallery_page != 'news.php') ) { 
			if ((($zpfocus_spotlight) == 'latest') && ($_zp_gallery_page == 'index.php')) { ?>
			<div id="spotlight2">
				<h4 class="blockhead"><span><?php echo gettext('More News'); ?></span></h4>
				<?php printLatestNews( 4,'none','',true,true,150,true,null ); ?>
			<?php } else { ?>
			<div id="spotlight1">
				<h4 class="blockhead"><span><?php echo gettext('Latest News'); ?></span></h4>
				<?php printLatestNews( 3,'none','',true,true,150,true,null ); ?>
			<?php } ?>
			</div>
			<?php } ?>			
			
			<!-- PRINTS LATEST GALLERY COMMENTS, IF NOT IN NEWS CONTEXT -->
			<?php if ( $_zp_gallery_page != 'news.php') { ?>
			<?php if ((function_exists('printCommentForm')) && (getLatestComments(1,'all')) ) { ?>
			<h4 class="blockhead"><span><?php echo gettext('Latest Gallery Comments'); ?></span></h4>
			<?php printLatestComments( 3,'100'); ?>
			<?php } ?>
			<?php } ?>
			
			<!-- PRINTS LATEST ZENPAGE COMMENTS & NEWS CATEGORIES IF IN NEWS OR PAGES -->
			<?php if ( $_zp_gallery_page == 'news.php') { ?>
			
			<div id="newscats">
			<h4 class="blockhead"><span><?php echo gettext('News Categories'); ?></span></h4>
			<?php printAllNewsCategories(''); ?>
			</div>
			
			<?php if (function_exists('printCommentForm')) { ?>
			<h4 class="blockhead"><span><?php echo gettext('Latest News Comments'); ?></span></h4>
			<?php printLatestZenpageComments(3,'100'); ?>
			<?php } ?>
			
			<?php } ?>
			
		</div>