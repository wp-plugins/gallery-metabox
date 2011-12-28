<?php
/*
Plugin Name: Gallery Metabox
Plugin URI: http://wordpress.org/extend/plugins/gallery-metabox/
Description: Displays all the post's attached images on the Edit screen
Author: Bill Erickson
Version: 1.3
Author URI: http://www.billerickson.net
*/

/**
 * Translations
 *
 */
function be_gallery_metabox_translations() {
	load_plugin_textdomain( 'gallery-metabox', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'be_gallery_metabox_translations' );


/**
 * Add the Metabox
 * @since 1.0
 */
function be_gallery_metabox_add() {
	// Filterable metabox settings. 
	$post_types = apply_filters( 'be_gallery_metabox_post_types', array( 'post', 'page') );
	$context = apply_filters( 'be_gallery_metabox_context', 'normal' );
	$priority = apply_filters( 'be_gallery_metabox_priority', 'high' );
	
	// Loop through all post types
	foreach( $post_types as $post_type ) {
		
		// Get post ID
		if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
		elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
		if( !isset( $post_id ) ) $post_id = false;
		
		// Granular filter so you can limit it to single page or page template
		if( apply_filters( 'be_gallery_metabox_limit', true, $post_id ) )
			add_meta_box( 'be_gallery_metabox', __( 'Gallery Images', 'gallery-metabox' ), 'be_gallery_metabox', $post_type, $context, $priority );

	}
}
add_action( 'add_meta_boxes', 'be_gallery_metabox_add' );

/**
 * Build the Metabox
 * @since 1.0
 * @param object $post
 *
 */
function be_gallery_metabox( $post ) {
	
	$original_post = $post;
	
	$args = array(
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post_parent' => $post->ID,
		'post_mime_type' => 'image',
		'posts_per_page' => '-1',
		'order' => 'ASC',
		'orderby' => 'menu_order',
	);
	$args = apply_filters( 'be_gallery_metabox_args', $args );
	
	$intro = '<p><a href="media-upload.php?post_id=' . $post->ID .'&amp;type=image&amp;TB_iframe=1&amp;width=640&amp;height=715" id="add_image" class="thickbox" title="' . __( 'Add Image', 'gallery-metabox' ) . '">' . __( 'Upload Images', 'gallery-metabox' ) . '</a> | <a href="media-upload.php?post_id=' . $post->ID .'&amp;type=image&amp;tab=gallery&amp;TB_iframe=1&amp;width=640&amp;height=715" id="manage_gallery" class="thickbox" title="' . __( 'Manage Gallery', 'gallery-metabox' ) . '">' . __( 'Manage Gallery', 'gallery-metabox' ) . '</a></p>';
	echo apply_filters( 'be_gallery_metabox_intro', $intro );

	
	$loop = new WP_Query( $args );
	if( !$loop->have_posts() )
		echo '<p>No images.</p>';
			
	while( $loop->have_posts() ): $loop->the_post(); global $post;
		$thumbnail = wp_get_attachment_image_src( $post->ID, apply_filters( 'be_gallery_metabox_image_size', 'thumbnail' ) );
		echo apply_filters( 'be_gallery_metabox_output', '<img src="' . $thumbnail[0] . '" alt="' . get_the_title() . '" title="' . get_the_content() . '" /> ', $thumbnail[0], $post );
	endwhile; 
	
	$post = $original_post;
}

