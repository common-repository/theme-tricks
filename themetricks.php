<?php
/*
Plugin Name: Theme Tricks
Plugin URI: http://webcomicplanet.com/forum/theme-tricks/
Description: Show one of a variety of different effects you can put on your site.
Version: 0.1.7
Author: Philip M. Hofer (Frumph)
Author URI: http://frumph.net/

Copyright 2009 Philip M. Hofer (Frumph)  (email : philip@frumph.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

$themetricks_directory = dirname (__FILE__);
$themetricks_plugindir =  plugin_dir_url($themetricks_directory) . 'theme-tricks';

register_activation_hook(__FILE__,'themetricks_activation');
register_deactivation_hook(__FILE__,'themetricks_deactivation');

add_action('wp_footer', 'themetricks_footer_load');
add_action('admin_menu', 'themetricks_add_menu_link');
add_action('init', 'themetricks_init');
add_action('wp_head', 'themetricks_header_load');

// Add menu page
function themetricks_add_menu_link() {
	$pagehook = add_submenu_page('themes.php','Theme Tricks', 'Theme Tricks', 10, 'themetricks', 'themetricks_admin_page');
//	add_action('admin_head-'.$pagehook, 'themetricks_config_page_head');
}

function themetricks_init() {
	global $themetricks_plugindir;
	$options = get_option('themetricks');
	if ($options['alienant']) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('themetricks_browser', $themetricks_plugindir . '/js/JSFX_Browser.js');
		wp_enqueue_script('themetricks_layer', $themetricks_plugindir . '/js/JSFX_Layer.js');
		wp_enqueue_script('themetricks_mouse', $themetricks_plugindir . '/js/JSFX_Mouse.js');
		wp_enqueue_script('themetricks_squidie', $themetricks_plugindir . '/js/JSFX_MouseSquidie.js');
	}
	if ($options['linkfader']) {
		wp_enqueue_script('themetricks_linkfader', $themetricks_plugindir . '/js/JSFX_Linkfader.js');
	}
	if ($options['warp']) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('themetricks_warp', $themetricks_plugindir . '/js/jquery.imageWarp.js');
	}
	if ($options['magnify']) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('themetricks_magnify', $themetricks_plugindir . '/js/jquery.magnifier.js');
	}
	if ($options['balloons']) {
		wp_enqueue_script('themetricks_balloons', $themetricks_plugindir . '/js/moveobj.js');
	}
	if ($options['dance']) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('themetricks_magnify', $themetricks_plugindir . '/js/Wilq32.PhotoEffectCompressed.js');
	}
	if ($options['historic']) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('themetricks_historic1', $themetricks_plugindir . '/js/cvi_text_lib.js');
		wp_enqueue_script('themetricks_historic2', $themetricks_plugindir . '/js/instant.js');
	}
}  

function themetricks_activation() {
	$options = array();
	$options = get_option('themetricks');
	if (empty($options)) {
		$options['butterfly'] = 0;
		$options['eyes'] = 0;
		$options['snowfall'] = 0;
		$options['alienant'] = 0;
		$options['linkfader'] = 0;
		$options['warp'] = 0;
		$options['magnify'] = 0;
		$options['balloons'] = 0;
		$options['dance'] = 0;
		$options['historic'] = 0;
		add_option('themetricks', $options, '', 'yes');
	}
}

function themetricks_deactivation() {
	delete_option('themetricks');
}

function themetricks_browser_check() {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
	if($is_lynx) $browser_type = 'lynx';
	elseif($is_gecko) $browser_type = 'gecko';
	elseif($is_opera) $browser_type = 'opera';
	elseif($is_NS4) $browser_type = 'ns4';
	elseif($is_safari) $browser_type = 'safari';
	elseif($is_chrome) $browser_type = 'chrome';
	elseif($is_IE) $browser_type = 'ie';
	else $browser_type = 'unknown';
	
	if($is_iphone) $browser_type = 'iphone';
	return $browser_type;
}

// Display the script on the page if it's set.
function themetricks_header_load() {
	global $themetricks_directory, $themetricks_plugindir;
	
	$options = get_option('themetricks');

	if ($options['alienant']) { ?>
	
<script type="text/javascript">
<!--
function JSFX_StartEffects()
{
	JSFX.MakeMouseSquidie (15,"<img src='http://comicpress.frumph.net/wp-content/plugins/theme-tricks/images/ant_head.gif'>"
					,"<img src='http://comicpress.frumph.net/wp-content/plugins/theme-tricks/images/ant_tail.gif'>"
				);
}
//-->
</script>

<?php }
	if ($options['warp']) { ?>
<script type="text/javascript">

jQuery(document).ready(function($){
 $('img').imageWarp() //apply warp effect to images with CSS class "imagewarp"
})

</script>	
<?php }
	if ($options['balloons']) { ?>
<script type="text/javascript">
<!--
var flyimage1, flyimage2, flyimage3

function pagestart(){
	flyimage1=new Chip("flyimage1",47,68);
	flyimage2=new Chip("flyimage2",47,68);
	flyimage3=new Chip("flyimage3",47,68);
	movechip("flyimage1");
	movechip("flyimage2");
	movechip("flyimage3");
}

if (window.addEventListener)
	window.addEventListener("load", pagestart, false)
else if (window.attachEvent)
	window.attachEvent("onload", pagestart)
else if (document.getElementById)
	window.onload=pagestart
//-->
</script>
<?php }
}

// Display the script on the page in the footer if it's set.
function themetricks_footer_load() {
	global $themetricks_directory,$themetricks_plugindir;
	$browser = themetricks_browser_check();	
	$options = get_option('themetricks');
	if ($options['butterfly']) {
		@require_once($themetricks_directory . '/scripts/butterfly.php');
	}
	if ($options['snowfall']) {
		@require_once($themetricks_directory . '/scripts/snowfall.php');
	}
	if ($options['eyes'] && $browser == 'ie') {
		@require_once($themetricks_directory . '/scripts/watchingeyes.php');
	}
	if ($options['balloons']) { ?>
	
<div id="flyimage1" style="position:absolute; left: -500px; width:47; height:68;">
	<img src="<?php echo $themetricks_plugindir; ?>/images/balloon2.gif" border="0">
</div>
<div id="flyimage2" style="position:absolute; left: -500px; width:47; height:68;">
	<img src="<?php echo $themetricks_plugindir; ?>/images/balloon3.gif" border="0">
</div>
<div id="flyimage3" style="position:absolute; left: -500px; width:47; height:68;">
	<img src="<?php echo $themetricks_plugindir; ?>/images/balloon4.gif" border="0">
</div>

	<?php }
}

function themetricks_admin_page() {
	global $themetricks_directory;	

	$options = get_option('themetricks');
	
	if ( wp_verify_nonce($_POST['_wpnonce'], 'update-options') ) {
		if ('themetricks_save_settings' == $_REQUEST['action'] ) {
			// Our first value is either 0 or 1
			$input = array();
			$input['butterfly'] = ( $_REQUEST['butterfly'] == 1 ? 1: 0 );
			$input['eyes'] = ( $_REQUEST['eyes'] == 1 ? 1: 0 );
			$input['snowfall'] = ( $_REQUEST['snowfall'] == 1 ? 1: 0 );
			$input['alienant'] = ( $_REQUEST['alienant'] == 1 ? 1: 0 );
			$input['linkfader'] = ( $_REQUEST['linkfader'] == 1 ? 1: 0 );
			$input['warp'] = ( $_REQUEST['warp'] == 1 ? 1: 0 );
			$input['magnify'] = ( $_REQUEST['magnify'] == 1 ? 1: 0 );
			$input['balloons'] = ( $_REQUEST['balloons'] == 1 ? 1: 0 );
			$input['dance'] = ( $_REQUEST['dance'] == 1 ? 1: 0 );
			$input['historic'] = ( $_REQUEST['historic'] == 1 ? 1: 0 );
			update_option('themetricks',$input);
		}
		
	}
?>
	<div style="clear:both;"></div>
	<div class="wrap">

		<h2>Theme Tricks</h2>
		<div class="stuffbox">
			<div class="inside">
			
				<form method="post" id="myForm" name="template">
				<?php wp_nonce_field('update-options') ?>
				<?php $options = get_option('themetricks'); ?>
					<table class="form-table">
						<tr><td valign="top"><br />Not all tricks work together.</td>
						</tr>
						<tr><td valign="top" width="200"><strong>Butterfly</strong></td>
							<td valign="top" width="50"><input name="butterfly" type="checkbox" value="1" <?php checked('1', $options['butterfly']); ?> /></td>
							<td valign="top">Makes a couple butterflies fly across your screen.</td>
						</tr>
						<!--
						<tr><td valign="top"><strong>Eyes (IE Only)</strong></td>
							<td valign="top"><input name="eyes" type="checkbox" value="1" <?php checked('1', $options['eyes']); ?> /></td>
						</tr>
						<tr><td valign="top"><strong>Snowfall</strong></td>
							<td valign="top"><input name="snowfall" type="checkbox" value="1" <?php checked('1', $options['snowfall']); ?> /></td>
						</tr>
						<tr><td valign="top"><strong>Alien Ant (Cursor Follow)</strong></td>
							<td valign="top"><input name="alienant" type="checkbox" value="1" <?php checked('1', $options['alienant']); ?> /></td>
						</tr>
						// -->
						<tr><td valign="top"><strong>Linkfader</strong></td>
							<td valign="top"><input name="linkfader" type="checkbox" value="1" <?php checked('1', $options['linkfader']); ?> /></td>
							<td valign="top">Makes your links glow green for a few seconds then fade.</td>
						</tr>
						<tr><td valign="top"><strong>Image Warp</strong></td>
							<td valign="top"><input name="warp" type="checkbox" value="1" <?php checked('1', $options['warp']); ?> /></td>
							<td valign="top">Expands Images on your screen for a moment.</td>
						</tr>
						<tr><td valign="top"><strong>Image Magnifier</strong></td>
							<td valign="top"><input name="magnify" type="checkbox" value="1" <?php checked('1', $options['magnify']); ?> /></td>
							<td valign="top">Expands Images on your screen until you click and remove them.  add the class .magnify to whatever img you want to expand.</td>
						</tr>
						<tr><td valign="top"><strong>3 Balloons</strong></td>
							<td valign="top"><input name="balloons" type="checkbox" value="1" <?php checked('1', $options['balloons']); ?> /></td>
							<td valign="top">Makes 3 Balloons waunder the screen</td>
						</tr>
						<tr><td valign="top"><strong>Dancing Images</strong></td>
							<td valign="top"><input name="dance" type="checkbox" value="1" <?php checked('1', $options['dance']); ?> /></td>
							<td valign="top">Put class="Wilq32.PhotoEffect(0,0,0)" inside the &lt;img&gt; tag you want to have dance.</td>
						</tr>
						<tr><td valign="top"><strong>Historic Images</strong></td>
							<td valign="top"><input name="historic" type="checkbox" value="1" <?php checked('1', $options['historic']); ?> /></td>
							<td valign="top">Turns images you specify into historically looking images</td>
						</tr>
					</table>
					<p class="submit" style="margin-left: 10px;">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
					<input type="hidden" name="action" value="themetricks_save_settings" />
					</p>
				</form>

			</div>
	<div style="float: left;">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="8010001">
		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form> 
	</div>
	<div style="float: left;">Donate to help continue producing WordPress Plugins and support existing.<br />
	Estimated value of Page Tricks WordPress plugin is $5.00<br />
	You can find assistance for Page Tricks installation and bug reporting at<br />
	<a href="http://webcomicplanet.com/forum/theme-tricks/">WebComic Planet Forums.</a><br />
	</div>
	<div style="clear: both;"></div>
	</div>
	<br />Theme Tricks is made by <a href="http://frumph.net/">Philip M. Hofer (Frumph)</a>.
	</div>
	
	</div>
	
	
	<?php
}
?>