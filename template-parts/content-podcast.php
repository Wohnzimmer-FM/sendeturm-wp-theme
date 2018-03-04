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
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1"><?php the_title(); ?></h5>
        <small><?php echo $episode->publicationDate(); ?></small>
    </div>

    <p class="mb-1"><?php echo $episode->summary(); ?></p>
    <small><?php echo _e('Duration', 'sendeturm') . ': ' . $episode->duration(); ?></small>
</a>