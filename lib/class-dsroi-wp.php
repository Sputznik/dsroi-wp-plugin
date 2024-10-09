<?php

class DSROI_WP_PLUGIN extends DSROI_BASE{

  function __construct(){

   /* LOAD PLUGIN ASSETS */
   add_action( 'wp_enqueue_scripts', array( $this, 'assets') );

   add_action( 'pre_get_posts', array( $this, 'modifyArchiveQuery' ) );

   add_filter( 'single_template', array($this, 'getSinglePostTemplate') );

  }

  function assets(){
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null );

    wp_enqueue_style('dsroi-css', DSROI_URI.'assets/css/dsroi.css', array('font-awesome'), time() );
	}

  function modifyArchiveQuery( $query ) {

    $dsroi_post_types = array('modules','announcements');

  	if( $query->is_main_query() && ! is_admin() && $query->is_post_type_archive( $dsroi_post_types ) ) {
      if( ! DSROI_WP_UTIL::isAllowedRole() ){
        $query->set( 'tax_query', DSROI_WP_UTIL::getTaxQuery() );
      }
  	}

  }

  function getSinglePostTemplate( $single_template ) {

    global $post;

    $dsroi_singles = array(
      'modules'         => DSROI_SINGLE_TEMPLATE."single-modules.php",
      'announcements'   => DSROI_SINGLE_TEMPLATE."single-announcements.php",
      'radical-actions' => DSROI_SINGLE_TEMPLATE."single-radical-actions.php"
    );

    foreach( $dsroi_singles as $slug => $file ){
      if( $slug === $post->post_type && file_exists( $file ) ){
        $single_template = $file;
      }
    }

    return $single_template;
  }

}

DSROI_WP_PLUGIN::getInstance();
