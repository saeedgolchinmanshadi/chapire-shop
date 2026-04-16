<?php
function disable_default_dashboard_widgets()
{
	// Remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// Remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

add_action('wp_dashboard_setup', 'goldio_remove_all_dashboard_meta_boxes', 9999);
function goldio_remove_all_dashboard_meta_boxes()
{
	global $wp_meta_boxes;
	$wp_meta_boxes['dashboard']['normal']['core'] = array();
	$wp_meta_boxes['dashboard']['side']['core'] = array();
	remove_meta_box('rss_dashboard', 'dashboard', 'normal');
}
remove_action('welcome_panel', 'wp_welcome_panel');

function goldio_custom_admin_footer()
{
	return wp_kses_post(
		sprintf(
			__('Built by %1$sGoldio%2$s.', 'goldio'),
			'<a href="#" target="_blank" rel="noopener noreferrer">',
			'</a>'
		)
	);
}

add_filter('admin_footer_text', 'goldio_custom_admin_footer');
