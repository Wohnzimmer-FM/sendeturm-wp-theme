<?php
$episode = \Podlove\get_episode();
$podcast = \Podlove\get_podcast();
$feed = \Podlove\Model\Feed::find_one_by_slug('mp3');
?>

<div id="featured">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col">
                <?php the_title('<h1 class="entry-title mb-4"><a href="' . esc_url(get_permalink()) . 
                '" rel="bookmark">', 
                '</a> <span class="badge badge-pill badge-success">' . __('New', 'sendeturm') . '</span></h1>' ); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8">
                    <?php echo $episode->player(); ?>
                </div>

                <div class="col-lg-4 align-self-end text-xl-right text-center subscribe">
                    <div class="inner pt-2 pt-lg-0">
                        <a class="btn btn-secondary mb-2" role="button" href="https://itunes.apple.com/podcast/id<?php echo $feed->itunes_feed_id; ?>"><?php echo _e('Subscribe with iTunes', 'sendeturm'); ?></a>
                        <a class="btn btn-secondary mb-2" role="button" href="<?php echo $feed->get_subscribe_url(); ?>"><?php echo _e('Subscribe with RSS', 'sendeturm'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>