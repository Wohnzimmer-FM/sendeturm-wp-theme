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
		<div class="row">
			<div class="col w-100">
				<h2><?php echo __('Search', 'sendeturm'); ?></h2>

				<form class="form-inline mb-4 mt-4 justify-content-center" action="<?php echo home_url( '/' ); ?>" method="get">
					<label class="sr-only" for="inlineFormInputName2"><?php echo __('Search', 'sendeturm'); ?></label>
					<input type="text" class="form-control mb-2 mr-sm-2 col-6" id="inlineFormInputName2" name="s" value="<?php the_search_query(); ?>">
					<button type="submit" class="btn btn-primary mb-2"><?php echo __('Start search', 'sendeturm'); ?></button>
				</form>


		<?php
		if (have_posts()) :
			
			echo '<h3>' . __('Search results', 'sendeturm') . '</h3>';
			echo '<div id="all-episodes" class="list-group">';

			while (have_posts())
			{
				the_post();
				get_template_part('template-parts/content', 'home');
			}

			echo '</div><!-- end of list-group -->';

			//the_posts_navigation();
		else :
			get_template_part('template-parts/content', 'none');
		endif;
		?>
				</div>
			</div>
		</main>
	</div>

<?php

#get_sidebar();

get_footer();
