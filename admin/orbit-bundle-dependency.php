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

	$orbit_types['radical-actions'] = array(
		'slug' 		=> 'radical-actions',
		'labels'	=> array(
			'name' 					=> 'Radical Actions',
			'singular_name' => 'Radical Action Item',
		),
		'menu_icon'	=> 'dashicons-text-page',
		'taxonomies'	=> array('post_tag'),
		'public'		=> true,
		'supports'	=> array( 'title', 'editor', 'excerpt', 'thumbnail' )
	);

	return $orbit_types;

} );


/* PUSH INTO THE GLOBAL VARS OF ORBIT TAXNOMIES */
add_filter( 'orbit_taxonomy_vars', function( $orbit_tax ){

  $orbit_tax['institute-year']	= array(
    'label'			  => 'Year',
    'slug' 			  => 'institute-year',
    'post_types'	=> array( 'announcements', 'modules', 'radical-actions' ),
  );

	$orbit_tax['radical-action-type']	= array(
    'label'			  => 'Radical Action Type',
    'slug' 			  => 'radical-action-type',
		'hierarchical'	=> false,
    'post_types'	=> array( 'radical-actions' ),
  );

	$orbit_tax['region']	= array(
    'label'			  => 'Regions',
    'slug' 			  => 'region',
    'post_types'	=> array( 'radical-actions' ),
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
				'module_title_prefix'	=> array(
					'type' => 'text',
					'text' => 'Module Title Prefix'
				)
			)
		)
	);

	$meta_box['radical-actions'] = array(
		array(
			'id'			=> 'radical-actions-meta-field',
			'title'		=> 'Additional Information',
			'fields'	=> array(
				'video_link'	=> array(
					'type' => 'text',
					'text' => 'Video link'
				),
				'external_link'	=> array(
					'type' => 'text',
					'text' => 'External link'
				),
				'transcript_url'	=> array(
					'type' => 'text',
					'text' => 'Transcript URL'
				)
			)
		)
	);

	return $meta_box;
});
