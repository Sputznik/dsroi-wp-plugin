<?php

$inc_files = array(
  'orbit-bundle-dependency.php',
  'class-dsroi-admin.php',
  'class-dsroi-user-ui.php'
);


foreach( $inc_files as $inc_file ){
	require_once( $inc_file );
}
