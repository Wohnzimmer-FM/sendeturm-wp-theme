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

	<div id="main-content" class="container">
		<main id="main">

			<div class="row">
				<div class="col-12">

					<div class="">
						<?php
						if (have_posts()) :
							echo '<div id="all-posts" class="card-columns">';
							
							while (have_posts())
							{
								the_post();

								if (get_post_type() == 'post') {
									get_template_part('template-parts/content', 'post-small');
								}
							}

							echo '</div><!-- end of list-group -->';
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
