<?php

function chapire_cleanup_assets()
{
  if (!is_admin()) {
    wp_deregister_script('wp-mediaelement');
    wp_deregister_style('wp-mediaelement');
    wp_dequeue_style('wp-block-library');
    wp_deregister_script('wp-embed');
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');

    wp_register_script('jquery', false, array(), false, true);
  }
}

add_action('wp_enqueue_scripts', 'chapire_cleanup_assets', 100);

function chapire_site_assets()
{

  wp_enqueue_style('chapire-style', get_template_directory_uri() . '/assets/styles/style.css', array(), '1.1.0');
  wp_enqueue_script('chapire-script', get_template_directory_uri() . '/assets/scripts/scripts.js', array(), '1.1.0', true);

  if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'chapire_site_assets');


function chapire_editor_assets()
{
  add_editor_style('assets/styles/style.css');
}
add_action('after_setup_theme', 'chapire_editor_assets');


function chapire_admin_assets()
{
  $admin_css = get_template_directory() . '/assets/styles/admin.css';
  if (file_exists($admin_css)) {
    wp_enqueue_style('chapire-admin', get_template_directory_uri() . '/assets/styles/admin.css', array(), '1.0.0');
  }
}
add_action('admin_enqueue_scripts', 'chapire_admin_assets');
