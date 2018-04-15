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
	if(get_theme_mod("sendeturm_home_as_blog", true) == false) {
		get_template_part('template-parts/partial', 'subscribebar');
	}
?>

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
		if (have_posts()) {
			
			echo '<h3 class="mb-4">' . __('Search results', 'sendeturm') . '</h3>';
			
			$results_episodes = array();
			$results_posts = array();

			while (have_posts())
			{
				the_post();
				
				if (get_post_type() == 'podcast') {
					ob_start();
					get_template_part('template-parts/content', 'episode-small');
					$results_episodes[] = ob_get_clean();
				}

				if (get_post_type() == 'post') {
					ob_start();
					get_template_part('template-parts/content', 'post-small');
					$results_posts[] = ob_get_clean();
				}
			}

			if(count($results_episodes)) {
				echo '<h4>' . __('Podcast episodes', 'sendeturm') . '</h4>';
				echo '<div id="all-episodes" class="list-group mb-4">';
				echo implode($results_episodes);
				echo '</div><!-- end of list-group -->';
			}

			if(count($results_posts)) {
				echo '<h4>' . __('Blog posts', 'sendeturm') . '</h4>';
				echo '<div id="all-posts" class="card-columns mb-4">';
				echo implode($results_posts);
				echo '</div><!-- end of list-group -->';
			}

			//the_posts_navigation();
		} else {
			get_template_part('template-parts/content', 'none');
		}

		?>
				</div>
			</div>
		</main>
	</div>

<?php

#get_sidebar();

get_footer();
