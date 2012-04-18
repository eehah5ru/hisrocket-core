<?php include ("inc-header.php"); ?>

				<!--div id="breadcrumbs">
					<h2><a href="<?php echo html_encode(getGalleryIndexURL());?>" title="<?php echo gettext('Home'); ?>"><?php echo gettext('Home'); ?></a> &raquo; <a href="<?php echo getCustomPageURL('gallery'); ?>" title="<?php echo gettext('Gallery Index'); ?>"><?php echo gettext('Gallery Index'); ?></a> &raquo; <?php printParentBreadcrumb('',' &raquo; ',' &raquo; '); ?> <?php printAlbumBreadcrumb('',' &raquo; '); ?><?php printImageTitle(true); ?></h2>
				</div-->
			</div> <!-- close #header -->
			<div id="content">
				<div id="main"<?php if ($zpmin_switch) echo ' class="switch"'; ?>>
					<?php if (function_exists('printjCarouselThumbNav')) { printjCarouselThumbNav(2,77,77,77,77); } ?>
					<div class="image-nav">
						<?php if (hasPrevImage()) { ?><a class="image-prev" href="<?php echo html_encode(getPrevImageURL());?>" title="<?php echo gettext("Previous Image"); ?>">&lt;</a><?php } else  {?><span class="image-prev">&lt;</span><?php }?>
						<?php if (hasNextImage()) { ?><a class="image-next" href="<?php echo html_encode(getNextImageURL());?>" title="<?php echo gettext("Next Image"); ?>">&gt;</a><?php } else  {?><span class="image-prev">&gt;</span><?php } ?>
						<span title="<?php echo gettext('Image Number/Total images'); ?>"><?php echo printAlbumTitle(true); ?></span>												
					</div>
					
					<div id="image-wrap">
						<div id="full-image">
							<?php if (($zpmin_finallink)=='colorbox') { ?><a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),550); ?></a><?php } ?>
							<?php if (($zpmin_finallink)=='nolink') { printCustomSizedImage(getAnnotatedImageTitle(),550); } ?>
							<?php if (($zpmin_finallink)=='standard') { ?><a href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),550); ?></a><?php } ?>
							<?php if (($zpmin_finallink)=='standard-new') { ?><a target="_blank" href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),550); ?></a><?php } ?>
						</div>
					</div>
					<?php if (function_exists('printGoogleMap')) { ?><div class="section"><?php setOption('gmap_width',550,false); printGoogleMap(); ?></div><?php } ?>
					<?php if (function_exists('printRating')) { ?><div class="section"><?php printRating(); ?></div><?php } ?>
					<?php if (function_exists('printCommentForm')) { ?><div class="section"><?php printCommentForm(); ?></div><?php } ?>
				</div>
				<div id="sidebar"<?php if ($zpmin_switch) echo ' class="switch"'; ?>>
					<?php include ("inc-sidemenu.php"); ?>
				</div>
			</div>

<?//php include ("inc-footer.php"); ?>			
