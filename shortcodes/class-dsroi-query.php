<?php

class DSROI_QUERY extends DSROI_SHORTCODE{

  function __construct(){

    $this->shortcode_str 	= 'dsroi_query';

    parent::__construct();

  }

  function getDefaultAtts(){
    return array(
			'post_type' 						=> 'post',
			'post_status'						=> 'publish',
			'posts_per_page'				=> '10',
			'style'									=> '',
			'order'									=> 'DESC',
			'id'										=> 'posts-'.rand()
		);
  }

  function dsroiShortcode( $atts ){

    /* GET ATTRIBUTES FROM THE SHORTCODE */
		$atts = $this->getShortcodeAtts( $atts );

    ob_start();

    if( is_user_logged_in() && !empty( $this->getSelectedYears() ) ){

      /* CREATE QUERY ATTRIBUTES WITH DEFAULT VALUES FROM THE SHORTCODE ATTRIBUTES */
      $query_atts = array(
  			'post_type'				=> $atts['post_type'],
  			'post_status'			=> $atts['post_status'],
  			'posts_per_page'	=> $atts['posts_per_page'],
  			'order' 					=> $atts['order'],
        'tax_query'       => array(
          array(
            'taxonomy' => 'institute-year',
            'field'    => 'slug',
            'terms'    => $this->getSelectedYears()
          )
        )
      );

      $dsroi_query = new WP_Query( $query_atts );

      if( $dsroi_query->have_posts() ){

        $template = $this->getTemplate( $atts['style'] );

        if( file_exists( $template ) ){
    			include( $template );
    		}

        else{
          echo "Please select a template";
        }

  			wp_reset_postdata();
  		}

    }

    return ob_get_clean();

  }

  function getSelectedYears(){
    $user_id = get_current_user_id();
    return get_user_meta( $user_id, 'dsroi_iy', true );
  }

}

DSROI_QUERY::getInstance();
