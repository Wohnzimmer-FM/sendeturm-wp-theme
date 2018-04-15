<?php /* Template Name: PerformanceCheck */

$starting_time = microtime(1);

get_header();

$args = array('post_type' => 'podcast', 'posts_per_page' => -1);

$the_query = new WP_Query( $args );

?>

	<?php get_template_part('template-parts/content', 'featured'); ?>
    
    <h1 class="text-center mt-4 text-danger">Performance Check</h1>

    <div id="main-content" class="container">
        <main id="main">

            <div class="row">
                <div class="col-12">
                    <h2><?php echo __('All episodes', 'sendeturm'); ?></h2>
                    <div id="all-episodes" class="list-group">

                        <?php
                        if ($the_query->have_posts()) :
                            
                            while ($the_query->have_posts())
                            {
                                $the_query->the_post();
                                get_template_part('template-parts/content', 'episode-small');
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

        wp_reset_postdata();

        ?>
        </main>
    </div>



</div>

<p class="text-center"><?php echo sprintf('<ttl>%s</ttl>', microtime(1) - $starting_time); ?></p>

</body>
</html>