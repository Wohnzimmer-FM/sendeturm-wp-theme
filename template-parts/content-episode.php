<div class="row">
    <div class="col-md-8">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

            <?php the_content(); ?>
        </article>
    </div>

    <aside class="col-md-4">
        x

    </aside>
</div>