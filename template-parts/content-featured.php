<?php
$args = array(
    'post_type' =>'podcast',
    'posts_per_page' => 1
);

$recent_post = wp_get_recent_posts($args, OBJECT);

$last_episode_id = $recent_post[0]->ID;

$episode = \Podlove\get_episode($last_episode_id);

$podcast = \Podlove\get_podcast();

$feed = \Podlove\Model\Feed::find_one_by_slug('mp3');
?>

<div id="featured">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col">
                    
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 align-self-end">
                    <h1 class="entry-title mb-4 text-center text-sm-left">
                        <a href="<?php echo esc_url(get_permalink($recent_post[0])); ?>" rel="bookmark"><?php echo $episode->title(); ?></a>
                        <span class="badge badge-pill badge-success"><?php echo __('New', 'sendeturm'); ?></span>
                    </h1>
                    <?php echo $episode->player(); ?>
                </div>

                <div class="col-lg-4 align-self-end text-center text-lg-right subscribe">                				
                    <div class="about-info mb-0 mb-lg-2 text-secondary h3">
                        <?php bloginfo('description'); ?>
                    </div>
                    
                    <div class="inner pt-2 pt-lg-0">
                        <a class="btn btn-secondary mb-2" role="button" href="https://itunes.apple.com/de/podcast/id<?php echo $feed->itunes_feed_id; ?>"><?php echo _e('Subscribe with iTunes', 'sendeturm'); ?></a>
                        <a class="btn btn-secondary mb-2" role="button" href="<?php echo $feed->get_subscribe_url(); ?>"><?php echo _e('Subscribe with RSS', 'sendeturm'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>