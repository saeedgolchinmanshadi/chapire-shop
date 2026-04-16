<?php if (comments_open() || get_comments_number()) : ?>
  <div class="comments-wrapper">

    <?php if (have_comments()) : ?>
      <ul class="custom-comment-list">
        <?php
        wp_list_comments(array(
          'style'       => 'ul',
          'short_ping'  => true,
          'callback'    => 'my_custom_comment_list',
          'avatar_size' => 0,
        ));
        ?>
      </ul>
    <?php endif; ?>

    <div class="custom-comment-form">
      <h3 class="reply-title">Leave a comment</h3>
      <?php
      $commenter = wp_get_current_commenter();
      $req = get_option('require_name_email');
      $aria_req = ($req ? " aria-required='true'" : '');

      $fields = array(
        'author' => '<div class="form-row-inputs"><div class="form-group input-half"><input id="author" name="author" type="text" placeholder="Name" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group input-half"><input id="email" name="email" type="email" placeholder="Email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' /></div></div>',
        'url'    => '',
      );

      comment_form(array(
        'title_reply'        => '',
        'comment_notes_before' => '',
        'class_submit'       => 'submit-btn-blue',
        'label_submit'       => 'Post Comment',
        'comment_field'      => '<div class="form-group full-width"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="Write your comment here" aria-required="true"></textarea></div>',
        'fields'             => $fields,
      ));
      ?>
    </div>

  </div>
<?php endif; ?>