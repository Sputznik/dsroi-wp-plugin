<?php

class DSROI_WP_UTIL extends DSROI_BASE{

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
