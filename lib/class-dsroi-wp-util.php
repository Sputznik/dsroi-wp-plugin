<?php

class DSROI_WP_UTIL extends DSROI_BASE{

  // LIST OF ALLOWED ROLES
  public static function isAllowedRole(){
    $user = wp_get_current_user();
    $allowed_roles = array('editor', 'administrator', 'bbp_moderator', 'bbp_keymaster');
    if( array_intersect( $allowed_roles, $user->roles ) ){
      return true;
    }
    return false;
  }

  // TAX QUERY CALLBACK BASED ON THE SELECTED INSTITUTE YEAR
  public static function getTaxQuery(){
    return array(
      array(
        'taxonomy' => 'institute-year',
        'field'    => 'slug',
        'terms'    => self::getSelectedYears()
      )
    );
  }

  public static function getSelectedYears(){
    $user_id = get_current_user_id();
    return get_user_meta( $user_id, 'dsroi_iy', true );
  }

  public static function isRedirectRequired(){
    $dsroi_pages = array('modules', 'announcements');
    if ( ! is_user_logged_in() && ( is_singular( $dsroi_pages ) || is_post_type_archive( $dsroi_pages ) || is_page('dashboard') ) ){
      return true;
    }
    return false;
  }

  public static function getModuleNumber(){
    $module_number = get_post_meta( get_the_ID(), 'module_number', true );
    return $module_number;
  }

  public static function getWeekText(){
    $weekText = self::getModuleNumber() > 0 ? "Week ".self::getModuleNumber().": " : "";
    return $weekText;
  }

  public static function setCookie( $cookie_name ){
    global $wp;
    setcookie( $cookie_name, home_url( $wp->request ), time() + ( MINUTE_IN_SECONDS * 30 ), "/" );
  }

  public static function deleteCookie( $cookie_name ){
    unset( $_COOKIE[$cookie_name] );
    setcookie( $cookie_name, null, -1, "/" );
  }

  public static function get_the_post_terms( $post_id, $taxonomy ){
    $terms = get_the_terms( $post_id, $taxonomy );
    if( empty( $terms ) || is_wp_error( $terms ) ) return array();
    return $terms;
  }

  public static function get_regions( $post_id ){
    $regions = array();

    foreach( self::get_the_post_terms( $post_id, 'region' ) as $region ){
      if( $region->parent !== 0 ) array_push( $regions, $region->name );
    }

    return $regions;
  }

  public static function get_hierarchical_regions( $post_id ){
    $regions = array();

    foreach( self::get_the_post_terms( $post_id, 'region' ) as $region ){
      if( $region->parent ){
        // FETCH THE PARENT TERM OBJECT IF IT'S NOT FETCHED ALREADY
        if( isset( $regions[$region->parent] ) ){
          $regions[$region->parent] = "$region->name, {$regions[$region->parent]}";
        } else {
          $parent_term = get_term_by( 'term_id', $region->parent, 'region' );
          $regions[$parent_term->term_id]  = "$region->name, $parent_term->name;";
        }
      } else {
          $regions[$region->term_id] = $region->name.";";
      }
    }

    return $regions;
  }

}
