<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sendeturm
 */

$episode = \Podlove\get_episode();
?>

<a href="<?php echo esc_url(get_permalink()); ?>" class="list-group-item list-group-item-action">
   <div class="row">
        <div class="col-2 d-none d-md-block">
            <img src="<?php echo $episode->image(array('fallback' => true))->url(array('width' => 250)); ?>" alt="<?php echo _e('Episode cover'); ?>" class="img-fluid" />
        </div>
        <div class="col">
            <h3 class="h5"><i class="fa fa-volume-down mr-2"></i><?php the_title(); ?></h3>
            <small class="text-info guest-list"><?php echo get_guests($episode, array('Guests', 'Gäste')); ?></small>
            <p class="mt-2"><?php echo $episode->summary(); ?></p>
            
            <div class="topics">
                <?php tag_list(); ?>
            </div>

            <div class="row">
                <small class="text-info col"><?php echo get_published(); ?></small>
                <small class="text-info col-lg-6 col-md col-12"><?php echo _e('Duration', 'sendeturm') . ': ' . $episode->duration(); ?></small>
            </div>

        </div>
    </div>
</a>