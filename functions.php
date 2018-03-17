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

#add_filter('show_admin_bar', '__return_false');

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


function sendeturm_theme_setup()
{
    load_theme_textdomain('sendeturm', get_template_directory() . '/languages');
    register_nav_menu('header-menu', __('Header Menu', 'sendeturm'));
    register_nav_menu('footer-menu', __('Footer Menu', 'sendeturm'));
}
add_action('after_setup_theme', 'sendeturm_theme_setup');


function auto_template_part()
{
    if (get_post_type() == 'podcast') {
        get_template_part('template-parts/content', 'podcast');
    } else {
        get_template_part('template-parts/content', get_post_format());
    }
}


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
add_action('pre_get_posts', 'separate_podcasts_from_blogs');


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

function get_guests($episode, $filter = array())
{
    $names = array();
    $filter_len = count($filter);

    foreach($episode->contributors() as $contributor)
    {
        if($filter_len > 0 && !in_array($contributor->group(), $filter))
        {
            continue;
        }

        $names []= $contributor->name();
    }

    $list = _n('Guest', 'Guests', count($names), 'sendeturm') .': '. implode(', ', $names);

    return $list;
}

function custom_theme_setup() {
    add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );


function toolbar_add_links( $wp_admin_bar ) {
	$args = array(
		'id'    => 'podlove_analytics',
		'title' => 'Podlove Analytics',
		'href'  => admin_url() . 'admin.php?page=podlove_analytics',
		'meta'  => array( 'class' => 'my-toolbar-page' )
	);
	$wp_admin_bar->add_node( $args );
}
add_action( 'admin_bar_menu', 'toolbar_add_links', 999 );
