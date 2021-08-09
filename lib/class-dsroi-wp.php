<?php

class DSROI_WP_PLUGIN extends DSROI_BASE{

  function __construct(){

   /* LOAD PLUGIN ASSETS */
   add_action( 'wp_enqueue_scripts', array( $this, 'assets') );

   add_action( 'pre_get_posts', array( $this, 'modifyArchiveQuery' ) );

  }

  function assets(){
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null );
	}

  function modifyArchiveQuery( $query ) {

    $dsroi_post_types = array('modules','announcements');

  	if( $query->is_main_query() && ! is_admin() && $query->is_post_type_archive( $dsroi_post_types ) ) {
      if( ! DSROI_WP_UTIL::isAllowedRole() ){
        $query->set( 'tax_query', DSROI_WP_UTIL::getTaxQuery() );
      }
  	}

  }

}

DSROI_WP_PLUGIN::getInstance();
