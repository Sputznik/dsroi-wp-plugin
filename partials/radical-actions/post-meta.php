<?php
/**
 * Post meta for radical-actions post
 */

$post_id        = get_the_ID();
$countries      = array();
$type           = DSROI_WP_UTIL::get_the_post_terms( $post_id, 'radical-action-type' );
$year_terms     = DSROI_WP_UTIL::get_the_post_terms( $post_id, 'institute-year' );
$has_type       = !empty( $type );
$has_year_terms = !empty( $year_terms );

foreach( DSROI_WP_UTIL::get_the_post_terms( $post_id, 'region' ) as $region ){
  if( $region->parent !== 0 ) array_push( $countries, $region->name );
}

$has_countries  = !empty( $countries );
?>
<?php if( $has_year_terms || $has_countries || $has_type ): ?>
  <div class="post-meta">
    <?php if( $has_year_terms ): ?>
      <span>Year: <?php echo implode( ", ", wp_list_pluck( $year_terms, 'name' ) ); ?></span>
      <?php if( $has_countries || $has_type ): ?>
        <span> | </span>
      <?php endif; ?>
    <?php endif; ?>
    <?php if( $has_countries ): ?>
      <span>Region(s): <?php echo implode( ", ", $countries ); ?></span>
      <?php if( $has_type ): ?>
        <span> | </span>
      <?php endif; ?>
    <?php endif; ?>
    <?php if( $has_type ): ?>
      <span>Type: <?php echo $type[0]->name; ?></span>
    <?php endif; ?>
  </div>
<?php endif; ?>
