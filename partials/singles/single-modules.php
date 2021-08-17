<?php
/**
 * The template for displaying all single module posts.
 */
get_header(); ?>
<div class="dsroi-post">
  <?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class( 'entry' ); ?>>
      <a href="<?php _e( home_url( '/dashboard/' ) ); ?>" class="dashboard-btn" rel="noopener noreferrer" role="link">
        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
			  Back to Dashboard
      </a>
      <header class="entry-header">
  			<h1 class="entry-title">
          <?php the_title();?>
        </h1>
        <p><a href="#learning-sections" aria-label="skip to learning modules list">[Skip to learning sections]</a></p>
      </header>
    	<div class="entry-content">
    		<?php the_content(); ?>
    	</div>
    </article>
  <?php endwhile; // End of the loop. ?>
  <?php if( is_active_sidebar( 'dsroi-single-module-sidebar' ) ){ dynamic_sidebar( 'dsroi-single-module-sidebar' ); }?>
</div>
<?php get_footer(); ?>
