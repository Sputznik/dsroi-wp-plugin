<?php
the_post_navigation(
  array(
    'next_text' => '<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
      '<span class="post-title">%title</span><i class="fa fa-angle-right" aria-hidden="true"></i>',
    'prev_text' => '<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
      '<i class="fa fa-angle-left" aria-hidden="true"></i><span class="post-title">%title</span>',
  )
);
?>
