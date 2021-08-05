<?php

class DSROI_BUTTON extends DSROI_SHORTCODE{

  function __construct(){

    $this->shortcode_str 	= 'dsroi_button';

    parent::__construct();

  }

  function getDefaultAtts(){
    return array(
      'url'      => '#',
			'text' 		 => 'Click',
      'style'    => 'default'
    );
  }



  function dsroiShortcode( $atts ){

    /* GET ATTRIBUTES FROM THE SHORTCODE */
		$atts = $this->getShortcodeAtts( $atts );

    ob_start();

    $template = $this->getTemplate("button");

    if( file_exists( $template ) ){
			include( $template );
		}

    else{
      echo "Please select a template";
    }

    return ob_get_clean();

  }

}

DSROI_BUTTON::getInstance();
