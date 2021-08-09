<?php

class DSROI_WP_UTIL extends DSROI_BASE{

  // LIST OF ALLOWED ROLES
  public static function isAllowedRole(){
    $user = wp_get_current_user();
    $allowed_roles = array('editor', 'administrator', 'bbp_moderator');
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

}
