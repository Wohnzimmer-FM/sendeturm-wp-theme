<?php
$episode = \Podlove\get_episode();
$podcast = \Podlove\get_podcast();
?>

<div id="featured">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <?php
                    the_title('<h1 class="entry-title mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>' );
                    ?>
                    <?php echo $episode->player(); ?>
                </div>
                <div class="col-4 align-self-end">
                    <a class="btn btn-secondary mb-2" role="button" href="#">Subscribe with iTunes</a>
                    <a class="btn btn-secondary mb-2" role="button" href="#">Subscribe with RSS</a>
                </div>
            </div>
        </div>
    </div>
</div>