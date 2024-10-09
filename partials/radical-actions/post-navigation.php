<div class="radical-action-post-nav">
	<?php
		$next_post     = get_next_post();
		$previous_post = get_previous_post();
	?>
	<?php if( !empty( $previous_post ) ) :
    $previous_post_label     = "Previous archive item";
    $previous_post_permalink = get_the_permalink( $previous_post->ID ); ?>
		<div class="previous-post">
      <a href="<?php echo $previous_post_permalink; ?>" title="<?php _e( $previous_post_label, 'dsroi-wp-plugin' ); ?>">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
      </a>
			<div class="previous-post-inner">
        <h5 class="post-label"><?php _e( $previous_post_label.":", 'dsroi-wp-plugin' ); ?></h5>
				<a class="post-title" href="<?php echo $previous_post_permalink; ?>"><?php _e( get_the_title( $previous_post->ID ), 'dsroi-wp-plugin' ); ?></a>
			</div>
		</div>
	<?php endif; ?>
	<?php if( !empty( $next_post ) ) :
    $next_post_label     = "Next archive item";
    $next_post_permalink = get_the_permalink( $next_post->ID );
  ?>
		<div class="next-post">
			<div class="next-post-inner">
				<h5 class="post-label next-post-label"><?php _e( $next_post_label.":", 'dsroi-wp-plugin' ); ?></h5>
				<a class="post-title" href="<?php echo $next_post_permalink; ?>"><?php _e( get_the_title( $next_post->ID ), 'dsroi-wp-plugin' ); ?></a>
			</div>
      <a href="<?php echo $next_post_permalink; ?>" title="<?php _e( $next_post_label, 'dsroi-wp-plugin' ); ?>">
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
			</a>
		</div>
	<?php endif; ?>
</div>
