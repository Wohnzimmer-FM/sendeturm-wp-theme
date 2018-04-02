<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sendeturm
 */

get_header(); ?>

	<?php get_template_part('template-parts/partial', 'subscribebar'); ?>

	<div id="main-content" class="container">
		<main id="main">

		<?php
		if (have_posts()) :

			the_post();
			get_template_part('template-parts/content', 'page');
			
			//the_posts_navigation();
		else :
			get_template_part('template-parts/content', '404');
		endif;
		?>
		</main>
	</div>

<?php

#get_sidebar();

get_footer();
