<?php include ("inc-header.php"); ?>

				<!--div id="breadcrumbs">
					<h2><a href="<?php echo html_encode(getGalleryIndexURL());?>" title="<?php echo gettext('Home'); ?>"><?php echo gettext('Home'); ?></a> &raquo; <a href="<?php echo getCustomPageURL('gallery'); ?>" title="<?php echo gettext('Gallery Index'); ?>"><?php echo gettext('Gallery Index'); ?></a> &raquo; <?php printParentBreadcrumb('',' &raquo; ',' &raquo; '); ?> <?php printAlbumTitle(true);?></h2>
				</div-->
			</div> <!-- close #header -->
			<div id="content">
				<div id="main"<?php if ($zpmin_switch) echo ' class="switch"'; ?>>
					<div id="albums-wrap">
						<?php while (next_album()): ?>
						<div class="album-maxspace">
							<a class="thumb-link" href="<?php echo html_encode(getAlbumLinkURL());?>" title="<?php echo getNumAlbums().' '.gettext('subalbums').' / '.getNumImages().' '.gettext('images').' - '.shortenContent(getBareAlbumDesc(),300,'...'); ?>">
								<?php if ($zpmin_thumb_crop) {
								printCustomAlbumThumbImage(getAnnotatedAlbumTitle(),null,$zpmin_album_thumb_size,$zpmin_album_thumb_size,$zpmin_album_thumb_size,$zpmin_album_thumb_size);
								} else {
								printCustomAlbumThumbImage(getAnnotatedAlbumTitle(),$zpmin_album_thumb_size);
								} ?>
								<span class="album-title"><?php echo shortenContent(getBareAlbumTitle(),25,'...'); ?></span>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
						<h3><?php printAlbumTitle(true); ?></h3>					
					<div id="thumbs-wrap">
						<?php while (next_image()): ?>
						<div class="thumb-maxspace">
							<a class="thumb-link" href="<?php echo html_encode(getImageLinkURL());?>" title="<?php echo getBareImageTitle(); ?>"><?php printImageThumb(getAnnotatedImageTitle()); ?></a>
							<?php if (($zpmin_colorbox) && (!isImageVideo())) { ?>
							<div class="cblinks">
								<a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>" title="<?php echo getBareImageTitle(); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/zoom.png" /></a>
								<a href="<?php echo html_encode(getImageLinkURL());?>" title="<?php echo getBareImageTitle(); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/details.png" /></a>
							</div>
							<?php } ?>
						</div>
						<?php endwhile; ?>
					</div>
					<?php if ( (hasPrevPage()) || (hasNextPage()) ) { ?>
					<div id="pagination">
						<?php printPageListWithNav("&larr; ".gettext("prev"), gettext("next")." &rarr;"); ?>
					</div>
					<?php } ?>
					<?php if (function_exists('printGoogleMap')) { ?><div class="section"><?php setOption('gmap_width',550,false); printGoogleMap(); ?></div><?php } ?>
					<?php if (function_exists('printRating')) { ?><div class="section"><?php printRating(); ?></div><?php } ?>
					<?php if (function_exists('printCommentForm')) { ?><div class="section"><?php printCommentForm(); ?></div><?php } ?>
				</div>
				<div id="sidebar"<?php if ($zpmin_switch) echo ' class="switch"'; ?>>
					<div class="sidebar-section"><?php include ("inc-sidemenu.php"); ?></div>
				</div>
			</div>

<?//php include ("inc-footer.php"); ?>			
