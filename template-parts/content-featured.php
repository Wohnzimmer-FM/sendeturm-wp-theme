<?php
$args = array(
    'post_type' =>'podcast',
    'posts_per_page' => 1,
    'post_status' => 'publish'
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
            <?php 
            /*
            <div class="row">
                <div class="col">
                    
                </div>
            </div>
            */
            ?>

            <div class="row">
                <div class="col-12 col-lg-8 align-self-end">
                    <?php /* <h1 class="entry-title mb-4 text-center text-lg-left">
                        <a href="<?php echo esc_url(get_permalink($recent_post[0])); ?>" rel="bookmark"><?php echo $episode->title(); ?></a>
                        <span class="badge badge-pill badge-success"><?php echo __('New', 'sendeturm'); ?></span>
                    </h1>
                    */ ?>
                    <?php echo $episode->player(['context' => 'featured']); ?>
                </div>

                <div class="col-lg-4 align-self-end text-center text-lg-right subscribe">                				
                    <div class="about-info mb-0 mb-lg-2 text-secondary h4 d-none d-lg-block">
                        <?php bloginfo('description'); ?>
                    </div>
                    
                    <div class="inner mt-2">
                        
                        <?php
                            $podcast = \Podlove\get_podcast();

                            echo $podcast->subscribeButton(
                                [
                                    'format' => 'rectangle',
                                    'size' => 'big auto',
                                    'color' => get_theme_mod('sendeturm_highlight_player_color_featured', '#F00')
                                ]
                            );
                        ?>
                        <!--
                        <a class="btn btn-secondary mt-1 icon-button" role="button" href="https://itunes.apple.com/de/podcast/id<?php echo $feed->itunes_feed_id; ?>">
                            <i class="fa fa-podcast"></i>
                            <?php echo _e('Subscribe with iTunes', 'sendeturm'); ?>
                        </a>
                        <a class="btn btn-secondary mt-1 icon-button" role="button" href="<?php echo $feed->get_subscribe_url(); ?>">
                            <i class="fa fa-rss"></i>
                            <?php echo _e('Subscribe with RSS', 'sendeturm'); ?>
                        </a>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>