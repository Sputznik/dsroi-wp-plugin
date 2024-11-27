<?php
/**
 * The template for displaying all single radical-actions post.
 */
get_header(); ?>
<div class="dsroi-post dsroi-radical-actions">
  <?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class( 'entry' ); ?>>
  		<header class="entry-header">
        <div class="back-to-archive" style="margin-bottom:15px;"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> <a href="/radical-action-archive/">Return to Archive</a></div>
        <h1 class="entry-title"><?php the_title();?></h1>
        <?php echo do_shortcode('[dsroi_radical_actions_meta]');?>
  		</header>
      <div class="post-container">
        <div class="entry-content">
      		<?php the_content(); ?>
          <?php if( has_tag() ): ?>
            <p class="post-tags"><?php the_tags('Themes: '); ?></p>
          <?php endif;?>
        </div>
        <?php include( DSROI_PATH.'partials/radical-actions/content-aside.php' ); ?>
      </div>
    </article>
    <hr/>
    <?php include( DSROI_PATH.'partials/radical-actions/post-navigation.php' ); ?>
  <?php endwhile; // End of the loop. ?>
</div>
<?php get_footer(); ?>
