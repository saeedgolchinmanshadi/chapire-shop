<?php

function wpb_search_filter($query)
{
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return $query;
    }

    $query->set('post_type', 'post');
    return $query;
}
add_filter('pre_get_posts', 'wpb_search_filter');

function goldio_theme_support()
{
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form'));
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

    $GLOBALS['content_width'] = apply_filters('goldio_theme_support', 1200);
}
add_action('after_setup_theme', 'goldio_theme_support');

// function goldio_load_textdomain()
// {
//     load_theme_textdomain('goldio', get_template_directory() . '/languages');
// }
// add_action('after_setup_theme', 'goldio_load_textdomain', 0);

function goldio_register_nav_menus()
{
    register_nav_menus(array(
        'primary'       => __('Primary Menu', 'goldio'),
        'footer'        => __('Footer Menu', 'goldio'),
        'footer-bottom' => __('Footer Bottom Menu', 'goldio'),
    ));
}
add_action('after_setup_theme', 'goldio_register_nav_menus', 20);

function wpdocs_theme_setup()
{
    add_image_size('archive', 600, 400, true);
}
add_action('after_setup_theme', 'wpdocs_theme_setup');

add_filter('jpeg_quality', function ($arg) {
    return 95;
});

add_filter('wp_editor_set_quality', function ($arg) {
    return 95;
});

// Post View Counter System
function set_post_views()
{
    if (is_admin() || !is_single() || !is_main_query() || is_preview() || wp_doing_ajax()) {
        return;
    }

    $post_id = get_queried_object_id();
    if (!$post_id) {
        return;
    }

    $count_key = 'post_views_count';
    $count = (int) get_post_meta($post_id, $count_key, true);
    update_post_meta($post_id, $count_key, $count + 1);
}
add_action('wp_head', 'set_post_views');

add_filter('manage_posts_columns', function ($columns) {
    $columns['post_views'] = 'Views';
    return $columns;
});

add_action('manage_posts_custom_column', function ($column, $post_id) {
    if ($column === 'post_views') {
        echo get_post_meta($post_id, 'post_views_count', true);
    }
}, 10, 2);
