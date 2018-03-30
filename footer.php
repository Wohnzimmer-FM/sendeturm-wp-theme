    </div>

    <footer id="page-footer">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2><i class="fa fa-microphone mr-1"></i><?php echo __('About', 'sendeturm'); ?></h2>
                        <p><?php bloginfo('description'); ?></p>
                    </div>
                    
                    <div class="col">
                        <h2><i class="fa fa-link mr-1"></i><?php echo __('Quick links', 'sendeturm'); ?></h2>
                        <?php bootstrap_navigation('footer-menu', 'simple-list simple-menu'); ?>
                    </div>
                    
                    <div class="col social-icons">
                        <h2><i class="fa fa-comment mr-1"></i> <?php echo __('Contact', 'sendeturm'); ?></h2>
                        <div class="d-flex flex-row h1">
                        <?php
                        $podcast = \Podlove\get_podcast();
                        $services = $podcast->services(array('category' => 'social'));

                        foreach($services as $service): ?>                     
                            <a href="<?php echo $service->profileUrl(); ?>"><i class="fa fa-<?php echo strtolower($service->title()); ?>-square mr-1"></i></a>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>