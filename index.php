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

	<?php get_template_part('template-parts/content', 'featured'); ?>

	<div id="main-content" class="container">
		<main id="main">
			<?php get_template_part('template-parts/partial', 'socialbar'); ?>

			<div class="row">
				<div class="col-12">
					<h2><?php echo __('All episodes', 'sendeturm'); ?></h2>
					<div id="all-episodes" class="list-group">

						<?php
						if (have_posts()) :
							
							while (have_posts())
							{
								the_post();
								get_template_part('template-parts/content', 'home');
							}
						?>
						</div><!-- end of list-group -->
						<?php the_posts_navigation(array(
							'mid_size' => 2
						));
						?>
					</div><!-- end of col-X -->

				</div>
			</div>
		<?php

			
		else :
			get_template_part('template-parts/content', 'none');
		endif;
		?>
		</main>
	</div>

<?php

#get_sidebar();

get_footer();
