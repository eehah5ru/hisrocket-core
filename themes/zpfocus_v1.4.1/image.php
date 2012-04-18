<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>

		<div class="right">
			<h1 id="tagline"><?php printParentBreadcrumb("", " / ", " / "); printAlbumBreadcrumb("", " / "); ?><?php printImageTitle(true); ?></h1>
			<?php if ($zpfocus_logotype) { ?>
			<a style="display:block;" href="<?php echo getGalleryIndexURL(false); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/<?php echo $zpfocus_logofile; ?>" alt="<?php echo getBareGalleryTitle(); ?>" /></a>
			<?php } else { ?>
			<h2 id="logo"><a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo getBareGalleryTitle(); ?></a></h2>
			<?php } ?>
			
			<div id="img-topbar" class="clearfix">
				<?php if (hasNextImage()) { ?>
				<a id="img-next" href="<?php echo getNextImageURL(); ?>" title="Next Image">Next &gt;</a> 
				<?php } ?>								
				<?php if (hasPrevImage()) { ?>
				<a id="img-prev" href="<?php echo getPrevImageURL(); ?>" title="Previous Image">&lt; Prev</a>
				<?php } ?>
				<span id="img-title"><?php printImageTitle(true); ?></span>
			</div>
			<div class="album-details">
				<div class="album-tags"><?php printTags( 'links',gettext('TAGS:  '),'taglist',', ',true,'',true  ); ?></div>
				<ul>
					<li><?php printImageDate('','',null,true); ?></li>					
					<li>&nbsp;&nbsp;<a href="javascript:void(0);" class="inline"><?php echo gettext ('EXIF Metadata') ?></a></li>
				</ul>					
			</div>
			
			<p class="description"><?php printImageDesc( true,'',gettext('(Edit Description...)') ); ?></p>
			<div id="img-full">
				<div>
					<?php if (($zpfocus_final_link)=='colorbox') { ?><a rel="zoom" href="<?php if ($zpfocus_cbtarget) { echo htmlspecialchars(getDefaultSizedImage()); } else { echo htmlspecialchars(getUnprotectedImageURL()); } ?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImageMaxSpace(getImageTitle(),600,900); ?></a><?php } ?>
					<?php if (($zpfocus_final_link)=='nolink') { printCustomSizedImageMaxSpace(getImageTitle(),600,900); } ?>
					<?php if (($zpfocus_final_link)=='standard') { ?><a href="<?php echo htmlspecialchars(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImageMaxSpace(getImageTitle(),600,900); ?></a><?php } ?>
					<?php if (($zpfocus_final_link)=='standard-new') { ?><a target="_blank" href="<?php echo htmlspecialchars(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImageMaxSpace(getImageTitle(),600,900); ?></a><?php } ?>
				</div>
			</div>

			<?php if (function_exists('printRating')) { ?>
			<div id="rating" class="rating-news">
			<?php printRating(); ?>
			</div>
			<?php } ?>
			
			<?php if (function_exists('printGoogleMap')) { ?>
			<div class="gmap">
			<?php setOption('gmap_width',600,false); printGoogleMap(); ?>
			</div>
			<?php } ?>
			
			<?php if ((function_exists('printCommentForm')) && (OpenedForComments())) { ?>
			<a href="javascript:void(0);" id="comment-toggle"><?php echo gettext('Comments'); ?> (<?php echo getCommentCount(); ?>)</a>
			<div id="comments-block">
				<?php printCommentForm(); ?>
			</div>
			<?php } ?>
			
			<?php if (function_exists('printjCarouselThumbNav')) { 
				printjCarouselThumbNav(5,87,87,87,87,false);
			} else {
				if (function_exists("printPagedThumbsNav")) {
				printPagedThumbsNav(5,true,' ',' ',87,87);
				}
			} ?>
					
			<div class="loading">
				<div id="exif" style="padding:20px; background:#fff; border:5px solid #eee;">
					<?php printImageMetadata('', false); ?>
				</div>
			</div>
			
		</div>					

<?php include("footer.php"); ?>