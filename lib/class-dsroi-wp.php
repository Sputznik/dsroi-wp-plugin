<?php

class DSROI_WP_PLUGIN extends DSROI_BASE{

  function __construct(){

   /* LOAD PLUGIN ASSETS */
   add_action( 'wp_enqueue_scripts', array( $this, 'assets') );

  }

  function assets(){
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null );
	}

}

DSROI_WP_PLUGIN::getInstance();
