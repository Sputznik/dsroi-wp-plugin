<?php

/* SHORTCODE TO RETURN THE POST META OF RADICAL-ACTIONS POST */
add_shortcode( 'dsroi_radical_actions_meta', function( $atts ){

  $regions;
  $post_id = get_the_ID();
  $regions_separator = ", ";

  $args = shortcode_atts( array(
    'get'     => 'regions'
  ), $atts, 'dsroi_radical_actions_meta' );

  switch( $args['get'] ){
    case 'regions':
            $regions = DSROI_WP_UTIL::get_regions( $post_id );
            break;
    case 'hierarchical_regions':
            $regions = DSROI_WP_UTIL::get_hierarchical_regions( $post_id );
            $regions_separator = " ";
            break;
    default:
            $regions = array();
  }

  ob_start();
  include( DSROI_PATH.'partials/radical-actions/post-meta.php' );
  return ob_get_clean();
} );
