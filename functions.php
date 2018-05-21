<?php

if(in_array($_SERVER["REMOTE_ADDR"], array('127.0.0.1'))) {
    #define('ISLOCAL', true);
}

include 'vendor/wp-bootstrap4-navwalker/wp-bootstrap-navwalker.php';
include 'inc/theme-options.php';

function enqueue_style($css_file, $name) {
    $version = filemtime(get_template_directory() . $css_file);
    wp_enqueue_style($name, get_template_directory_uri() . $css_file, array(), $version);
}

function sendeturm_scripts()
{
    $css_file = '/dist/css/' . get_theme_mod("sendeturm_active_theme", "styles") . '.css';
    $version = filemtime(get_template_directory() . $css_file);
    wp_enqueue_style('sendeturm-styles', get_template_directory_uri() . $css_file, array(), $version);

    enqueue_style('/dist/assets/fontawesome/web-fonts-with-css/css/fontawesome-all.css', 'sendeturm-font-awesome');

    enqueue_style('/dist/css/open-sans.css', 'sendeturm-font-open-sans');

    wp_enqueue_script('script-popper', get_template_directory_uri() . '/dist/js/popper.min.js');
    wp_enqueue_script('script-bootstrap', get_template_directory_uri() . '/dist/js/bootstrap.min.js');
    wp_enqueue_script('script-jquery', get_template_directory_uri() . '/dist/js/jquery.min.js');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'sendeturm_scripts');

if(defined('ISLOCAL')) {
    add_filter('show_admin_bar', '__return_false');
}

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

    add_theme_support( 'title-tag' );

    add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    
    add_theme_support( 'automatic-feed-links' );
}
add_action('after_setup_theme', 'sendeturm_theme_setup');

/*
DEPRECATED
function auto_template_part()
{
    if (get_post_type() == 'podcast') {
        get_template_part('template-parts/content', 'podcast');
    } else {
        get_template_part('template-parts/content', get_post_format());
    }
}*/

function is_featured() {
    if(get_theme_mod("sendeturm_home_as_blog", true)) {
        if(is_post_type_archive('podcast')) {
            return true;
        }
    } else {
        if (is_home()) {
            return true;
        }
    }

    return false;
}

function custom_class($classes) {
    if (is_home()) {
        if(get_theme_mod("sendeturm_home_as_blog", true)) {
            $classes[] = 'home-blog';
        } else {
            $classes[] = 'home-podcast';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'custom_class');


function separate_podcasts_from_blogs($query)
{
    $is_blog = get_theme_mod("sendeturm_home_as_blog", true);

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
            #continue;
        }

        $names []= '<li class="list-inline-item mb-1">'.
                    sprintf('<img width="24" height="24" src="%s" srcset="%s 2x" />', $contributor->image()->url(array('width' => 24, 'height' => 24)), $contributor->image()->url(array('width' => 48, 'height' => 48))) . 
                    '<span>' . $contributor->name(). '</span>' .
                    '</li>';
    }

    if(count($names) < 1) {
        return '';
    }

    $list = '<ul class="list-inline">'.implode(' ', $names).'</ul>';

    return $list;
}

function toolbar_add_links( $wp_admin_bar ) {
	$args = array(
		'id'    => 'podlove_analytics',
		'title' => 'Podlove Analytics',
		'href'  => admin_url() . 'admin.php?page=podlove_analytics',
		'meta'  => array( 'class' => 'my-toolbar-page' )
    );
    
    $wp_admin_bar->add_node($args);
    
	$args = array(
		'id'    => 'podcast',
		'title' => 'Podcast',
		'href'  => admin_url() . 'edit.php?post_type=podcast',
		'meta'  => array( 'class' => 'my-toolbar-page' )
    );
    
	$wp_admin_bar->add_node($args);
}
add_action( 'admin_bar_menu', 'toolbar_add_links', 999 );

function tag_list() {
    $posttags = get_the_tags();

    if ($posttags) {
        echo '<ul class="list-inline tag-list-inline">';
        
        foreach($posttags as $tag) {
            echo '<li class="list-inline-item small">' . $tag->name . '</li>'; 
        }

        echo '</ul>';
    }
}

function sendeturm_sanitize_select($input, $setting) {
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;

    // If the input is a valid key, return it; otherwise, return the default.
    return (array_key_exists( $input, $choices ) ? $input : $setting->default);
}

function episode_title($episode, $podcast) {
    return sprintf('<span class="badge badge-secondary">%s%03d</span> %s', $podcast->mnemonic(), $episode->number(), $episode->title());
}

function sendeturm_podlove_player4_config($config) {
    if(is_featured()) {
        $config['theme']['main'] = get_theme_mod('sendeturm_main_player_color_featured', '#FFF');
        $config['theme']['highlight'] = get_theme_mod('sendeturm_highlight_player_color_featured', '#F00');
            
        $config['visibleComponents'] = array(
            #"tabChapters",
            "tabDownload",
            "tabShare",
            "poster",
            #"showTitle",
            "episodeTitle",
            "subtitle",
            #"progressbar",
            "controlSteppers",
            "controlChapters"
        );
    } else {
        $config['theme']['main'] = get_theme_mod('sendeturm_main_player_color', '#FFF');
        $config['theme']['highlight'] = get_theme_mod('sendeturm_highlight_player_color', '#F00');
        $config['tabs']['chapters'] = true;

        $config['visibleComponents'] = array(
            "tabInfo",
            "tabChapters",
            "tabDownload",
            #"tabAudio",
            "tabShare",
            "poster",
            #"showTitle",
            #"episodeTitle",
            "subtitle",
            "progressbar",
            "controlSteppers",
            "controlChapters"
        );
    }

	return $config;
}

add_filter('podlove_player4_config', 'sendeturm_podlove_player4_config');

function wpb_remove_commentsip($comment_author_ip) {
    return '';
}
add_filter( 'pre_comment_user_ip', 'wpb_remove_commentsip' );


function replace_avatar($args) {
    $args['url'] = get_template_directory_uri() . '/dist/assets/brand/avatar.png';
    return $args;
}
add_filter( 'pre_get_avatar_data', 'replace_avatar' );