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
		'public'		=> true,
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

  $orbit_tax['institute-year']	= array(
    'label'			  => 'Year',
    'slug' 			  => 'institute-year',
    'post_types'	=> array( 'announcements', 'modules' ),
  );

  return $orbit_tax;

} );

/* PUSH INTO THE GLOBAL VARS OF ORBIT META FIELDS */
add_filter( 'orbit_meta_box_vars', function( $meta_box ){

	$meta_box['modules'] = array(
		array(
			'id'			=> 'modules-meta-field',
			'title'		=> 'Additional Information',
			'fields'	=> array(
				'module_number'	=> array(
					'type' => 'text',
					'text' => 'Module Number'
				)
			)
		)
	);

	return $meta_box;
});
