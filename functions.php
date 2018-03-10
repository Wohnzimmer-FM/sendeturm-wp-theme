<?php

include 'vendor/wp-bootstrap4-navwalker/wp-bootstrap-navwalker.php';

function sendeturm_scripts()
{
    $css_file = '/dist/css/styles.css';
    $version = filemtime(get_template_directory() . $css_file);
    wp_enqueue_style('sendeturm-styles', get_template_directory_uri() . $css_file, array(), $version);

    wp_enqueue_script('script-popper', get_template_directory_uri() . '/dist/js/popper.min.js');
    wp_enqueue_script('script-bootstrap', get_template_directory_uri() . '/dist/js/bootstrap.min.js');
    wp_enqueue_script('script-jquery', get_template_directory_uri() . '/dist/js/jquery.min.js');

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

function auto_template_part()
{
    if (get_post_type() == 'podcast') {
        get_template_part('template-parts/content', 'podcast');
    } else {
        get_template_part('template-parts/content', get_post_format());
    }
}

add_action('pre_get_posts', 'separate_podcasts_from_blogs');

function separate_podcasts_from_blogs($query)
{
    # Erst mal bleibt das auf false, also nur Podcasts auflisten
    $is_blog = false;

    if ($query->is_main_query() && is_home()) {
        if ($is_blog) {
            $query->set('post_type', 'post');
        } else {
            $query->set('post_type', 'podcast');
        }
    }
}

function inspect_v($var)
{
    echo '<pre>'.print_r($var, true).'</pre>';
}

function get_published($since = 14)
{
    $post_date = new DateTime();
    $post_date->setTimestamp(get_the_time('U'));
    $today = new DateTime("now");
    
    $interval = $today->diff($post_date);

    $interval_days = $interval->days;

    if($interval_days < 1) {
        return __('Published today', 'sendeturm');
    } else if($interval_days <= $since) {
        return sprintf(_n('Published yesterday', 'Published %d days ago', $interval_days, 'sendeturm'), $interval_days);
    } else {
        return __('Published on', 'sendeturm').' '.get_the_date();
    }
}

function get_contributors($episode)
{
    $names = array();

    foreach($episode->contributors() as $contributor)
    {
        $names []= $contributor->name();
    }

    $list = implode(', ', $names);

    return $list;
}