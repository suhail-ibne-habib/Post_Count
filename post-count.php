<?php

// Plugin Name: Post Count 
// Author: Suhail Habib
// Version: 1.0.0

if( !defined( 'ABSPATH' ) ){
    header( "location: /" );
    die();
}

function post_count_activation(){
    
}

register_activation_hook( __FILE__, 'post_count_activation' );

function post_count_diactivation(){
    
}

register_deactivation_hook( __FILE__, 'post_count_diactivation' );

function post_count_view(){
    global $post;

    if( is_single() ){

        $views = get_post_meta( $post->ID, 'views', true );
    
        if( $views == '' ){
            add_post_meta( $post->ID, 'views', 1 );
        }else{
            $views++;
            update_post_meta( $post->ID, 'views', $views );
    
        }

    }

}

add_action( 'wp_head', 'post_count_view' );

function views_count(){
    global $post;
    return '<h3>Total Views: '.get_post_meta( $post->ID, 'views', true ).'</h3>';
}

add_shortcode( 'views_count', 'views_count' );

function post_count_admin_menu(){
    add_menu_page( 'Post Count', 'Post Count', 'manage_options', 'post-count', 'post_count_callback', '', 6 );
}

add_action( 'admin_menu', 'post_count_admin_menu' );

function post_count_callback(){
    include plugin_dir_path( __FILE__ ) . '/inc/short-code.php';
 }