<?php
$episode = \Podlove\get_episode();
?>

<?php the_title('<h1 class="entry-title mb-4">', '</h1>'); ?>

<div id="current-episode" class="row pb-4">
    <div class="col-lg-8">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Player -->
            <div class="mb-4">
                <?php echo $episode->player(); ?>

                <div class="row">
                    <div class="col"><?php echo _e('Duration', 'sendeturm') . ': ' . $episode->duration(); ?></div>
                    <div class="col text-right"><?php echo get_published(); ?></div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="mb-4 text-center">
                <a class="btn btn-secondary" href="<?php comments_link(); ?>" role="button">
                    <i class="fa fa-comment mr-1"></i>
                <?php
                    $comments_count = get_comments_number();

                    if($comments_count < 1) {
                        echo _e('Write the first comment!', 'sendeturm');
                    } else {
                        echo _e('Comments', 'sendeturm').'<span class="badge badge-light ml-2">'.$comments_count.'</span>';
                    }
                ?>
                </a>

                <?php /* ?>
                <a class="btn btn-secondary" href="<?php comments_link(); ?>" role="button">
                    <i class="fa fa-heart mr-2"></i><?php echo _e('I like it!'); ?>
                </a>
                <?php */ ?>


                <div class="dropdown d-inline mt-1 mt-sm-0">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-share mr-2"></i><?php echo _e('Share', 'sendeturm'); ?>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item share-link" target="_blank" href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>">Twitter</a>
                        <a class="dropdown-item share-link" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>">Facebook</a>
                        <a class="dropdown-item share-link" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>">LinkedIn</a>
                    </div>
                </div>
            </div>
            
            <?php the_content(); ?>

        </article>
    </div>

    <div class="col-lg-4">
        <!-- Contributors list -->
        <div class="card mb-4 bg-secondary">
            <div class="card-header">
                <i class="fa fa-microphone mr-2"></i><?php echo _e('Contributors', 'sendeturm'); ?>
            </div>

            <ul id="contributors" class="list-group list-group-flush">
            <?php foreach($episode->contributors() as $contributor): ?>
                <li class="list-group-item contributor">
                    <div class="row no-gutters">
                        <div class="contributor-pic col mb-2 mb-sm-0">
                            <img src="<?php echo $contributor->image()->url(array('width' => 55, 'height' => 55)); ?>" />
                        </div>
                        <div class="contributor-name col-12 col-sm-8 col-md-9 col-lg-5 col-xl-6">
                            <h4 class="name"><?php echo $contributor->name(); ?></h4>
                            <!--<a href="#"><?php echo _e('Author\'s page', 'sendeturm'); ?></a>-->
                        </div>
                        <div class="contributor-links col">
                            <ul class="nav justify-content-lg-end">
                                <?php foreach($contributor->services() as $service): ?>
                                <li class="nav-item mr-1">
                                    <a href="<?php echo $service->profileUrl(); ?>">
                                        <img src="<?php echo $service->image()->url(array('width' => 20, 'height' => 20)); ?>" alt="<?php echo $service->title(); ?>" />
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>    
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
                    
        <!-- Related episodes -->
        <?php if($episode->relatedEpisodes()): ?>
        <div class="card">
            <div class="card-header">
                <i class="fa fa-volume-down mr-2"></i><?php echo _e('Related episodes', 'sendeturm'); ?>
            </div>

            <div class="list-group list-group-flush">
            <?php foreach($episode->relatedEpisodes() as $related): ?>
                <a href="<?php echo $related->url(); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <?php echo $related->title(); ?>
                    </div>
                </a>
            <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>