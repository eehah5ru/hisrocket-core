<?php

setOption('zp_plugin_colorbox',false,false); 
if (!is_null(getOption('zpfocus_tagline'))) { $zpfocus_tagline = getOption('zpfocus_tagline'); } else { $zpfocus_tagline = 'A ZenPhoto / ZenPage Powered Theme'; }
if (!is_null(getOption('zpfocus_allow_search'))) { $zpfocus_allow_search = getOption('zpfocus_allow_search'); } else { $zpfocus_allow_search = true; }
if (!is_null(getOption('zpfocus_show_archive'))) { $zpfocus_show_archive = getOption('zpfocus_show_archive'); } else { $zpfocus_show_archive = true; }
if (!is_null(getOption('zpfocus_show_stats_inmenu'))) { $zpfocus_show_stats_inmenu = getOption('zpfocus_show_stats_inmenu'); } else { $zpfocus_show_stats_inmenu = false; }
if (!is_null(getOption('zpfocus_use_colorbox'))) { $zpfocus_use_colorbox = getOption('zpfocus_use_colorbox'); } else { $zpfocus_use_colorbox = true; }
if (!is_null(getOption('zpfocus_use_colorbox_slideshow'))) { $zpfocus_use_colorbox_slideshow = getOption('zpfocus_use_colorbox_slideshow'); } else { $zpfocus_use_colorbox_slideshow = true; }
if (!is_null(getOption('zpfocus_homepage'))) { $zpfocus_homepage = getOption('zpfocus_homepage'); } else { $zpfocus_homepage = 'none'; }
if (!is_null(getOption('zpfocus_spotlight'))) { $zpfocus_spotlight = getOption('zpfocus_spotlight'); } else { $zpfocus_spotlight = 'manual'; }
if (!is_null(getOption('zpfocus_spotlight_text'))) { $zpfocus_spotlight_text = getOption('zpfocus_spotlight_text'); } else { $zpfocus_spotlight_text = '<p>This is the <span class="spotlight-span">spotlight</span> area that can be set in the theme options.  You can either enter the text manually in the options or set it to display the latest news if ZenPage is being used. If you want nothing to appear here, set the spotlight to none.</p>'; }
if (!is_null(getOption('zpfocus_show_credit'))) { $zpfocus_show_credit = getOption('zpfocus_show_credit'); } else { $zpfocus_show_credit = false; }
if (!is_null(getOption('zpfocus_menutype'))) { $zpfocus_menutype = getOption('zpfocus_menutype');	 } else { $zpfocus_menutype = 'dropdown';	 }	
if (!is_null(getOption('zpfocus_logotype'))) { $zpfocus_logotype = getOption('zpfocus_logotype'); } else { $zpfocus_logotype = true; }
if (!is_null(getOption('zpfocus_logofile'))) { $zpfocus_logofile = getOption('zpfocus_logofile'); } else { $zpfocus_logofile = 'logo.jpg'; }
if (!is_null(getOption('zpfocus_showrandom'))) { $zpfocus_showrandom = getOption('zpfocus_showrandom'); } else { $zpfocus_showrandom = 'rotator'; }	
if (!is_null(getOption('zpfocus_cbtarget'))) { $zpfocus_cbtarget = getOption('zpfocus_cbtarget'); } else { $zpfocus_cbtarget = true; }
if (!is_null(getOption('zpfocus_cbstyle'))) { $zpfocus_cbstyle = getOption('zpfocus_cbstyle'); } else { $zpfocus_cbstyle = 'style3'; }	
if (!is_null(getOption('zpfocus_cbtransition'))) { $zpfocus_cbtransition = getOption('zpfocus_cbtransition'); } else { $zpfocus_cbtransition = 'fade'; }
if (!is_null(getOption('zpfocus_cbssspeed'))) { $zpfocus_cbssspeed = getOption('zpfocus_cbssspeed'); } else { $zpfocus_cbssspeed = '2500'; }

if (!is_null(getOption('zpfocus_final_link'))) { $zpfocus_final_link = getOption('zpfocus_final_link'); } else { $zpfocus_final_link = 'nolink'; }

if (!is_null(getOption('zpfocus_rotatorcount'))) { $zpfocus_rotatorcount = getOption('zpfocus_rotatorcount'); } else { $zpfocus_rotatorcount = '5'; }
if (!is_null(getOption('zpfocus_rotatoreffect'))) { $zpfocus_rotatoreffect = getOption('zpfocus_rotatoreffect'); } else { $zpfocus_rotatoreffect = 'fade'; }
if (!is_null(getOption('zpfocus_rotatorspeed'))) { $zpfocus_rotatorspeed = getOption('zpfocus_rotatorspeed'); } else { $zpfocus_rotatorspeed = '3000'; }

/**
 * Prints the breadcrumb navigation for album, gallery and image view.
 *
 * @param string $before Insert here the text to be printed before the links
 * @param string $between Insert here the text to be printed between the links
 * @param string $after Insert here the text to be printed after the links
 * @param mixed $truncate if not empty, the max lenght of the description.
 * @param string $elipsis the text to append to the truncated description
 */
function printTitleBreadcrumb($before = ' | ', $between=' | ', $after = '') {
	global $_zp_gallery, $_zp_current_search, $_zp_current_album, $_zp_last_album;
	
	if (in_context(ZP_SEARCH_LINKED)) {
		$dynamic_album = $_zp_current_search->dynalbumname;
		if (empty($dynamic_album)) {
			echo $before.gettext("Search Result");
			if (is_null($_zp_current_album)) {
				echo $after;
				return;
			} else {
				$parents = getParentAlbums();
				//echo $between;
			}
		} else {
			$album = new Album($_zp_gallery, $dynamic_album);
			$parents = getParentAlbums($album);
			if (in_context(ZP_ALBUM_LINKED)) {
				array_push($parents, $album);
			}
		}
	} else {
		$parents = getParentAlbums();
	}
	$n = count($parents);
	if ($n > 0) {
		echo $before;
		$i = 0;
		foreach($parents as $parent) {
			if ($i > 0) echo $between;
			echo $parent->getTitle();
			$i++;
		}
		echo $after;
	}
}

/**
 * Prints the clickable drop down toolbox on any theme page with generic admin helpers
 * @param string $id the html/css theming id
 */
function printAdminToolboxCustom($id='admin') {
	global $_zp_current_album, $_zp_current_image, $_zp_current_search, $_zp_gallery_page, $_zp_gallery;
	if (zp_loggedin()) {
		$protocol = SERVER_PROTOCOL;
		if ($protocol == 'https_admin') {
			$protocol = 'https';
		}
		$zf = $protocol.'://'.$_SERVER['HTTP_HOST'].WEBPATH."/".ZENFOLDER;
		$dataid = $id . '_data';
		$page = getCurrentPage();
		$redirect = '';
		?>
		<script type="text/javascript">
			// <!-- <![CDATA[
			function newAlbum(folder,albumtab) {
				var album = prompt('<?php echo gettext('New album name?'); ?>', '<?php echo gettext('new album'); ?>');
				if (album) {
					launchScript('<?php echo $zf; ?>/admin-edit.php',['action=newalbum','album='+encodeURIComponent(folder),'name='+encodeURIComponent(album),'albumtab='+albumtab,'XSRFToken=<?php echo getXSRFToken('newalbum'); ?>']);
				}
			}
			// ]]> -->
		</script>
		<?php

		// open the list--all links go between here and the close of the list below
		

		// generic link to Admin.php
		echo "<li>";
		printLink($zf . '/admin.php', gettext("Admin"), NULL, NULL, NULL);
		
				// setup for return links
		if (isset($_GET['p'])) {
			$redirect = "&amp;p=" . urlencode(sanitize($_GET['p']));
		}
		if ($page>1) {
			$redirect .= "&amp;page=$page";
		}
		echo "<ul style='list-style-type: none;'>";
		if (zp_loggedin(OPTIONS_RIGHTS)) {
			// options link for all admins with options rights
			echo "<li>";
			printLink($zf . '/admin-options.php?tab=general', gettext("Options"), NULL, NULL, NULL);
			echo "</li>\n";
		}
		zp_apply_filter('admin_toolbox_global');

		$gal = getOption('custom_index_page');
		if (empty($gal) || !file_exists(SERVERPATH.'/'.THEMEFOLDER.'/'.$_zp_gallery->getCurrentTheme().'/'.internalToFilesystem($gal).'.php')) {
			$gal = 'index.php';
		} else {
			$gal .= '.php';
		}
		if ($_zp_gallery_page === $gal) {
			// script is either index.php or the gallery index page
			if (zp_loggedin(ALBUM_RIGHTS)) {
				// admin has edit rights so he can sort the gallery (at least those albums he is assigned)
				?>
				<li><?php printLink($zf . '/admin-edit.php?page=edit', gettext("Sort Gallery"), NULL, NULL, NULL); ?>
				</li>
				<?php
			}
			if (zp_loggedin(UPLOAD_RIGHTS)) {
				// admin has upload rights, provide an upload link for a new album
				if (GALLERY_SESSION) { // XSRF defense requires sessions
					?>
					<li><a href="javascript:newAlbum('',true);"><?php echo gettext("New Album"); ?></a></li>
					<?php
				}
			}
			zp_apply_filter('admin_toolbox_gallery');
		} else if ($_zp_gallery_page === 'album.php') {
			// script is album.php
			$albumname = $_zp_current_album->name;
			if ($_zp_current_album->isMyItem(ALBUM_RIGHTS)) {
				// admin is empowered to edit this album--show an edit link
				echo "<li>";
				printLink($zf . '/admin-edit.php?page=edit&album=' . pathurlencode($_zp_current_album->name), gettext('Edit album'), NULL, NULL, NULL);
				echo "</li>\n";
				if (!$_zp_current_album->isDynamic()) {
					if ($_zp_current_album->getNumAlbums()) {
						?>
						<li><?php printLink($zf . '/admin-edit.php?page=edit&album=' . pathurlencode($albumname).'&tab=subalbuminfo', gettext("Sort subalbums"), NULL, NULL, NULL); ?>
						</li>
						<?php
					}
					if ($_zp_current_album->getNumImages()>0) {
						?>
						<li><?php printLink($zf . '/admin-albumsort.php?page=edit&album=' . pathurlencode($albumname).'&tab=sort', gettext("Sort album images"), NULL, NULL, NULL); ?>
						</li>
						<?php
					}
				}
				// and a delete link
				if (GALLERY_SESSION) { // XSRF defense requires sessions
					?>
					<li><a
						href="javascript:confirmDeleteAlbum('<?php echo $zf; ?>/admin-edit.php?page=edit&amp;action=deletealbum&amp;album=<?php echo urlencode(pathurlencode($albumname)) ?>&amp;XSRFToken=<?php echo getXSRFToken('delete'); ?>');"
						title="<?php echo gettext('Delete the album'); ?>"><?php echo gettext('Delete album'); ?></a>
					</li>
					<?php
				}
			}
			if ($_zp_current_album->isMyItem(UPLOAD_RIGHTS) && !$_zp_current_album->isDynamic()) {
				// provide an album upload link if the admin has upload rights for this album and it is not a dynamic album
				?>
				<li><?php printLink($zf . '/admin-upload.php?album=' . pathurlencode($albumname), gettext("Upload Here"), NULL, NULL, NULL); ?>
				</li>
				<?php
				if (GALLERY_SESSION) { // XSRF defense requires sessions
					?>
					<li><a
						href="javascript:newAlbum('<?php echo pathurlencode($albumname); ?>',true);"><?php echo gettext("New Album Here"); ?></a>
					</li>
					<?php
				}
			}
			// set the return to this album/page
			zp_apply_filter('admin_toolbox_album', $albumname);
			$redirect = "&amp;album=".pathurlencode($albumname);
			if ($page > 1) {
				$redirect .= "&amp;page=$page";
			}

		} else if ($_zp_gallery_page === 'image.php') {
			// script is image.php
			if (!$_zp_current_album->isDynamic()) { // don't provide links when it is a dynamic album
				$albumname = $_zp_current_album->name;
				$imagename = $_zp_current_image->filename;
				if ($_zp_current_album->isMyItem(ALBUM_RIGHTS)) {
					// if admin has edit rights on this album, provide a delete link for the image.
					if (GALLERY_SESSION) { // XSRF defense requires sessions
						?>
						<li><a href="javascript:confirmDelete('<?php echo $zf; ?>/admin-edit.php?page=edit&amp;action=deleteimage&amp;album=<?php  echo urlencode(pathurlencode($albumname)); ?>&amp;image=<?php  echo urlencode($imagename); ?>&amp;XSRFToken=<?php echo getXSRFToken('delete'); ?>',deleteImage);"
										title="<?php echo gettext("Delete the image"); ?>"><?php  echo gettext("Delete image"); ?></a></li>
						<?php
					}
					?>
					<li><a href="<?php  echo $zf; ?>/admin-edit.php?page=edit&amp;album=<?php  echo pathurlencode($albumname); ?>&amp;image=<?php  echo urlencode($imagename); ?>&amp;tab=imageinfo#IT"
						title="<?php  echo gettext('Edit this image'); ?>"><?php  echo gettext('Edit image'); ?></a></li>
					<?php
				}
				// set return to this image page
				zp_apply_filter('admin_toolbox_image', $albumname, $imagename);
				$redirect = "&amp;album=".pathurlencode($albumname)."&amp;image=".urlencode($imagename);
			}
		} else if (($_zp_gallery_page === 'search.php') && !empty($_zp_current_search->words)) {
			// script is search.php with a search string
			if (zp_loggedin(UPLOAD_RIGHTS)) {
				// if admin has edit rights allow him to create a dynamic album from the search
				echo "<li><a href=\"".$zf."/admin-dynamic-album.php\" title=\"".gettext("Create an album from the search")."\">".gettext("Create Album")."</a></li>";
			}
			zp_apply_filter('admin_toolbox_search');
			$redirect = "&amp;p=search" . $_zp_current_search->getSearchParams() . "&amp;page=$page";
		}

		// zenpage script pages
		if(function_exists('is_NewsArticle')) {
			if (is_NewsArticle()) {
				// page is a NewsArticle--provide zenpage edit, delete, and Add links
				$titlelink = getNewsTitlelink();
				$redirect .= '&amp;title='.urlencode($titlelink);
			}
			if (is_Pages()) {
				// page is zenpage page--provide edit, delete, and add links
				$titlelink = getPageTitlelink();
				$redirect .= '&amp;title='.urlencode($titlelink);
			}
			if (zp_loggedin(ZENPAGE_NEWS_RIGHTS)) {
				// admin has zenpage rights, provide link to the Zenpage admin tab
				echo "<li><a href=\"".$zf.'/'.PLUGIN_FOLDER."/zenpage/admin-news-articles.php\">".gettext("News")."</a></li>";
				if (is_NewsArticle()) {
					// page is a NewsArticle--provide zenpage edit, delete, and Add links
					echo "<li><a href=\"".$zf.'/'.PLUGIN_FOLDER."/zenpage/admin-edit.php?newsarticle&amp;edit&amp;titlelink=".urlencode($titlelink)."\">".gettext("Edit Article")."</a></li>";
					if (GALLERY_SESSION) { // XSRF defense requires sessions
						?>
						<li><a href="javascript:confirmDelete('<?php echo $zf.'/'.PLUGIN_FOLDER; ?>/zenpage/admin-news-articles.php?del=<?php echo getNewsID(); ?>&amp;XSRFToken=<?php echo getXSRFToken('delete'); ?>',deleteArticle)"
							title="<?php echo gettext("Delete article"); ?>"><?php echo gettext("Delete Article"); ?></a></li>
						<?php
					}
					echo "<li><a href=\"".$zf.'/'.PLUGIN_FOLDER."/zenpage/admin-edit.php?newsarticle&amp;add\">".gettext("Add Article")."</a></li>";
					zp_apply_filter('admin_toolbox_news', $titlelink);
				}
			}
			if (zp_loggedin(ZENPAGE_PAGES_RIGHTS)) {
				echo "<li><a href=\"".$zf.'/'.PLUGIN_FOLDER."/zenpage/admin-pages.php\">".gettext("Pages")."</a></li>";
				if (is_Pages()) {
					// page is zenpage page--provide edit, delete, and add links
					echo "<li><a href=\"".$zf.'/'.PLUGIN_FOLDER."/zenpage/admin-edit.php?page&amp;edit&amp;titlelink=".urlencode($titlelink)."\">".gettext("Edit Page")."</a></li>";
					if (GALLERY_SESSION) { // XSRF defense requires sessions
						?>
						<li><a href="javascript:confirmDelete('<?php echo $zf.'/'.PLUGIN_FOLDER; ?>/zenpage/page-admin.php?del=<?php echo getPageID(); ?>&amp;XSRFToken=<?php echo getXSRFToken('delete'); ?>',deletePage)"
							title="<?php echo gettext("Delete page"); ?>"><?php echo gettext("Delete Page"); ?></a></li>
						<?php
					}
					echo "<li><a href=\"".FULLWEBPATH."/".ZENFOLDER.'/'.PLUGIN_FOLDER."/zenpage/admin-edit.php?page&amp;add\">".gettext("Add Page")."</a></li>";
					zp_apply_filter('admin_toolbox_page', $titlelink);
				}
			}
		}

		// logout link
		$sec = (int) ((SERVER_PROTOCOL=='https') & true);
		$link = FULLWEBPATH.'?logout='.$sec.$redirect;
		?>
		<li><a href="<?php echo $link; ?>"><?php echo gettext("Logout"); ?></a></li>
		<?php
		// close the list
		echo "</ul>\n";
		echo "</li>\n";
	}
}

/**Reason for custom: add <a> around year text for drop down to work.
 * Prints a compendum of dates and links to a search page that will show results of the date
 *
 * @param string $class optional class
 * @param string $yearid optional class for "year"
 * @param string $monthid optional class for "month"
 * @param string $order set to 'desc' for the list to be in descending order
 */
function printAllDatesCustom($class='archive', $yearid='year', $monthid='month', $order='asc') {
	global $_zp_current_search,$_zp_gallery_page;
	if (empty($class)){
		$classactive = 'archive_active';
	} else {
		$classactive = $class.'_active';
		$class = "class=\"$class\"";
	}
	if ($_zp_gallery_page  == 'search.php') {
		$activedate = getSearchDate('%Y-%m');
	} else {
		$activedate = '';
	}
	if (!empty($yearid)){ $yearid = "class=\"$yearid\""; }
	if (!empty($monthid)){ $monthid = "class=\"$monthid\""; }
	$datecount = getAllDates($order);
	$lastyear = "";
	echo "\n<ul $class>\n";
	$nr = 0;
	while (list($key, $val) = each($datecount)) {
		$nr++;
		if ($key == '0000-00-01') {
			$year = "no date";
			$month = "";
		} else {
			$dt = strftime('%Y-%B', strtotime($key));
			$year = substr($dt, 0, 4);
			$month = substr($dt, 5);
		}

		if ($lastyear != $year) {
			$lastyear = $year;
			if($nr != 1) {  echo "</ul>\n</li>\n";}
			echo "<li $yearid><a class=\"placeholder\">$year</a>\n<ul $monthid>\n"; //added anchor here
		}
		if (is_object($_zp_current_search)) {
			$albumlist = $_zp_current_search->album_list;
		} else {
			$albumlist = NULL;
		}
		$datekey = substr($key, 0, 7);
		if ($activedate = $datekey) {
			$cl = ' class="'.$classactive.'"';
		} else {
			$cl = '';
		}
		echo "<li".$cl."><a href=\"".html_encode(getSearchURl('', $datekey, '', 0, array('allbums'=>$albumlist)))."\" rel=\"nofollow\">$month ($val)</a></li>\n";
	}
	echo "</ul>\n</li>\n</ul>\n";
}

/**Reason for custom: add <a> around year text for drop down to work.
 * Prints the monthy news archives sorted by year
 * NOTE: This does only include news articles.
 *
 * @param string $class optional class
 * @param string $yearclass optional class for "year"
 * @param string $monthclass optional class for "month"
 * @param string $activeclass optional class for the currently active archive
 * @param bool $yearsonly If set to true the archive only shows the years with total count (Default false)
 */
function printNewsArchiveCustom($class='archive', $yearclass='year', $monthclass='month', $activeclass="archive-active",$yearsonly=false) {
	global $_zp_zenpage;
	if (!empty($class)){ $class = "class=\"$class\""; }
	if (!empty($yearclass)){ $yearclass = "class=\"$yearclass\""; }
	if (!empty($monthclass)){ $monthclass = "class=\"$monthclass\""; }
	if (!empty($activeclass)){ $activeclass = "class=\"$activeclass\""; }
	$datecount = $_zp_zenpage->getAllArticleDates($yearsonly);
	$lastyear = "";
	$nr = "";
	echo "\n<ul $class>\n";
	while (list($key, $val) = each($datecount)) {
		$nr++;
		if ($key == '0000-00-01') {
			$year = "no date";
			$month = "";
		} else {
			$dt = strftime('%Y-%B', strtotime($key));
			$year = substr($dt, 0, 4);
			$month = substr($dt, 5);
		}
		if ($lastyear != $year) {
			$lastyear = $year;
			if(!$yearsonly) {
				if($nr != 1) { echo "</ul>\n</li>\n";}
				echo "<li $yearclass><a class=\"placeholder\">$year</a>\n<ul $monthclass>\n"; //added anchor here
			}
		}
		if($yearsonly) {
			$datetosearch = $key;
		} else {
			$datetosearch = strftime('%Y-%B', strtotime($key));
		}
		if(getCurrentNewsArchive('plain') == $datetosearch) {
			$active = $activeclass;
		} else {
			$active = "";
		}
		if($yearsonly) {
			echo "<li $active><a href=\"".html_encode(getNewsBaseURL().getNewsArchivePath()).$key."\" title=\"".$key." (".$val.")\" rel=\"nofollow\">$key ($val)</a></li>\n";
		} else {
			echo "<li $active><a href=\"".html_encode(getNewsBaseURL().getNewsArchivePath()).substr($key,0,7)."\" title=\"".$month." (".$val.")\" rel=\"nofollow\">$month ($val)</a></li>\n";
		}
	}
	if($yearsonly) {
		echo "</ul>\n";
	} else {
		echo "</ul>\n</li>\n</ul>\n";
	}
}
/**
 * Puts up random image thumbs from the gallery
 *
 * @param int $number how many images
 * @param string $class optional class
 * @param string $option what you want selected: all for all images, album for selected ones from an album
 * @param string $rootAlbum optional album from which to get the images
 * @param integer $width the width/cropwidth of the thumb if crop=true else $width is longest size.
 * @param integer $height the height/cropheight of the thumb if crop=true else not used
 * @param bool $crop 'true' (default) if the thumb should be cropped, 'false' if not
 */
function printRandomImagesCustom($number=5, $class=null, $option='all', $rootAlbum='',$width=100,$height=100,$crop=true) {
	if (!is_null($class)) {
		$class = ' class="' . $class . '"';
	}
	for ($i=1; $i<=$number; $i++) {
		switch($option) {
			case "all":
				$randomImage = getRandomImages();
				break;
			case "album":
				$randomImage = getRandomImagesAlbum($rootAlbum);
				break;
		}
		if (is_object($randomImage) && $randomImage->exists) {
			$randomImageURL = html_encode(getURL($randomImage));
			echo '<a href="' . $randomImageURL . '" title="'.sprintf(gettext('View image: %s'), html_encode($randomImage->getTitle())) . '">';
			if($crop) {
				$html = "<img src=\"".html_encode($randomImage->getCustomImage(NULL, $width, $height, $width, $height, NULL, NULL, TRUE))."\" alt=\"" . html_encode($randomImage->getTitle()) . "\" />\n";
			} else {
				$html =  "<img src=\"".html_encode($randomImage->getCustomImage($width, NULL, NULL, NULL, NULL, NULL, NULL, TRUE))."\" alt=\"" . html_encode($randomImage->getTitle()) . "\" />\n";
			}
			echo zp_apply_filter('custom_image_html', $html, false);
			echo "<span id=\"random-title\">";
			if ((in_context(ZP_ALBUM)) || (in_context(ZP_IMAGE))) {
				echo gettext('Random Album Image');
				} else { 
				echo gettext('Random Gallery Image');
				}
			echo "</span>";
			echo "</a>";
		}
	}
}

/**
 * Prints jQuery JS to enable the toggling of search results of Zenpage  items
 *
 */
function printZDSearchToggleJS() { ?>
	<script type="text/javascript">
	function toggleExtraElements(category, show) {
		if (show) {
			jQuery('.'+category+'_showless').show();
			jQuery('.'+category+'_showmore').hide();
			jQuery('.'+category+'_extrashow').show();
		} else {
			jQuery('.'+category+'_showless').hide();
			jQuery('.'+category+'_showmore').show();
			jQuery('.'+category+'_extrashow').hide();
		}
	}
	</script>
<?php
}

/**
 * Prints the "Show more results link" for search results for Zenpage items
 *
 * @param string $option "news" or "pages"
 * @param int $number_to_show how many search results should be shown initially
 */
function printZDSearchShowMoreLink($option,$number_to_show) {
	$option = strtolower(sanitize($option));
	$number_to_show = sanitize_numeric($number_to_show);
	switch($option) {
		case "news":
			$num = getNumNews();
			break;
		case "pages":
			$num = getNumPages();
			break;
	}
	if ($num > $number_to_show) {
		?>
<a class="<?php echo $option; ?>_showmore"href="javascript:toggleExtraElements('<?php echo $option;?>',true);"><?php echo gettext('Show more results');?></a>
<a class="<?php echo $option; ?>_showless" style="display: none;"	href="javascript:toggleExtraElements('<?php echo $option;?>',false);"><?php echo gettext('Show fewer results');?></a>
		<?php
	}
}


/**
 * Adds the css class necessary for toggling of Zenpage items search results
 *
 * @param string $option "news" or "pages"
 * @param string $c After which result item the toggling should begin. Here to be passed from the results loop.
 */
function printZDToggleClass($option,$c,$number_to_show) {
	$option = strtolower(sanitize($option));
	$c = sanitize_numeric($c);
	$number_to_show = sanitize_numeric($number_to_show);
	if ($c > $number_to_show) { 
		echo ' class="'.$option.'_extrashow" style="display:none;"'; 
	}
}




/**
 * Prints a list of all albums context sensitive.
 * Since 1.4.3 this is a wrapper function for the separate functions printAlbumMenuList() and printAlbumMenuJump().
 * that was included to remain compatiblility with older installs of this menu.
 *
 * Usage: add the following to the php page where you wish to use these menus:
 * enable this extension on the zenphoto admin plugins tab.
 * Call the function printAlbumMenu() at the point where you want the menu to appear.
 *
 * @param string $option 
 * * 								"list" for html list, 
 * 									"list-top" for only the top level albums, 
 * 									"omit-top" same as list, but the first level of albums is omitted
 * 									"list-sub" lists the offspring level of subalbums for the current album
 * 									"jump" dropdown menu of all albums(not context sensitive)
 * 
 * @param string $option2 "count" for a image counter or subalbum count in brackets behind the album name, "" = for no image numbers or leave blank
 * @param string $css_id insert css id for the main album list, leave blank if you don't use (only list mode)
 * @param string $css_class_topactive insert css class for the active link in the main album list (only list mode)
 * @param string $css_class insert css class for the sub album lists (only list mode)
 * @param string $css_class_active insert css class for the active link in the sub album lists (only list mode)
 * @param string $indexname insert the name how you want to call the link to the gallery index (insert "" if you don't use it, it is not printed then)
 * @param int $showsubs Set to depth of sublevels that should be shown always. 0 by default. To show all, set to a true! Only valid if option=="list".
  * @return html list or drop down jump menu of the albums
 * @since 1.2
 */

function printAlbumMenuCustom($option,$option2='',$css_id='',$css_class_topactive='',$css_class='',$css_class_active='', $indexname="Gallery Index", $showsubs=false) {
	if ($option == "jump") {
		printAlbumMenuJumpCustom($option,$indexname);
	} else {
		printAlbumMenuListCustom($option,$option2,$css_id,$css_class_topactive,$css_class,$css_class_active, $indexname, $showsubs);
	}
}

/**
 * Prints a nested html list of all albums context sensitive.
 *
 * Usage: add the following to the php page where you wish to use these menus:
 * enable this extension on the zenphoto admin plugins tab;
 * Call the function printAlbumMenuList() at the point where you want the menu to appear.
 *
 * @param string $option 
 * 									"list" for html list, 
 * 									"list-top" for only the top level albums, 
 * 									"omit-top" same as list, but the first level of albums is omitted
 * 									"list-sub" lists the offspring level of subalbums for the current album
 * @param string $option2 "count" for a image counter in brackets behind the album name, "" = for no image numbers or leave blank
 * @param string $css_id insert css id for the main album list, leave blank if you don't use (only list mode)
 * @param string $css_id_active insert css class for the active link in the main album list (only list mode)
 * @param string $css_class insert css class for the sub album lists (only list mode)
 * @param string $css_class_active insert css class for the active link in the sub album lists (only list mode)
 * @param string $indexname insert the name (default "Gallery Index") how you want to call the link to the gallery index, insert "" if you don't use it, it is not printed then.
 * @param int $showsubs Set to depth of sublevels that should be shown always. 0 by default. To show all, set to a true! Only valid if option=="list".
 * @return html list of the albums
 */

function printAlbumMenuListCustom($option,$option2,$css_id='',$css_class_topactive='',$css_class='',$css_class_active='', $indexname="Gallery Index", $showsubs=false) {
	global $_zp_gallery, $_zp_current_album, $_zp_gallery_page;
	
	// if in search mode don't use the foldout contextsensitiveness and show only toplevel albums
	if(in_context(ZP_SEARCH_LINKED)) {
		$option = "list-top";
	}

	$albumpath = rewrite_path("/", "/index.php?album=");
	if(empty($_zp_current_album) || ($_zp_gallery_page != 'album.php' && $_zp_gallery_page != 'image.php')) {
		$currentfolder = "";
	} else {
		$currentfolder = $_zp_current_album->name;
	}

	// check if css parameters are used
	if ($css_id != "") { $css_id = " id='".$css_id."'"; }
	if ($css_class_topactive != "") { $css_class_topactive = " class='".$css_class_topactive."'"; }
	if ($css_class != "") { $css_class = " class='".$css_class."'"; }
	if ($css_class_active != "") { $css_class_active = " class='".$css_class_active."'"; }
	
	echo "<ul".$css_id.">\n"; // top level list
	/**** Top level start with Index link  ****/
	if($option === "list" OR $option === "list-top") {
		if(!empty($indexname)) {
			echo "<li><a href='".htmlspecialchars(getGalleryIndexURL())."' title='".html_encode($indexname)."'>".$indexname."</a></li>";
		}
	}

	if ($option == 'list-sub' && in_context(ZP_ALBUM)) {
		$albums = $_zp_current_album->getAlbums();
	} else {
		$albums = $_zp_gallery->getAlbums();
	}

	printAlbumMenuListAlbumCustom($albums, $albumpath, $currentfolder, $option, $option2, $showsubs, $css_class, $css_class_topactive, $css_class_active);

	echo "</ul>\n";

}


/**
 * Handles an album for printAlbumMenuList
 *
 * @param array $albums albums array
 * @param string $path for createAlbumMenuLink
 * @param string $folder 
 * @param string $option see printAlbumMenuList
 * @param string $option2 see printAlbumMenuList
 * @param int $showsubs see printAlbumMenuList
 * @param string $css_class see printAlbumMenuList
 * @param string $css_class_topactive see printAlbumMenuList
 * @param string $css_class_active see printAlbumMenuList
 */
function printAlbumMenuListAlbumCustom($albums, $path, $folder, $option, $option2, $showsubs, $css_class, $css_class_topactive, $css_class_active) {
	global $_zp_gallery;
	if ($showsubs === true) $showsubs = 9999999999;
	$pagelevel = count(explode('/', $folder));
	foreach ($albums as $album) {
		$level = count(explode('/', $album));
		$process =  (($level < $showsubs && $option == "list") // user wants all the pages whose level is <= to the parameter
									|| ($option != 'list-top' // not top only
											&& strpos($folder, $album) === 0 // within the family
											&& $level<=$pagelevel) // but not too deep
								);

		$topalbum = new Album($_zp_gallery,$album,true);
		if ($level>1
				|| ($option != 'omit-top') 
				) { // listing current level album
			if ($level==1) {
				$css_class_t = $css_class_topactive;
			} else {
				$css_class_t = $css_class_active;
			}
			$count = "";
			if($option2 == 'count') {
				if($topalbum->getNumImages() > 0) {
					$topalbumnumimages = $topalbum->getNumImages();
					//$count = sprintf(ngettext(' (%u image)', ' (%u images)',$topalbumnumimages),$topalbumnumimages);
					$count = "(".$topalbumnumimages.")";
				}
				//$toplevelsubalbums = $topalbum->getAlbums();
				//$toplevelsubalbums = count($toplevelsubalbums);
				//if($toplevelsubalbums > 0) {
				//	$count .= "<small>".sprintf(ngettext(' (%u album)', ' (%u albums)',$toplevelsubalbums),$toplevelsubalbums)."</small>";
				//}
			}
			
			if(in_context(ZP_ALBUM) && !in_context(ZP_SEARCH_LINKED) && getAlbumID() == $topalbum->getAlbumID()) {
				//$link = "<li".$css_class_t.">".$topalbum->getTitle().$count;
				$link = "<li".$css_class_t."><a href='".htmlspecialchars($path.pathurlencode($topalbum->name))."' title='".html_encode($topalbum->getTitle())."'>".html_encode($topalbum->getTitle())." ".$count."</a>";
			} else {
				$link = "<li><a href='".htmlspecialchars($path.pathurlencode($topalbum->name))."' title='".html_encode($topalbum->getTitle())."'>".html_encode($topalbum->getTitle())." ".$count."</a>";
			}
			echo $link;
		}
		if ($process) { // listing subalbums
			$subalbums = $topalbum->getAlbums();
			if (!empty($subalbums)) {

				echo "\n<ul".$css_class.">\n";
				printAlbumMenuListAlbumCustom($subalbums, $path, $folder, $option, $option2, $showsubs, $css_class, $css_class_topactive, $css_class_active);
				echo "\n</ul>\n";

			}
		}
		if($option == 'list' || $option == 'list-top' || $level>1) { // close the LI
			echo "\n</li>\n";
		}

	}
}





function printLatestNewsCustom($number=5,$option='with_latest_images', $category='', $showdate=true, $showcontent=true, $contentlength=70, $showcat=true){
	global $_zp_gallery, $_zp_current_zenpage_news;
	//trigger_error(gettext('printLatestNews is deprecated. Use printLatestCombiNews().'), E_USER_NOTICE);
	$latest = getLatestNews($number,$option,$category);
	echo "\n<div id=\"latestnews-spotlight\">\n";
	$count = "";
	foreach($latest as $item) {
		$count++;
		$category = "";
		$categories = "";
		
		$obj = new ZenpageNews($item['titlelink']);
		$title = htmlspecialchars($obj->getTitle());
		$link = getNewsURL($item['titlelink']);
		$count2 = 0;
		$category = $obj->getCategories();
		foreach($category as $cat){
					$catobj = new ZenpageCategory($cat['titlelink']);
					$count2++;
					if($count2 != 1) {
						$categories = $categories.", ";
					}
					$categories = $categories.$catobj->getTitle();
				}
		$content = strip_tags($obj->getContent());
		$date = zpFormattedDate(getOption('date_format'),strtotime($item['date']));
		$type = 'news';
				
		echo "<div>";
	
		echo "<h3><a href=\"".$link."\" title=\"".strip_tags(htmlspecialchars($title,ENT_QUOTES))."\">".htmlspecialchars($title)."</a></h3>\n";;
		echo "<div class=\"newsarticlecredit\">\n";
		echo "<span class=\"latestnews-date\">". $date."</p>\n";
		echo "<span class=\"latestnews-cats\">, Posted in ".$categories."</span>\n";
		echo "</div>\n";
		echo "<p class=\"latestnews-desc\">".html_encode(getContentShorten($content,$contentlength,'(...)',null,null))."</p>\n";
		echo "</div>\n";
		if($count == $number) {
			break;
		}
	}
	echo "</div>\n";
}

?>
