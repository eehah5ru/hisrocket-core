<?php

/* Plug-in for theme option handling 
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 * 
 */

require_once(SERVERPATH . "/" . ZENFOLDER . "/admin-functions.php");

class ThemeOptions {
	
	function ThemeOptions() {
		setOptionDefault('zpfocus_tagline', 'A ZenPhoto / ZenPage Powered Theme');
		setOptionDefault('zpfocus_allow_search', true);
		setOptionDefault('zpfocus_show_archive', true);
		setOptionDefault('zpfocus_show_stats_inmenu', false);
		setOptionDefault('zpfocus_use_colorbox', true);
		setOptionDefault('zpfocus_use_colorbox_slideshow', true);
		setOptionDefault('zpfocus_homepage', 'none');
		setOptionDefault('zpfocus_spotlight', 'manual');
		setOptionDefault('zpfocus_spotlight_text', '<p>This is the <span class="spotlight-span">spotlight</span> area that can be set in the theme options.  You can either enter the text manually in the options or set it to display the latest news if ZenPage is being used. If you want nothing to appear here, set the spotlight to none.</p>');
		setOptionDefault('zpfocus_show_credit', false);
		setOptionDefault('zpfocus_menutype', 'dropdown');
		setOptionDefault('zpfocus_logotype', true);
		setOptionDefault('zpfocus_logofile', 'logo.jpg');
		setOptionDefault('zpfocus_showrandom', 'rotator');
		setOptionDefault('zpfocus_rotatoreffect', 'fade');
		setOptionDefault('zpfocus_rotatorspeed', '3000');
		setOptionDefault('zpfocus_cbtarget', true);
		setOptionDefault('zpfocus_cbstyle', 'style3');
		setOptionDefault('zpfocus_cbtransition', 'fade');
		setOptionDefault('zpfocus_cbssspeed', '2500');
		setOptionDefault('zpfocus_final_link', 'nolink');
	}
	
	
	function getOptionsSupported() {
		return array(	
						gettext('(2) Tagline') => array('key' => 'zpfocus_tagline', 'type' => OPTION_TYPE_TEXTBOX, 'multilingual' => 1, 'desc' => gettext('The text above the sitename on the home page.')),
						gettext('(1) Allow search') => array('key' => 'zpfocus_allow_search', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to enable search form.')),
						gettext('(4) Show Archive Link') => array('key' => 'zpfocus_show_archive', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Display a menu link drop down for the dated archive of images.')),
						gettext('(5) Show Image/Album Stats in Menu') => array('key' => 'zpfocus_show_stats_inmenu', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Show the numbers of Images/Albums in the gallery menu drop-down.')),					
						gettext('(11) Use Colorbox') => array('key' => 'zpfocus_use_colorbox', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to utilize the jQuery script colorbox to zoom images on the album page.')),
						gettext('(12) Use Colorbox Slideshow') => array('key' => 'zpfocus_use_colorbox_slideshow', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to utilize the jQuery script colorbox to display a slideshow on the album page.')),
						gettext('(8) Homepage') => array('key' => 'zpfocus_homepage', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext("Choose here any <em>unpublished Zenpage page</em> (listed by <em>titlelink</em>) to act as your site's homepage instead the normal gallery index.")),									
						gettext('(9) Spotlight') => array('key' => 'zpfocus_spotlight', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('Select what to use in the spotlight area. Latest News obviously requires ZenPage.')),
						gettext('(10) Spotlight Text') => array('key' => 'zpfocus_spotlight_text', 'type' => OPTION_TYPE_TEXTAREA, 'desc' => gettext('Enter "Spotlight Text" if option above for the spotlight area is set to manual.  If Latest News is selected above this text will NOT be displayed.')),
						gettext('(3) Album Menu Type') => array('key' => 'zpfocus_menutype', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('Choose whether to show a dropdown menu item in the main menu for all your albums or a jump menu next to the search input. For sites with a lot of albums, the jump menu is recommended.')),
						gettext('(17) Show ZenPhoto Credit') => array('key' => 'zpfocus_show_credit', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to display the Powered by ZenPhoto link in the footer.')),
						gettext('(6) Use Image as Logo?') => array('key' => 'zpfocus_logotype', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to use an image file instead of text as your logo.')),
						gettext('(7) Use Image as Logo Filename:') => array('key' => 'zpfocus_logofile', 'type' => OPTION_TYPE_TEXTBOX, 'multilingual' => 1, 'desc' => gettext('If checked above, enter full file name of logo file including file extension (image must be located within the images folder of the zpFocus theme folder).')),
						gettext('(13) Colorbox Style') => array('key' => 'zpfocus_cbstyle', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('Select the Colorbox style you wish to use (examples on the colorbox site).')),
						gettext('(14) Colorbox Transition Type') => array('key' => 'zpfocus_cbtransition', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('The colorbox transition type. Can be set to elastic, fade, or none.')),
						gettext('(15) Colorbox Slideshow Speed') => array('key' => 'zpfocus_cbssspeed', 'type' => OPTION_TYPE_TEXTBOX, 'multilingual' => 1, 'desc' => gettext('Enter a number here in milliseconds that determines the colorbox slideshow speed. Default is \'2500\'.')),
						gettext('(16) Colorbox Target Sized Image') => array('key' => 'zpfocus_cbtarget', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Click to enable colorbox targeting the sized image setting in the top options, instead of the full original image. This is usefull if you upload large images as you can set Colorbox to target a smaller, resized version based on your setting above.')),
						
						gettext('(18) Random Image Option?') => array('key' => 'zpfocus_showrandom', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('Choose how to display random image(s), top left. Or select none to not display.')),
						gettext('(18a) -> Rotator Transition Effect?') => array('key' => 'zpfocus_rotatoreffect', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('Choose the transition effect, if rotator is selected above.')),
						gettext('(18b) -> Rotator Speed?') => array('key' => 'zpfocus_rotatorspeed', 'type' => OPTION_TYPE_TEXTBOX, 'desc' => gettext('Choose the delay of each rotation in milliseconds.')),
						gettext('(19) Image Final Link Option') => array('key' => 'zpfocus_final_link', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('Select the final image link option as viewed on image.php.  Default is no link, but choose standard (or new to open in new window) if you want to take advantage of some of the core image link options (such as automatic download).'))
						
					);				
	}

	
	function handleOption($option, $currentValue) {
		
		if ($option == 'zpfocus_showrandom') {
			echo '<select style="width:200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			
			echo '<option value="single"';
				if ($currentValue == "single") { 
				echo ' selected="selected">Single Random</option>\n';
				} else {
				echo '>single</option>\n';
				}
			
			echo '<option value="rotator"';
				if ($currentValue == "rotator") { 
				echo ' selected="selected">rotator</option>\n';
				} else {
				echo '>rotator</option>\n';
				}
			
			echo '<option value="none"';
				if ($currentValue == "none") { 
				echo ' selected="selected">None</option>\n';
				} else {
				echo '>none</option>\n';
				}
				
			echo "</select>\n";
		}

		if ($option == 'zpfocus_rotatoreffect') {
			echo '<select style="width:200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			
			echo '<option value="fade"';
				if ($currentValue == "fade") { 
				echo ' selected="selected">Fade</option>\n';
				} else {
				echo '>Fade</option>\n';
				}
			echo '<option value="shuffle"';
				if ($currentValue == "shuffle") { 
				echo ' selected="selected">Shuffle</option>\n';
				} else {
				echo '>Shuffle</option>\n';
				}
			echo '<option value="scrollUp"';
				if ($currentValue == "scrollUp") { 
				echo ' selected="selected">Scroll Up</option>\n';
				} else {
				echo '>Scroll Up</option>\n';
				}
			echo '<option value="scrollDown"';
				if ($currentValue == "scrollDown") { 
				echo ' selected="selected">Scroll Down</option>\n';
				} else {
				echo '>Scroll Down</option>\n';
				}
			echo '<option value="scrollRight"';
				if ($currentValue == "scrollRight") { 
				echo ' selected="selected">Scroll Right</option>\n';
				} else {
				echo '>Scroll Right</option>\n';
				}
			echo '<option value="scrollLeft"';
				if ($currentValue == "scrollLeft") { 
				echo ' selected="selected">Scroll Left</option>\n';
				} else {
				echo '>Scroll Left</option>\n';
				}
			echo '<option value="scrollHorz"';
				if ($currentValue == "scrollHorz") { 
				echo ' selected="selected">Scroll Horizontal</option>\n';
				} else {
				echo '>Scroll Horizontal</option>\n';
				}			
			echo '<option value="scrollVert"';
				if ($currentValue == "scrollVert") { 
				echo ' selected="selected">Scroll Vertical</option>\n';
				} else {
				echo '>Scroll Vertical</option>\n';
				}
			echo '<option value="blindX"';
				if ($currentValue == "blindX") { 
				echo ' selected="selected">Blind X</option>\n';
				} else {
				echo '>Blind X</option>\n';
				}
			echo '<option value="blindY"';
				if ($currentValue == "blindY") { 
				echo ' selected="selected">Blind Y</option>\n';
				} else {
				echo '>Blind Y</option>\n';
				}
			echo '<option value="cover"';
				if ($currentValue == "cover") { 
				echo ' selected="selected">Cover</option>\n';
				} else {
				echo '>Cover</option>\n';
				}
			echo '<option value="curtainX"';
				if ($currentValue == "curtainX") { 
				echo ' selected="selected">Curtain X</option>\n';
				} else {
				echo '>Curtain X</option>\n';
				}
			echo '<option value="curtainY"';
				if ($currentValue == "curtainY") { 
				echo ' selected="selected">Curtain Y</option>\n';
				} else {
				echo '>Curtain Y</option>\n';
				}
			echo '<option value="fadeZoom"';
				if ($currentValue == "fadeZoom") { 
				echo ' selected="selected">Fade Zoom</option>\n';
				} else {
				echo '>Fade Zoom</option>\n';
				}
			echo '<option value="growX"';
				if ($currentValue == "growX") { 
				echo ' selected="selected">Grow X</option>\n';
				} else {
				echo '>Grow X</option>\n';
				}
			echo '<option value="growY"';
				if ($currentValue == "growY") { 
				echo ' selected="selected">Grow Y</option>\n';
				} else {
				echo '>Grow Y</option>\n';
				}
			echo '<option value="slideX"';
				if ($currentValue == "slideX") { 
				echo ' selected="selected">Slide X</option>\n';
				} else {
				echo '>Slide X</option>\n';
				}
			echo '<option value="slideY"';
				if ($currentValue == "slideY") { 
				echo ' selected="selected">Slide Y</option>\n';
				} else {
				echo '>Slide Y</option>\n';
				}
			echo '<option value="toss"';
				if ($currentValue == "toss") { 
				echo ' selected="selected">Toss</option>\n';
				} else {
				echo '>Toss</option>\n';
				}
			echo '<option value="turnUp"';
				if ($currentValue == "turnUp") { 
				echo ' selected="selected">Turn Up</option>\n';
				} else {
				echo '>Turn Up</option>\n';
				}
			echo '<option value="turnDown"';
				if ($currentValue == "turnDown") { 
				echo ' selected="selected">Turn Down</option>\n';
				} else {
				echo '>Turn Down</option>\n';
				}
			echo '<option value="turnRight"';
				if ($currentValue == "turnRight") { 
				echo ' selected="selected">Turn Right</option>\n';
				} else {
				echo '>Turn Right</option>\n';
				}
			echo '<option value="turnLeft"';
				if ($currentValue == "turnLeft") { 
				echo ' selected="selected">Turn Left</option>\n';
				} else {
				echo '>Turn Left</option>\n';
				}
			echo '<option value="uncover"';
				if ($currentValue == "uncover") { 
				echo ' selected="selected">Uncover</option>\n';
				} else {
				echo '>Uncover</option>\n';
				}
			echo '<option value="wipe"';
				if ($currentValue == "wipe") { 
				echo ' selected="selected">Wipe</option>\n';
				} else {
				echo '>Wipe</option>\n';
				}
			echo '<option value="zoom"';
				if ($currentValue == "zoom") { 
				echo ' selected="selected">Zoom</option>\n';
				} else {
				echo '>Zoom</option>\n';
				}
				
			echo "</select>\n";
		}
	
		if ($option == 'zpfocus_cbstyle') {
			echo '<select style="width:200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			
			echo '<option value="style1"';
				if ($currentValue == "style1") { 
				echo ' selected="selected">style1</option>\n';
				} else {
				echo '>style1</option>\n';
				}
			
			echo '<option value="style2"';
				if ($currentValue == "style2") { 
				echo ' selected="selected">style2</option>\n';
				} else {
				echo '>style2</option>\n';
				}
			
			echo '<option value="style3"';
				if ($currentValue == "style3") { 
				echo ' selected="selected">style3</option>\n';
				} else {
				echo '>style3</option>\n';
				}
			
			echo '<option value="style4"';
				if ($currentValue == "style4") { 
				echo ' selected="selected">style4</option>\n';
				} else {
				echo '>style4</option>\n';
				}
				
			echo '<option value="style5"';
				if ($currentValue == "style5") { 
				echo ' selected="selected">style5</option>\n';
				} else {
				echo '>style5</option>\n';
				}
				
			echo "</select>\n";
		}
		
		if ($option == 'zpfocus_cbtransition') {
			echo '<select style="width:200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			
			echo '<option value="fade"';
				if ($currentValue == "fade") { 
				echo ' selected="selected">Fade</option>\n';
				} else {
				echo '>Fade</option>\n';
				}
			
			echo '<option value="elastic"';
				if ($currentValue == "elastic") { 
				echo ' selected="selected">Elastic</option>\n';
				} else {
				echo '>Elastic</option>\n';
				}
			
			echo '<option value="none"';
				if ($currentValue == "none") { 
				echo ' selected="selected">None</option>\n';
				} else {
				echo '>None</option>\n';
				}
				
			echo "</select>\n";
		}
		
		if ($option == 'zpfocus_final_link') {
			echo '<select style="width:200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			
			echo '<option value="colorbox"';
				if ($currentValue == "colorbox") { 
				echo ' selected="selected">colorbox</option>\n';
				} else {
				echo '>colorbox</option>\n';
				}
			
			echo '<option value="nolink"';
				if ($currentValue == "nolink") { 
				echo ' selected="selected">nolink</option>\n';
				} else {
				echo '>nolink</option>\n';
				}
			
			echo '<option value="standard"';
				if ($currentValue == "standard") { 
				echo ' selected="selected">standard</option>\n';
				} else {
				echo '>standard</option>\n';
				}
			
			echo '<option value="standard-new"';
				if ($currentValue == "standard-new") { 
				echo ' selected="selected">standard-new</option>\n';
				} else {
				echo '>standard-new</option>\n';
				}
				
			echo "</select>\n";
		}
		
		if ($option == 'zpfocus_menutype') {
			echo '<select style="width:100px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			
			echo '<option value="dropdown"';
				if ($currentValue == "dropdown") { 
				echo ' selected="selected">DropDown</option>\n';
				} else {
				echo '>DropDown</option>\n';
				}
			
			echo '<option value="jump"';
				if ($currentValue == 'jump') { 
				echo ' selected="selected">Jump</option>\n';
				} else {
				echo '>Jump</option>\n';
				}
				
			echo "</select>\n";
		}

			
		if ($option == 'zpfocus_spotlight') {
			echo '<select style="width:100px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			
			echo '<option value="none"';
				if ($currentValue == "none") { 
				echo ' selected="selected">None</option>\n';
				} else {
				echo '>None</option>\n';
				}
			
			echo '<option value="manual"';
				if ($currentValue == 'manual') { 
				echo ' selected="selected">Manual</option>\n';
				} else {
				echo '>Manual</option>\n';
				}
			
			echo '<option value="latest"';
				if ($currentValue == 'latest') { 
				echo ' selected="selected">Latest News</option>\n';
				} else {
				echo '>Latest News</option>\n';
				}
			
			echo "</select>\n";
		}

		if($option == "zpfocus_homepage") {
			$unpublishedpages = query_full_array("SELECT titlelink FROM ".prefix('pages')." WHERE `show` != 1 ORDER by `sort_order`");
			if(empty($unpublishedpages)) {
				echo gettext("No unpublished pages available");
				// clear option if no unpublished pages are available or have been published meanwhile
				// so that the normal gallery index appears and no page is accidentally set if set to unpublished again.
				setOption("zpfocus_homepage", "none", true);
			} else {
				echo '<input type="hidden" name="'.CUSTOM_OPTION_PREFIX.'selector-zpfocus_homepage" value="0" />' . "\n";
				echo '<select id="'.$option.'" name="zpfocus_homepage">'."\n";
				if($currentValue === "none") {
					$selected = " selected = 'selected'";
				} else {
					$selected = "";
				}
				echo "<option$selected>".gettext("none")."</option>";
				foreach($unpublishedpages as $page) {
					if($currentValue === $page["titlelink"]) {
						$selected = " selected = 'selected'";
					} else {
						$selected = "";
					}
					echo "<option$selected>".$page["titlelink"]."</option>";
				}
				echo "</select>\n";
			}
		}
	}

}
?>
