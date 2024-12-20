<?php
  $main_tax_query = array();
  $paged = (  get_query_var('paged')  ) ? get_query_var('paged') : 1;
  $args = array(
    'paged'       => $paged,
    'post_status' =>'publish',
    'post_type'   => 'radical-actions'
  );

  // REGIONS
  if( isset( $_GET['tax_region'] ) && is_array( $_GET['tax_region'] ) && array_filter( $_GET['tax_region'] ) ){
    array_push( $main_tax_query, array(
    'taxonomy' => 'region',
    'field'    => 'id',
    'terms'    => $_GET['tax_region']
    ) );
  }

  // INSTITUTE YEAR
  if( isset( $_GET['tax_institute-year'] ) && $_GET['tax_institute-year'] ){
    array_push( $main_tax_query, array(
    'taxonomy' => 'institute-year',
    'field'    => 'slug',
    'terms'    => $_GET['tax_institute-year'],
    ) );
  }

  // TAGS
  if( isset( $_GET['tax_post_tag'] ) && $_GET['tax_post_tag'] ){
    $args['tag_slug__in'] = $_GET['tax_post_tag'];
  }

  // ADD TAX QUERY
  if( !empty( $main_tax_query ) ){
    $args['tax_query'] = $main_tax_query;
  }

  $query = new WP_Query( $args );
?>
<div class="dsroi-search-filter">
  <div class="dsroi-search-form">
    <?php echo $this->getFilterForm(); ?>
  </div>
  <div class="dsroi-search-results">
    <?php if( $query->have_posts() ) : ?>
      <h3 class="search-results-heading">Radical Actions</h3>
      <ul class="radical-actions-list">
        <?php while( $query->have_posts() ) : $query->the_post(); ?>
          <li class='dsroi-article-db'>
            <div class="post-thumbnail"><?php echo do_shortcode('[orbit_thumbnail_bg]');?></div>
            <div class="post-meta">
              <h3><a href="<?php echo do_shortcode('[orbit_link]');?>"><?php echo do_shortcode('[orbit_title]');?></a></h3>
              <?php echo do_shortcode('[dsroi_radical_actions_meta get="hierarchical_regions"]');?>
            </div>
          </li>
        <?php endwhile;?>
      </ul>
      <div class="dsroi-numbered-pagination">
        <?php
          $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
          the_posts_pagination(
            array(
              'mid_size' 	=> 1,
              'prev_text' => __( 'Prev' ),
              'next_text' => __( 'Next' ),
              'screen_reader_text' => __( ' ' ),
            )
          );
          wp_reset_postdata();
        ?>
      </div>
    <?php else: ?>
      <h6 class='text-center not-found-txt'>No posts found</h6>
    <?php endif; ?>
  </div>
</div>
