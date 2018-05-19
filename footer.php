        </div>

        <footer id="page-footer">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h2><i class="fa fa-info-circle mr-1"></i><?php echo __('About', 'sendeturm'); ?> <?php bloginfo('name'); ?></h2>
                            <p><?php echo get_theme_mod('sendeturm_footer_about', get_bloginfo('description')); ?></p>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-lg-3">
                            <h2><i class="fa fa-link mr-1"></i><?php echo __('Quick links', 'sendeturm'); ?></h2>
                            <?php bootstrap_navigation('footer-menu', 'simple-list simple-menu'); ?>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-lg-3 social-icons">
                            <h2><i class="fa fa-comment mr-1"></i> <?php echo __('Contact', 'sendeturm'); ?></h2>
                            <div class="d-flex flex-row h1">
                            <?php
                            $podcast = \Podlove\get_podcast();
                            $services = $podcast->services(array('category' => 'social'));

                            foreach($services as $service): ?>                     
                                <a href="<?php echo $service->profileUrl(); ?>"><i class="fab fa-<?php echo strtolower($service->title()); ?>-square mr-1"></i></a>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php echo get_theme_mod("sendeturm_footer_content", ""); ?>
                </div>
            </div>
        </footer>

    <?php wp_footer(); ?>

    <?php echo get_theme_mod("sendeturm_footer_analytics", ""); ?>

</div> <!-- end of page-inner -->

</body>
</html>