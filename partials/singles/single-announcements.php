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
          <span class="title-prefix">Announcements:</span>
          <?php the_title();?>
        </h1>
  			<ul class="entry-meta">
  				<?php siteorigin_north_post_meta(); ?>
  			</ul>
  		</header>
    	<div class="entry-content">
    		<?php the_content(); ?>
    	</div>
    </article>
    <?php siteorigin_north_the_post_navigation(); ?>
  <?php endwhile; // End of the loop. ?>
</div>
<?php get_footer(); ?>
