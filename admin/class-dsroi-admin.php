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

		/* REDIRECT USERS ON LOGIN BASED ON USER ROLE */
		add_filter( 'login_redirect', function( $url, $request, $user ){
	    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ){
        if( $user->has_cap( 'administrator' ) || $user->has_cap( 'editor' ) ){
          $url = admin_url();
        }
				else{ $url = home_url( '/dashboard' ); }
	    }
	    return $url;
		}, 10, 3 );

		 /* LOAD PLUGIN ASSETS */
		add_action( 'wp_enqueue_scripts', array( $this, 'assets') );

	}

	function assets(){
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null );
	}

}

DSROI_ADMIN::getInstance();
