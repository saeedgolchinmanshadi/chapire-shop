<?php
add_filter('get_the_archive_title_prefix', '__return_empty_string');

function goldio_start()
{
	remove_action('wp_head', 'rest_output_link_wp_head');
	add_action('init', 'goldio_head_cleanup');
	add_filter('wp_head', 'goldio_remove_wp_widget_recent_comments_style', 1);
	add_action('wp_head', 'goldio_remove_recent_comments_style', 1);
	add_filter('gallery_style', 'goldio_gallery_style');
	add_filter('excerpt_more', 'goldio_excerpt_more');
}
add_action('after_setup_theme', 'goldio_start', 16);

function goldio_head_cleanup()
{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_generator');
}

function goldio_remove_wp_widget_recent_comments_style()
{
	if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style');
	}
}

function goldio_remove_recent_comments_style()
{
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
}

function goldio_gallery_style($css)
{
	return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

function goldio_excerpt_more($more)
{
	global $post;
	return '<a class="excerpt-read-more" href="' . esc_url(get_permalink($post->ID)) . '" aria-label="' . esc_attr__('Read more about ', 'goldio') . esc_attr(get_the_title($post->ID)) . '" title="' . esc_attr__('Read', 'goldio') . ' ' . esc_attr(get_the_title($post->ID)) . '">' . esc_html__('... Read more »', 'goldio') . '</a>';
}

function remove_sticky_class($classes)
{
	if (in_array('sticky', $classes)) {
		$classes = array_diff($classes, array("sticky"));
		$classes[] = 'wp-sticky';
	}
	return $classes;
}
add_filter('post_class', 'remove_sticky_class');

function goldio_get_the_author_posts_link()
{
	global $authordata;
	if (!is_object($authordata)) {
		return false;
	}

	return sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		esc_url(get_author_posts_url($authordata->ID, $authordata->user_nicename)),
		esc_attr(sprintf(__('Posts by %s', 'goldio'), get_the_author())),
		esc_html(get_the_author())
	);
}

function disable_wp_emoji()
{
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	add_filter('tiny_mce_plugins', 'disable_emoji_tinymce');
	add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'disable_wp_emoji');

function disable_emoji_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	}
	return array();
}
