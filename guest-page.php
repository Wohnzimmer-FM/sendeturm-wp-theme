<?php /* Template Name: Guest Page */

$guest_id = (int)get_query_var('gid');

$sql_query = sprintf('WHERE id IN (%d)', $guest_id);

$guest = \Podlove\Modules\Contributors\Model\Contributor::all($sql_query);

if(count($guest) < 1) {
	wp_redirect(home_url());
	exit;
}

$guest = $guest[0];

get_header();

?>

<?php 
	if(get_theme_mod("sendeturm_home_as_blog", true) == false) {
		get_template_part('template-parts/partial', 'subscribebar');
	}
?>

<div id="main-content" class="container">
	<main id="main">
		<div class="row">
			<div class="col w-100">
				<h2 class="mb-4"><?php echo sprintf(__('Episodes with %s', 'sendeturm'), $guest->realname); ?></h2>

		<?php

			$results_episodes = array();

			foreach($guest->episodes() as $episode)
			{
				ob_start();
				include(locate_template('template-parts/content-episode-small.php', false, false));
				$results_episodes[] = ob_get_clean();
			}

			if(count($results_episodes)) {
				echo '<h4>' . __('Podcast episodes', 'sendeturm') . '</h4>';
				echo '<div id="all-episodes" class="list-group mb-4">';
				echo implode($results_episodes);
				echo '</div><!-- end of list-group -->';
			}

		?>
				</div>
			</div>
		</main>
	</div>

<?php

#get_sidebar();

get_footer();
