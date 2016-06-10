<?php
/*
Plugin Name: WP Permalinks Migration
Plugin URI: http://www.wpdaxue.com/wp-permalinks-migration.html
Description: A Reloaded of Dean's Permalinks Migration. With this plugin, you can safely change your permalink structure without breaking the old links to your website,and even doesn't hurt your google pagerank. 
Author: WPDAXUE.COM
Version: 1.0
Author URI: http://www.wpdaxue.com/
*/ 

/*
Copyright 2013 WPDAXUE.COM (E-mail:admin@wpdaxue.com) | Thanks Dean Lee .

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

 global $wpdaxue_pm_config;
 $wpdaxue_pm_config =array();
 $wpdaxue_pm_config ['highpriority'] = true ;
 $wpdaxue_pm_config['rewrite'] = array();
 $wpdaxue_pm_config['oldstructure'] = NULL;
 $wpdaxue_pm_storedoptions=get_option("wpdaxue_pm_options");
 if($wpdaxue_pm_storedoptions) {
 	foreach($wpdaxue_pm_storedoptions AS $k=>$v) {
 		$wpdaxue_pm_config[$k]=$v;	
 	}
 } 
 else 
 {
 	$wpdaxue_pm_config['oldstructure'] = get_option('permalink_structure');
 }

 function permalinks_migration_init() {
 	load_plugin_textdomain( 'permalinks-migration', '', dirname( plugin_basename( __FILE__ ) ) . '/languages' );
 }
 add_action('plugins_loaded', 'permalinks_migration_init');


 function wpdaxue_pm_the_posts($post)
 {
 	global $wp;
 	global $wp_rewrite;
 	global $wpdaxue_pm_config;
 	if ($post != NULL && is_single() && $wpdaxue_pm_config['oldstructure'] != $wp_rewrite->permalink_structure)
 	{
 		if (array_key_exists($wp->matched_rule, $wpdaxue_pm_config['rewrite']))
 		{
			// ok, we need to generate a 301 Permanent redirect here.
 			header("HTTP/1.1 301 Moved Permanently", TRUE, 301);
 			header('Status: 301 Moved Permanently');
 			$permalink = get_permalink($post[0]->ID);
 			if (is_feed())
 			{
 				$permalink = trailingslashit($permalink) . 'feed/';
 			}
 			header("Location: ". $permalink);
 			exit();
 		}
 	}
 	return $post;
 }

 function wpdaxue_pm_post_rewrite_rules($rules)
 {
 	global $wp_rewrite;
 	global $wpdaxue_pm_config;
 	$oldstruct = $wpdaxue_pm_config['oldstructure'];
 	if ($oldstruct != NULL && $oldstruct != $wp_rewrite->permalink_structure)
 	{
 		$wpdaxue_pm_config['rewrite'] = $wp_rewrite->generate_rewrite_rule($oldstruct, false, false, false, true);
 		update_option("wpdaxue_pm_options",$wpdaxue_pm_config);
 		if ($wpdaxue_pm_config ['highpriority'] == true)
 		{
 			return array_merge($wpdaxue_pm_config['rewrite'],$rules);
 		}
 		else
 		{
 			return array_merge($rules, $wpdaxue_pm_config['rewrite']);
 		}
 	}
 	return $rules;
 }

 function wpdaxue_pm_options_page()
 {
 	global $wpdaxue_pm_config;
	//All output should go in this var which get printed at the end
 	$message="";
 	if (!empty($_POST['info_update'])) 
 	{
 		$old_permalink_structure =(string) $_POST['old_struct'];	
 		$old_permalink_structure = preg_replace('#/+#', '/', '/' . $old_permalink_structure);
		/*global $wp_rewrite;
		$wp_rewrite->matches = 'matches';*/
		//$wp_rewrite->generate_rewrite_rule($old_permalink_structure, false, false, false, true);
		$wpdaxue_pm_config['oldstructure'] = $old_permalink_structure;
		update_option("wpdaxue_pm_options",$wpdaxue_pm_config);
		$message.=__('Configuration updated', 'permalinks-migration');

		//Print out the message to the user, if any
		if($message!="") {
		?>
			<div class="updated"><strong><p><?php
			echo $message;
			?></p></strong></div><?php
		}
	}
?>
<div class=wrap>
	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		<h2><?php _e('WP Permalinks Migration', 'permalinks-migration') ?></h2>
		<fieldset name="sm_basic_options"  class="options">
			<h3><?php _e('Basic Options', 'permalinks-migration') ?></h3>
			<ul>
				<li><?php _e('Old Permalink Structure:','permalinks-migration') ?><input type="text" size="50" name="old_struct" value="<?php echo $wpdaxue_pm_config['oldstructure'];?>"/>
				</li>
			</ul>
		</fieldset>
		<div class="submit"><input type="submit" name="info_update" value="<?php _e('Update options', 'permalinks-migration') ?>" /></div>
		<fieldset class="options">
			<h3><?php _e('How to use', 'permalinks-migration') ?></h3>
			<p><?php _e('<strong>Important:</strong>Your host server must support URL rewriting, otherwise it may not work properly.','permalinks-migration'); ?></p>
			<p><?php _e('1.Enter the <strong>Old</strong> permalink structure above, and update options.','permalinks-migration'); ?></p>
			<p><?php
				$permalink_set = get_admin_url().'options-permalink.php';
				printf( __( '2.Go to <a href="%s">Permalinks</a> seeting page, add a <strong>New</strong> permalink structure, and update options.','permalinks-migration' ) , $permalink_set);
			?></p>
			<p><?php _e('3.Visit an <strong>Old</strong> URL of any post or page, it will be redirected to the <strong>New</strong> URL automatically. Congratulations!','permalinks-migration'); ?></p>
			<h3><?php _e('Appreciation', 'permalinks-migration') ?></h3>
			<p><?php
				$deanlee_cn = 'http://www.deanlee.cn/';
				printf( __( 'It\'s a Reloaded of Dean\'s Permalinks Migration. Thanks the original author <a href="%s" target="_blank">Dean Lee</a> for the hard work.', 'permalinks-migration' ) , $deanlee_cn);
			?></p>
			<h3><?php _e('Support & Feedback', 'permalinks-migration') ?></h3>
			<p><?php
				$wpdaxue_com = 'http://www.wpdaxue.com/wp-permalinks-migration.html';
				printf( __( 'If you need help or have suggestions, please visit our website <a href="%s" target="_blank">WPDAXUE.COM</a> for feedback.', 'permalinks-migration' ) , $wpdaxue_com );
			?></p>
		</fieldset>
	</form></div>
	<?php

}

function wpdaxue_pm_reg_admin() {
	if (function_exists('add_options_page')) 
	{
		add_options_page('WP Permalinks Migration', __('WP Permalinks Migration','permalinks-migration'), 'manage_options', basename(__FILE__), 'wpdaxue_pm_options_page');
	}
}

add_action('admin_menu', 'wpdaxue_pm_reg_admin');
add_filter('the_posts', 'wpdaxue_pm_the_posts', 20);
add_filter('post_rewrite_rules', 'wpdaxue_pm_post_rewrite_rules');

?>