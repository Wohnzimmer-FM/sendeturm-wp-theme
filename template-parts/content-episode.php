<?php
$episode = \Podlove\get_episode();
?>

<?php
if(is_single())
{
    the_title('<h1 class="entry-title mb-4">', '</h1>');
}
else
{
    the_title('<h1 class="entry-title mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>' );
}
?>

<div id="current-episode" class="row mb-4 pb-4">
    <div class="col-md-8">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="mb-4">
                <?php echo $episode->player(); ?>
            </div>

            <div class="mb-4">
                <?php if(!is_single()) : ?>
                    <a class="btn btn-secondary" href="<?php comments_link(); ?>" role="button"><i class="fa fa-arrow-circle-right"></i> Shownotes</a>
                <?php endif; ?>

                <a class="btn btn-secondary" href="<?php comments_link(); ?>" role="button">
                    <i class="fa fa-comment mr-1"></i>
                <?php
                    $comments_count = get_comments_number();

                    if($comments_count < 1) {
                        echo _e('Write the first comment!');
                    } else {
                        echo _e('Comments').'<span class="badge badge-light ml-2">'.$comments_count.'</span>';
                    }
                ?>
                </a>

                <?php /* ?>
                <a class="btn btn-secondary" href="<?php comments_link(); ?>" role="button">
                    <i class="fa fa-heart mr-2"></i><?php echo _e('I like it!'); ?>
                </a>
                <?php */ ?>


                <div class="dropdown d-inline">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-share mr-2"></i><?php echo _e('Share'); ?>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item share-link" target="_blank" href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>">Twitter</a>
                        <a class="dropdown-item share-link" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>">Facebook</a>
                        <a class="dropdown-item share-link" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>">LinkedIn</a>
                    </div>
                </div>
            </div>
            
            <?php if(is_single()) : ?>
                <?php the_content(); ?>
            <?php else: ?>
                <p><?php echo $episode->summary(); ?></p>
            <?php endif; ?>

        </article>
    </div>

    <div class="col-md-4">

    
        <div class="card mb-4 bg-secondary">
            <div class="card-header">
                <i class="fa fa-microphone mr-2"></i><?php echo _e('Contributors'); ?>
            </div>

            <ul id="contributors" class="list-group list-group-flush">
            <?php foreach($episode->contributors() as $contributor): ?>
                <li class="list-group-item contributor">
                    <div class="row no-gutters">
                        <div class="contributor-pic col mb-sm-2">
                            <img src="<?php echo $contributor->image()->url(array('width' => 60, 'height' => 60)); ?>" />
                        </div>
                        <div class="contributor-name col-8 col-sm-8 col-md-12 col-lg-5 col-xl-6">
                            <h4 class="name"><?php echo $contributor->name(); ?></h4>
                            <!--<a href="#"><?php echo _e('Author\'s page', 'sendeturm'); ?></a>-->
                        </div>
                        <div class="contributor-links col mt-2 mt-lg-0">
                            <ul class="nav justify-content-lg-end">
                                <?php foreach($contributor->services() as $service): ?>
                                <li class="nav-item mb-1 mr-1">
                                    <a href="<?php echo $service->profileUrl(); ?>">
                                        <img src="<?php echo $service->image()->url(array('width' => 25, 'height' => 25)); ?>" alt="<?php echo $service->title(); ?>" />
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

        <?php if($episode->relatedEpisodes() && is_single()): ?>
        <div class="card">
            <div class="card-header">
                <i class="fa fa-volume-down mr-2"></i><?php echo _e('Related episodes'); ?>
            </div>

            <div class="list-group list-group-flush">
            <?php foreach($episode->relatedEpisodes() as $related): ?>
                <a href="<?php echo $related->url(); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo $related->title(); ?></h5>
                    </div>
                    <p class="mb-1"><?php echo $related->subTitle(); ?></p>
                </a>
            <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    
    </div>
</div>