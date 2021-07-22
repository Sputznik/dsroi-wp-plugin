<?php
/* PUSH INTO THE GLOBAL VARS OF ORBIT POST TYPES */
add_filter( 'orbit_post_type_vars', function( $orbit_types ){

	$orbit_types['announcements'] = array(
		'slug' 		=> 'announcements',
		'labels'	=> array(
			'name' 					=> 'Announcements',
			'singular_name' => 'Announcement'
		),
		'menu_icon'	=> 'dashicons-megaphone',
		'public'		=> false,
		'supports'	=> array( 'title', 'editor','thumbnail' )
	);

	$orbit_types['modules'] = array(
		'slug' 		=> 'modules',
		'labels'	=> array(
			'name' 					=> 'Modules',
			'singular_name' => 'Module'
		),
		'menu_icon'	=> 'dashicons-text-page',
		'public'		=> true,
		'supports'	=> array( 'title', 'editor','thumbnail' )
	);

	return $orbit_types;

} );


/* PUSH INTO THE GLOBAL VARS OF ORBIT TAXNOMIES */
add_filter( 'orbit_taxonomy_vars', function( $orbit_tax ){

  $orbit_tax['year']	= array(
    'label'			  => 'Year',
    'slug' 			  => 'year',
    'post_types'	=> array( 'announcements', 'modules' ),
  );

  return $orbit_tax;

} );
