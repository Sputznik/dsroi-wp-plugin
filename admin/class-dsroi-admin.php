<?php

class DSROI_ADMIN extends DSROI_BASE{

	function __construct(){

    //BLOCK DASHBOARD ACCESS FOR NON ADMINS
    add_action( 'init', function(){
      if ( is_admin() && ! ( current_user_can( 'administrator' ) || current_user_can('editor') ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
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

		// SET COOKIE FOR REDIRECTING BACK TO THE PREVIOUS PAGE
		add_action( 'wp', array( $this, 'setPreviousPageUrl' ) );

		// REDIRECT TO LOGIN PAGE
		add_action( 'template_redirect', function(){
			if( DSROI_WP_UTIL::isRedirectRequired() ){
				wp_redirect( home_url('/login/') );
				exit();
			}
		});

		// WP SIDEBAR WIDGETS
		add_action( 'widgets_init', array( $this, "dsroiWidgets" ) );

		/* HIDE ADMIN BAR FROM THE FRONTEND */
		add_filter('show_admin_bar', '__return_false');

		// LOAD ADMIN ASSETS
		add_action('admin_enqueue_scripts', array( $this, 'adminAssets' ) );

	}

	function adminAssets() {
  	wp_enqueue_style('dsroi-admin-css', DSROI_URI."assets/css/dsroi-admin.css");
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

	function setPreviousPageUrl(){
		$cookie_name = 'dsroi_redirect_url_cookie';
		if( DSROI_WP_UTIL::isRedirectRequired() ){
			if(	!isset(	$_COOKIE[$cookie_name] ) ){
				setcookie( $cookie_name, get_the_permalink() , time() + ( MINUTE_IN_SECONDS * 30 ) );
			}
		}
	}

}

DSROI_ADMIN::getInstance();
