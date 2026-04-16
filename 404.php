<?php get_header(); ?>

<main id="primary" class="site-main">
  <div class="error-404-wrapper">
    <div class="container">
      <div class="error-404-card">
        <div class="flex align-center ">
          <h2>404</h2>
          <h3><?php echo esc_html__('This page could not be found.', 'goldio'); ?></h3>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer();
