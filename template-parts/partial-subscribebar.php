<?php
$feed = \Podlove\Model\Feed::find_one_by_slug('mp3');
$podcast = \Podlove\get_podcast();
$services = $podcast->services(array('category' => 'social'));
?>

<div id="subscribe-bar" class="container text-center mb-4">
    <div class="row align-items-center">
        <div class="col-12 col-lg-6 h6 p-2 m-0">
            <?php bloginfo('description'); ?>
        </div>
        <div class="col-12 col-lg-6">
            <a class="btn btn-secondary mt-1 mt-sm-0 mt-lg-1 mt-xl-0" role="button" href="https://itunes.apple.com/de/podcast/id<?php echo $feed->itunes_feed_id; ?>">
                <i class="fa fa-podcast"></i>
                <?php echo _e('Subscribe with iTunes', 'sendeturm'); ?>
            </a>
            <a class="btn btn-secondary mt-1 mt-sm-0 mt-lg-1 mt-xl-0" role="button" href="<?php echo $feed->get_subscribe_url(); ?>">
                <i class="fa fa-rss"></i>
                <?php echo _e('Subscribe with RSS', 'sendeturm'); ?>
            </a>
            
        </div>
    </div>
</div>