<ul id="<?php _e( $atts['id'] );?>" class="dsroi-announcements">
	<?php while( $dsroi_query->have_posts() ) : $dsroi_query->the_post();?>
	<li class="post-announcement">
		<a class="title" href="<?php the_permalink(); ?>" role="link" aria-label="announcement, <?php the_time('jS F');?>, <?php the_title();?>">
			<span class="announcement-date"><?php the_time("j M 'y"); ?>:</span>
			<span class="announcement-title"><?php the_title(); ?></span>
		</a>
  </li>
	<?php endwhile;?>
</ul>
