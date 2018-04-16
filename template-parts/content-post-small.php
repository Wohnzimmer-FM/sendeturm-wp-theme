<div class="card mb-4">
    <div class="card-body p-5">
        
        <?php the_title( '<h3 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
        
        <div class="card-text">
            <?php the_excerpt(); ?>
        </div>
        
        <?php echo '<a class="read-more btn btn-outline-primary" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'sendeturm') . '</a>'; ?>
    </div>
</div>


