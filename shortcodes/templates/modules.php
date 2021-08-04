<ul id="<?php _e( $atts['id'] );?>" class="dsroi-modules">
	<?php while( $dsroi_query->have_posts() ) : $dsroi_query->the_post();?>
	<li class="post-module">
    <div class="module-inner">
      <div class="title">
        <h4><?php the_title(); ?></h4>
      </div>
      <a class="open-module" href="<?php the_permalink(); ?>" role="link">
        <i class="fa fa-file-text" aria-hidden="true"></i>
        <span>Open</span>
      </a>
    </div>
  </li>
	<?php endwhile;?>
</ul>
