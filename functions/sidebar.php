<?php
if (! function_exists('goldio_register_sidebars')) {
	function goldio_register_sidebars()
	{

		// Common settings for all sidebars (DRY principle)
		$default_args = array(
			// HTML5 Semantic Tag + Schema.org Markup for Widgets
			'before_widget' => '<section id="%1$s" class="widget %2$s" itemscope itemtype="https://schema.org/WPWidget">',
			'after_widget'  => '</section>',
			// H3 is best for widget titles (Hierarchy: H1 > H2 > H3)
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);

		// 1. Primary Sidebar (Internal Pages & Blog)
		register_sidebar(array_merge($default_args, array(
			'id'            => 'primary-sidebar',
			'name'          => __('Primary Sidebar', 'goldio'),
			'description'   => __('Widgets in this area will be shown on all posts and pages.', 'goldio'),
			'class'         => 'sidebar-primary',
			// Note: 'before_sidebar' is not standard in WP core. 
			// Add <aside role="complementary"> in your template file instead.
		)));

		// 2. Home Page Widget Area
		register_sidebar(array_merge($default_args, array(
			'id'            => 'home-widget-area',
			'name'          => __('Home Widget Area', 'goldio'),
			'description'   => __('Widgets in this area will be shown only on the front page.', 'goldio'),
			'class'         => 'sidebar-home',
			// Note: Add <aside aria-label="Home Page Supplementary"> in your template file instead.
		)));
	}
}
add_action('widgets_init', 'goldio_register_sidebars');
