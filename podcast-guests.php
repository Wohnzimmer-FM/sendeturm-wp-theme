<?php /* Template Name: PodcastGuests */

get_header(); ?>

	<?php 
		if(get_theme_mod("sendeturm_home_as_blog", true) == false) {
			get_template_part('template-parts/partial', 'subscribebar');
		}
	?>

	<div id="main-content" class="container">
		<main id="main">
            <h1><?php the_title(); ?></h1>

            
            <?php
            while ( have_posts() ) : the_post(); 
                the_content(); 
            endwhile;
            ?>

            <div class="row contributors-list mt-4">
            <?php
                $podcast_team = \Podlove\Modules\Contributors\Model\DefaultContribution::all();

                $team_ids = array_map(function($item) {
                    return $item->id;
                }, $podcast_team);

                print_r($team_ids);

                $sql_query = sprintf('WHERE id NOT IN (%s) ORDER by realname', join(',', $team_ids));
                
                $all_contributors = \Podlove\Modules\Contributors\Model\Contributor::all($sql_query);

                foreach($all_contributors as $contributor) {
                    $contributor_services = \Podlove\Modules\Social\Model\ContributorService::
                                        find_by_contributor_id_and_category($contributor->id, 'social');
                    
                    $guest_link = esc_url(add_query_arg('gid', $contributor->id, site_url( '/guest/' )));

                    // Hide guests without episodes
                    if ($contributor->contributioncount < 1) {
                        continue;
                    }

                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <div class="avatar mt-2 mb-4">
                                    <a href="<?php echo $guest_link; ?>"><?php echo $contributor->avatar()->setWidth(115)->image(); ?></a>
                                </div>
                                
                                <h5><a href="<?php echo $guest_link; ?>"><?php echo $contributor->realname; ?></a></h5>

                                <div class="contributor-links">
                                    <ul class="nav justify-content-center">
                                        <?php foreach($contributor_services as $contributor_service): ?>
                                        <?php $service = $contributor_service->get_service(); ?>
                                        <li class="nav-item mr-1">
                                            <a href="<?php echo $contributor_service->get_service_url(); ?>">
                                                <img width="20" height="20"
                                                    src="<?php echo $service->image()->url(array('width' => 20, 'height' => 20)); ?>" 
                                                    srcset="<?php echo $service->image()->url(array('width' => 40, 'height' => 40)); ?> 2x" 
                                                    alt="<?php echo ""; ?>" />
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                }
            ?>
            </div>
		</main>
	</div>

<?php

#get_sidebar();

get_footer();
