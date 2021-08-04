<?php

class DSROI_SHORTCODE extends DSROI_BASE{

  var $shortcode_str;

  function __construct(){

    add_shortcode( $this->shortcode_str, array( $this, 'dsroiShortcode' ), 100 );

    /* LOAD ASSETS */
    add_action( 'wp_enqueue_scripts', array( $this, 'shortcodeAssets') );
	}

  function shortcodeAssets(){
    wp_enqueue_style('shortcodes-css', DSROI_URI.'assets/css/shortcodes.css', array('font-awesome'), time() );
  }

  function getDefaultAtts(){
    return array();
  }

  function getShortcodeAtts( $atts ){
    return shortcode_atts( $this->getDefaultAtts(), $atts, $this->shortcode_str );
  }

  function getTemplate( $template_name ){
    return DSROI_PATH."shortcodes/templates/$template_name.php";
  }

  // TO BE IMPLEMENTED BY CHILD CLASSES - HANDLES SHORTCODE CREATION
  function dsroiShortcode( $atts ){}

}
