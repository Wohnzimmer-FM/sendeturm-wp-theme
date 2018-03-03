<?php

include 'vendor/wp-bootstrap4-navwalker/wp-bootstrap-navwalker.php';

function sendeturm_scripts()
{
    wp_enqueue_style('sendeturm-bootstraps', get_template_directory_uri() . '/dist/css/bootstrap.css');
    wp_enqueue_style('sendeturm-styles', get_template_directory_uri() . '/dist/css/styles.css');

    wp_enqueue_script('script-bootstrap', get_template_directory_uri() . '/dist/js/bootstrap.min.js');
    wp_enqueue_script('script-jquery', get_template_directory_uri() . '/dist/js/jquery.min.js');
    wp_enqueue_script('script-popper', get_template_directory_uri() . '/dist/js/popper.min.js');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'sendeturm_scripts');

add_filter('show_admin_bar', '__return_false');

function get_assets_url()
{
    return get_template_directory_uri() . '/dist/assets/';
}

function assets_url()
{
    echo get_assets_url();
}

function bootstrap_navigation($menu_location, $menu_class)
{
    wp_nav_menu(array(
        'theme_location' => $menu_location,
        'depth' => 2,
        'container' => 'ul',
        'menu_class' => $menu_class,
        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
        'walker' => new WP_Bootstrap_Navwalker(),
    ));
}

add_action('after_setup_theme', 'register_header_menu');

function register_header_menu()
{
    register_nav_menu('header-menu', __('Header Menu', 'sendeturm'));
}
