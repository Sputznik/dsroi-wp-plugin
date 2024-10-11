<?php
/**
 * Post meta for radical-actions post
 */
$type           = DSROI_WP_UTIL::get_the_post_terms( $post_id, 'radical-action-type' );
$year_terms     = DSROI_WP_UTIL::get_the_post_terms( $post_id, 'institute-year' );
$has_type       = !empty( $type );
$has_regions    = !empty( $regions);
$has_year_terms = !empty( $year_terms ); ?>
<?php if( $has_year_terms || $has_regions || $has_type ): ?>
  <div class="post-meta">
    <?php if( $has_year_terms ): ?>
      <span>Year: <?php echo implode( ", ", wp_list_pluck( $year_terms, 'name' ) ); ?></span>
      <?php if( $has_regions || $has_type ): ?>
        <span> | </span>
      <?php endif; ?>
    <?php endif; ?>
    <?php if( $has_regions ): ?>
      <span>Region(s): <?php echo implode( $regions_separator, $regions); ?></span>
      <?php if( $has_type ): ?>
        <span> | </span>
      <?php endif; ?>
    <?php endif; ?>
    <?php if( $has_type ): ?>
      <span>Type: <?php echo $type[0]->name; ?></span>
    <?php endif; ?>
  </div>
<?php endif; ?>
