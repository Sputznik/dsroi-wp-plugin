<?php
/**
 * The template for displaying all single announcement posts.
 */
get_header(); ?>
<div class="dsroi-post">
  <?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class( 'entry' ); ?>>
  		<header class="entry-header">
        <h1 class="entry-title">
          <span class="title-prefix">Announcement:</span>
          <?php the_title();?>
        </h1>
  			<ul class="entry-meta">
  				<li class="posted-on">
            <i class="fa fa-calendar" aria-hidden="true"></i>
      			<?php echo get_the_date('M j, Y'); ?>
      		</li>
  			</ul>
  		</header>
    	<div class="entry-content">
    		<?php the_content(); ?>
    	</div>
    </article>
    <?php include( DSROI_PATH.'partials/post-navigation.php' );?>
  <?php endwhile; // End of the loop. ?>
</div>
<?php get_footer(); ?>
