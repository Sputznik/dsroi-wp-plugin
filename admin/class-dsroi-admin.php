<?php

class DSROI_ADMIN extends DSROI_BASE{

	var $cookie_name;

	function __construct(){

		$this->cookie_name = 'dsroi_redirect_url_cookie';

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
				if(!isset(	$_COOKIE[$this->cookie_name] ) ){
					if( $user->has_cap( 'administrator' ) || $user->has_cap( 'editor' ) ){
						$url = admin_url();
					}
					else{ $url = home_url( '/dashboard' ); }
				}
				else{
					$url = $_COOKIE[$this->cookie_name];
					// DELETE COOKIE ON LOGIN
					DSROI_WP_UTIL::deleteCookie( $this->cookie_name );
				}
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

		// CPT MODULES TITLE PREFIX
		add_filter( 'the_title', array( $this, 'moduleTitlePrefix' ), 10, 2 );

		/* REMOVE WP LOGO FROM LOGIN */
		add_action( 'login_enqueue_scripts', function(){
			?>
			<style type="text/css">
				#login h1 a, .login h1 a {
					height: auto;
			    background: none !important;
			    width: auto;
			    text-indent: unset;
					font-size: 25px;
				}
			</style>
			<?php
		});

		// CUSTOM LOGIN HEADER URL
		add_filter( 'login_headerurl', function(){
			return get_bloginfo( 'url' );
		});

		// CUSTOM LOGIN HEADER TEXT
		add_filter( 'login_headertext', function( $headertext ){
			$headertext = get_bloginfo( 'name' );
			return $headertext;
		});

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
		if( DSROI_WP_UTIL::isRedirectRequired() ){
			if(	!isset(	$_COOKIE[$this->cookie_name] ) ){
				DSROI_WP_UTIL::setCookie( $this->cookie_name );
			}
			else{
				DSROI_WP_UTIL::deleteCookie( $cookie_name );
				DSROI_WP_UTIL::setCookie( $this->cookie_name );
			}
		}

	}

	function moduleTitlePrefix( $title, $post_id ) {

		$post_type = get_post_type( $post_id );

    if( !is_admin() && ( $post_type === 'modules' ) ) {
			$module_prefix = get_post_meta( $post_id, 'module_title_prefix', true );
			if( $module_prefix && !empty( $module_prefix ) ){
				$title = $module_prefix.': '.$title;
			}
		}

		return $title;
	}

}

DSROI_ADMIN::getInstance();
