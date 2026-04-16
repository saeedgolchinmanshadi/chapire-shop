<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div class="wrapper">
    <header class="site-header">
      <div class="container">
        <div class="header-inner flex align-center justify-between">
          <div class="site-branding">

            <button class="mobile-menu-toggle visible-xs hide" aria-label="Toggle Menu">
              <svg width="30" height="30" aria-hidden="true">
                <use href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/sprites.svg#hamburger-menu'); ?>"></use>
              </svg>
            </button>

            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link">
              <img width="105" height="33" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="logo-img">
            </a>
          </div>

          <nav class="main-navigation">

            <button class="mobile-menu-close visible-xs hide" aria-label="Close Menu">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>

            <?php
            wp_nav_menu(array(
              'theme_location' => 'primary',
              'menu_id'        => 'primary-menu',
              'container'      => false,
              'menu_class'     => 'nav-menu flex align-center',
              'fallback_cb'    => false,
            ));
            ?>
          </nav>

          <div class="header-tools flex align-center">

            <a class="search-trigger flex align-center justify-center" href="<?php echo esc_url(home_url('/?s=')); ?>">
              <svg class="icon-search" width="24" height="24" aria-hidden="true">
                <use href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/sprites.svg#icon-search'); ?>"></use>
              </svg>
            </a>

          </div>

        </div>
      </div>
    </header>