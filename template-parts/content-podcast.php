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

<a href="<?php echo esc_url(get_permalink()); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="row mb-1">
        <h5 class="col-lg-8 col-12"><i class="fa fa-volume-down mr-2"></i><?php the_title(); ?></h5>
        <small class="col-lg-4 col-12 text-lg-right text-info"><?php echo $episode->publicationDate(); ?></small>
    </div>

    <p class="mb-1"><?php echo $episode->summary(); ?></p>

    <small class="text-info"><?php echo _e('Duration', 'sendeturm') . ': ' . $episode->duration(); ?></small>
</a>