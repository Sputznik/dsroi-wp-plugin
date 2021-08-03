<?php

class DSROR_USER_UI extends DSROI_BASE{
  function __construct(){

    /* SHOW EXTRA FIELDS */
		add_action( 'show_user_profile', array( $this, 'extraUserFields' ), 1  );
		add_action( 'edit_user_profile', array( $this, 'extraUserFields' ), 1 );

		/* SAVE EXTRA FIELDS */
		add_action( 'personal_options_update', array( $this, 'saveExtraUserFields' ), 1 );
		add_action( 'edit_user_profile_update', array( $this, 'saveExtraUserFields' ), 1 );
  }

  function extraUserFields( $user ){
		include( "templates/user-fields.php" );
	}

	function saveExtraUserFields( $user_id ){
		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

    if( isset( $_POST['submit'] ) ){
      if( $_POST['dsroi-iy'] ){
        update_user_meta( $user_id, 'dsroi_iy', $_POST['dsroi-iy'] );
      } else{
        update_user_meta( $user_id, 'dsroi_iy', '' );
      }
    }

	}

}

DSROR_USER_UI::getInstance();
