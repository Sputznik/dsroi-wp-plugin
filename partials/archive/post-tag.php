<?php
/**
 * The template for displaying all single announcement posts.
 */
get_header(); ?>
<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <header class="page-header">
      <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
    </header>
    <div class="dsroi-search-results">
      <?php if( have_posts() ) : ?>
        <ul class="radical-actions-list">
          <?php while( have_posts() ) : the_post(); ?>
            <li class='dsroi-article-db'>
              <div class="post-thumbnail"><?php echo do_shortcode('[orbit_thumbnail_bg]');?></div>
              <div class="post-meta">
                <h3><a href="<?php echo do_shortcode('[orbit_link]');?>"><?php echo do_shortcode('[orbit_title]');?></a></h3>
                <?php echo do_shortcode('[dsroi_radical_actions_meta get="hierarchical_regions"]');?>
              </div>
            </li>
          <?php endwhile;?>
        </ul>
      <?php else: ?>
        <h6 class='text-center not-found-txt'>No posts found</h6>
      <?php endif; ?>
      <div class="dsroi-numbered-pagination">
        <?php
        the_posts_pagination(
          array(
            'mid_size' 	=> 1,
            'prev_text' => __( '&laquo;' ),
            'next_text' => __( '&raquo;' ),
          )
        );
        ?>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
