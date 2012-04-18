<?php if (!defined('WEBPATH')) die(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	<?php 
	echo getBareGalleryTitle();
	if ($_zp_gallery_page == 'album.php') {echo " | ".printTitleBreadcrumb().getBareAlbumTitle();}
	if ($_zp_gallery_page == 'image.php') {echo " | ".printTitleBreadcrumb().getBareAlbumTitle()." | ".getBareImageTitle(); }
	if ($_zp_gallery_page == 'contact.php') {echo " | ".gettext('Contact');}
	if ($_zp_gallery_page == 'pages.php') {echo " | ".getBarePageTitle();} 
	if ($_zp_gallery_page == 'news.php'){echo " | ".gettext('News');}
	if (function_exists("getBarePageTitle")) {
		if (is_NewsArticle()) {echo " | ".getBareNewsTitle();} 
	}
	if ($_zp_gallery_page == 'search.php'){echo " | ".gettext('Search');}
	if ($_zp_gallery_page == 'register.php'){echo " | ".gettext('Register');}
	if ($_zp_gallery_page == 'password.php'){echo " | ".gettext('Password Required');}
	?>	
</title>
<!-- RSS HEADER LINKS -->
<?php printRSSHeaderLink( "Gallery",gettext('Gallery RSS') ); ?>
<?php if (in_context(ZP_ALBUM)) { printRSSHeaderLink( "Collection",gettext('This Album Collection') ); } ?> 
<?php if (function_exists("getBarePageTitle")) { printZenpageRSSHeaderLink("News","", gettext('News RSS'), ""); } ?>	
<?php require_once(ZENFOLDER."/zp-extensions/print_album_menu.php"); ?>
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $_zp_themeroot; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $_zp_themeroot; ?>/css/print.css" media="print" />
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo $_zp_themeroot; ?>/css/ie6.css" />
<![endif]-->
<link rel="shortcut icon" href="<?php echo $_zp_themeroot; ?>/favicon.ico" /> 
<?php zp_apply_filter('theme_head'); ?>	
<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/js/superfish.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery('ul.sf-menu').superfish();
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#comment-toggle').click(function() {
		$('#comments-block').slideToggle(600);
		});
	});
</script>
	<?php if (($zpfocus_showrandom) == 'rotator') { ?>
	<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/zp-extensions/slideshow/jquery.cycle.all.js" type="text/javascript"></script>
	<?php } ?>
	<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/zp-extensions/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/cbStyles/<?php echo $zpfocus_cbstyle; ?>/colorbox.css" type="text/css" media="screen"/>
	<script type="text/javascript">
		$(document).ready(function(){
			$("a[rel='zoom']").colorbox({
				slideshow:false,
				slideshowStart:'<?php echo gettext('start slideshow'); ?>',
				slideshowStop:'<?php echo gettext('stop slideshow'); ?>',
				current:'<?php echo gettext('image {current} of {total}'); ?>',	// Text format for the content group / gallery count. {current} and {total} are detected and replaced with actual numbers while ColorBox runs.
				previous:'<?php echo gettext('previous'); ?>',
				next:'<?php echo gettext('next'); ?>',
				close:'<?php echo gettext('close'); ?>',
				transition:'<?php echo $zpfocus_cbtransition; ?>',
				maxHeight:'90%',
				photo:true,
				maxWidth:'90%'
			});
			$("a[rel='slideshow']").colorbox({
				slideshow:true,
				slideshowSpeed:<?php echo $zpfocus_cbssspeed; ?>,
				slideshowStart:'<?php echo gettext('start slideshow'); ?>',
				slideshowStop:'<?php echo gettext('stop slideshow'); ?>',
				current:'<?php echo gettext('image {current} of {total}'); ?>',	// Text format for the content group / gallery count. {current} and {total} are detected and replaced with actual numbers while ColorBox runs.
				previous:'<?php echo gettext('previous'); ?>',
				next:'<?php echo gettext('next'); ?>',
				close:'<?php echo gettext('close'); ?>',
				transition:'<?php echo $zpfocus_cbtransition; ?>',
				maxHeight:'90%',
				photo:true,
				maxWidth:'90%'
			});
			$(".inline").colorbox({width:"400px", inline:true, href:"#exif"});
			$(".cbLogin").colorbox({inline:true, href:"#cbLogin"});
			<?php if (($zpfocus_showrandom) == 'rotator') { ?>
			$('#random-wrap').cycle({
				fx: '<?php echo $zpfocus_rotatoreffect; ?>',
				timeout: <?php echo $zpfocus_rotatorspeed; ?>,
				pause: 1
			});
			
			<?php } ?>
			$('#random-wrap').css('display', 'block');
			
		});
	</script>
	
	<?php if ($_zp_gallery_page == 'search.php') { printZDSearchToggleJS(); } ?>
</head>
<body>
	<?php zp_apply_filter('theme_body_open'); ?>
	<div id="nav">
		<div id="nav-wrap">
			<ul class="sf-menu">
				<li class="nav-first"><a href="<?php echo getGalleryIndexURL(false);?>"><?php echo gettext('Home'); ?></a></li>
				<?php if (($zpfocus_menutype) == 'dropdown') { ?>
				<?php if (($zpfocus_homepage) == 'none') { ?>
				<li><a class="placeholder"><?php echo gettext('Gallery'); ?></a>
				<?php } else { ?>
				<li><?php printCustomPageURL(gettext('Gallery'),"gallery"); ?>
				<?php } ?>
					<?php if ($zpfocus_show_stats_inmenu) { $showcount = "count"; } else { $showcount = ""; } ?>
					<?php printAlbumMenuListCustom('list',$showcount,'','active','','active',"",true); ?>
					
				</li>
				<?php } ?>
				<?php if(function_exists("printNestedMenu")) { ?>
				<li><a class="placeholder"><?php echo gettext('Pages'); ?></a>
					<?php printNestedMenu('list','pages',false,null,'active',null,'active',null,true,true,30); ?>
				</li>
				<li><a href="<?php echo getNewsIndexURL(); ?>"><?php echo gettext('News'); ?></a>
					<?php printNestedMenu('list','categories',true,null,'active',null,'active',null,true,true,30); ?>
				</li>
				<?php } ?>
				<?php if (function_exists('printContactForm')) { ?>
				<li><?php printCustomPageURL(gettext('Contact'),"contact"); ?></li>
				<?php } ?>
				
				<?php if ($zpfocus_show_archive) { ?>
				<li><a class="placeholder"><?php echo gettext('Archive'); ?></a>
					<?php if (function_exists('printNewsArchive')) { ?>
					<ul>
						<li><a class="placeholder"><?php echo gettext('Gallery'); ?></a>
							<?php printAllDatesCustom(); ?>
						</li>
						<li><a class="placeholder"><?php echo gettext('News'); ?></a>
							<?php printNewsArchiveCustom(); ?>
						</li>
					</ul>
					<?php } else { 
					printAllDatesCustom(); 
					} ?>
				</li>
				<?php } ?>
				
				<?php printAdminToolboxCustom(); ?>	
			</ul>
			<?php if ($zpfocus_allow_search) { ?>
			<div>
			<?php printSearchForm( '','searchform','',gettext('SEARCH'),"$_zp_themeroot/images/search-drop.jpg",null,null,"$_zp_themeroot/images/search-reset.jpg" ); ?>
			</div>
			<?php } ?>	
			<?php if (($zpfocus_menutype) == 'jump') { ?>
			<div id="jumpmenu">
			<?php printAlbumMenu('jump'); ?>
			</div>
			<?php } ?>		
		</div>
	</div>
	<div class="wrap">
	