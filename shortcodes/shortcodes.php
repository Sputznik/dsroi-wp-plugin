<?php

$inc_files = array(
  "class-dsroi-shortcode.php",
  "class-dsroi-query.php",
  "class-dsroi-button.php"
);

foreach( $inc_files as $inc_file ){
  require_once( $inc_file );
}
