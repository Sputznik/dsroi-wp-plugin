<?php

$inc_files = array(
  "class-dsroi-plugin-init.php",
  "class-dsroi-wp-util.php",
  "class-dsroi-wp.php"
);

foreach( $inc_files as $inc_file ){
  require_once( $inc_file );
}
