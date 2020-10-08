<?php
add_action('wp_enqueue_scripts', 'unite_child_enqueue_styles');
function unite_child_enqueue_styles()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css');
    wp_enqueue_style('unite', get_template_directory_uri() . '/style.css', 'bootstrap');
}

/*
function delete_transient()
{
    delete_transient('realestate_cache');
    delete_transient('realestate_meta_cache');
}

add_action('save_post', 'delete_transient');
add_action('delete_post', 'delete_transient');