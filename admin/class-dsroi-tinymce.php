<?php

class DSROI_TINYMCE extends DSROI_BASE{

	function __construct(){
		add_action( 'init', array( $this, 'dsroiMceButtons' ) );
	}

	function dsroiMceButtons(){
    add_filter( 'mce_external_plugins', array( $this, 'dsroiAddMceButtons' ) );
    add_filter( 'mce_buttons', array( $this, 'dsroiRegisterMceButtons') );
  }

  function dsroiAddMceButtons( $plugin_array ) {
    $plugin_array['dsroi_shortcode_script'] = DSROI_URI.'/assets/js/dsroi-shortcode-btn.js';
    return $plugin_array;
  }

  function dsroiRegisterMceButtons( $buttons ) {
    array_push( $buttons, 'dsroi_shortcode_btn');
    return $buttons;
  }

}

DSROI_TINYMCE::getInstance();
