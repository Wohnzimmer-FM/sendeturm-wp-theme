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



		<?php
		if (have_posts()) :
			
			while (have_posts())
			{
				the_post();

				if($wp_query->current_post == 0)
				{
					get_template_part('template-parts/content', 'featured');

					echo '<div id="main-content" class="container">';
					echo '<main id="main">';
					echo '<div class="row">';
					echo '<div class="col w-100">';
					echo '<h2>' . __('All episodes', 'sendeturm') . '</h2>';
					echo '<div id="all-episodes" class="list-group">';
				}
				else
				{
					get_template_part('template-parts/content', 'podcast');

					if(($wp_query->current_post + 1) === ($wp_query->post_count))
					{
						echo '</div><!-- end of list-group -->';
						
						echo '</div>';

						echo '</div>';
					}
				}
			}

			//the_posts_navigation();
		else :
			get_template_part('template-parts/content', 'none');
		endif;
		?>
		</main>
	</div>

<?php

#get_sidebar();

get_footer();
