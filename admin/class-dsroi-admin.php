<?php

class DSROI_ADMIN extends DSROI_BASE{

	function __construct(){

    //BLOCK DASHBOARD ACCESS FOR NON ADMINS
    add_action( 'init', function(){
      if ( is_admin() && ! ( DSROI_WP_UTIL::isAllowedRole() ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
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

		// WP SIDEBAR WIDGETS
		add_action( 'widgets_init', array( $this, "dsroiWidgets" ) );

	}

	function dsroiWidgets(){

		register_sidebar( array(
			'name' 			    => 'Single Module Sidebar',
			'description'   => 'Appears in the single module page before the footer area',
			'id' 			      => 'dsroi-single-module-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
		) );

	}

}


DSROI_ADMIN::getInstance();
