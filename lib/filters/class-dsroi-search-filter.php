<?php

class DSROI_SEARCH_FILTER {

	function __construct(){

		/* LOAD ASSETS */
		add_action('wp_enqueue_scripts', array( $this, 'assets' ) );
		add_shortcode( 'dsroi_radical_actions_filter', array( $this, 'filterForm' ) );

	}

	function assets(){
		//ENQUEUE STYLES
		wp_enqueue_style('dsroi-filters-css', DSROI_URI.'/lib/filters/assets/css/filters.css', array(), DSROI_VERSION );

		//ENQUEUE SCRIPTS
		wp_enqueue_script( 'dsroi-filters-dropdown-js', DSROI_URI.'/lib/filters/assets/js/dropdown-checkboxes.js', array('jquery'), DSROI_VERSION, true );
	}

	// GET ALL THE FILTERS AS ARRAY
	function getFilters(){
		return array(
			array(
				'form' 						=> 'nested-dropdowns',
				'typeval'					=> 'region',
				'label'						=> 'Select Region'
			),
			array(
				'form' 						=> 'checkbox',
				'typeval'					=> 'tax_institute-year',
				'label'						=> 'Select Institute Year',
				'items'						=> $this->getTerms('institute-year'),
			),
			array(
				'form' 						=> 'bt-dropdown-checkboxes',
				'typeval'					=> 'tax_post_tag',
				'label'						=> 'Themes',
				'items'						=> $this->getTerms('post_tag')
			)
		);

	}

	// GETTING CATEGORIES AND SUB-CATEGORIES SEPARATELY OF A TAXONOMY
  function getNestedTerms( $atts ){

    $data = array( 'cats' => array(), 'subcats' => array() );
    $terms = get_terms( array(
      'taxonomy'    => $atts['typeval'],
      'orderby'     => 'term_id'
    ) );

    foreach ( $terms as $term ) {
      if( $term->parent ){
        array_push( $data['subcats'], array(
          'name'    => $term->name,
          'slug'    => $term->term_id,
          'parent'  => $term->parent
        ) );
      }
      else{
        array_push( $data['cats'], array(
          'name'    => $term->name,
          'slug'    => $term->term_id,
          'parent'  => $term->parent
        ) );
      }
    }

		// SORT THE TERMS ALPHABETICALLY
    usort( $data['cats'], array( $this, 'locationByName' ) );
    usort( $data['subcats'], array( $this, 'locationByName' ) );

    return $data;
  }


  function locationByName( $a, $b ){
    return strcmp( $a["name"], $b["name"] );
  }

	function getTerms( $term_type ){
		$terms = get_terms( array(
	    'taxonomy'    => $term_type
	  ) );

		$new_items = array();

		// RETURN IF TAXONOMY IS INVALID OR TERMS ARE EMPTY
		if( is_wp_error( $terms ) || empty( $terms ) ) return $new_items;

		foreach( $terms as $term ){
			array_push( $new_items, array( 'slug' => $term->slug, 'name'	=> $term->name ) );
		}

		return $new_items;
	}

	function getCurrentURL(){
    global $wp;

    // get current url with query string.
    $current_url =  home_url( $wp->request );

		// get the position where '/page.. ' text start.
		$pos = strpos( $current_url , '/page' );

    // REMOVE PAGINATION PARAMETERS
    if( $pos !== false ){
      // remove string from the specific postion
      $current_url = substr( $current_url, 0, $pos );
    }

    return $current_url;
  }

	function getFilterForm(){
		ob_start();
    include( 'templates/search-filters.php' );
    return ob_get_clean();
	}

	/* SHORTCODE CALLBACK */
	function filterForm( $atts ){
		ob_start();
		include( 'templates/search-results.php' );
    return ob_get_clean();
	}

}
global $dsroi_search_filter;
$dsroi_search_filter = new DSROI_SEARCH_FILTER;
