<?php

class DSROI_PLUGIN_INIT{

  public static function pluginActivation(){
    self::allowPrivatePostAccess( true );
  }

  public static function pluginDeactivation(){
    self::allowPrivatePostAccess( false );
  }

  public static function allowPrivatePostAccess( $private_access ){
    $all_roles = array( 'author', 'contributor', 'subscriber' );
    $roles_obj = new WP_Roles();
    foreach( $all_roles as $role ){
      if( $private_access ){
        $roles_obj->add_cap( $role, 'read_private_pages' );
      }
      else{
        $roles_obj->remove_cap( $role, 'read_private_pages' );
      }
    }
  }

}
