<?php

add_action( 'admin_init', 'rw_register_featured_image_meta_box' );
function rw_register_featured_image_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;
    $prefix = 'rw_';
    $meta_box = array(
        'id'       => 'frontpage_carousel',
        'title'    => 'Frontpage Carousel',
        'pages'    => array( 'post', 'page' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name'  => 'Display the featured image on the frontpage.',
                'id'    => $prefix . 'featured_image_checkbox',
                'type'  => 'checkbox',
                'class' => 'mni-check',
                'clone' => false,
            ),
        )
    );
    new RW_Meta_Box( $meta_box );
}

function register_header_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_header_menu' );

// POST THUMBNAILS //
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(680, 350, true);
}

function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );