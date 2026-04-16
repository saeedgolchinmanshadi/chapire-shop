<?php
function my_custom_comment_list($comment, $args, $depth)
{
?>
  <li <?php comment_class('custom-comment-item depth-' . $depth); ?> id="comment-<?php comment_ID(); ?>">

    <div class="comment-card">
      <div class="comment-card-header">
        <div class="author-info">
          <strong class="comment-author-name"><?php echo get_comment_author(); ?></strong>
          <span class="comment-date"><?php echo get_comment_date('j M Y'); ?></span>
        </div>
      </div>

      <div class="comment-card-body">
        <?php comment_text(); ?>
      </div>

      <div class="reply-link-wrapper">
        <?php
        comment_reply_link(array_merge($args, array(
          'depth'     => $depth,
          'max_depth' => $args['max_depth'],
          'reply_text' => '<span class="reply-icon" aria-hidden="true">&#8617;</span> ' . esc_html__('Reply', 'goldio'),
        )));
        ?>
      </div>
    </div>
  <?php
}
