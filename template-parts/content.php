<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sendeturm
 */

?>

<?php if(is_singular()) : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


</article>

<?php else: ?>

<?php echo the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

<?php endif; ?>