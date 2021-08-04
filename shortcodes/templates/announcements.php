<ul id="<?php _e( $atts['id'] );?>" class="dsroi-announcements">
	<?php while( $dsroi_query->have_posts() ) : $dsroi_query->the_post();?>
	<li class="post-announcement">
		<span class="date"><?php the_time('j M y'); ?>:</span>
		<a class="title" href="<?php the_permalink(); ?>" role="link">
			<?php the_title(); ?>
		</a>
  </li>
	<?php endwhile;?>
</ul>
