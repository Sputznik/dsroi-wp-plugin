<?php

class DSROI_ADMIN extends DSROI_BASE{

	function __construct(){

    //BLOCK DASHBOARD ACCESS FOR NON ADMINS
    add_action( 'init', function(){
      if ( is_admin() && ! ( current_user_can( 'administrator' ) || current_user_can('editor') ) &&
      ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url('/dashboard') );
        exit;
      }
    } );

	}

}

DSROI_ADMIN::getInstance();
