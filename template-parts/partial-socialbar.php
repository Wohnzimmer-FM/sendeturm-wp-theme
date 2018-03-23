<?php
$podcast = \Podlove\get_podcast();
$services = $podcast->services(array('category' => 'social'));

foreach($services as $service): ?>

<?php if($service->title() == 'Twitter'): ?>
<div class="social-bar mb-3 text-right">
    <a href="<?php echo $service->profileUrl(); ?>?ref_src=twsrc%5Etfw" class="twitter-follow-button">Follow @<?php echo $service->rawValue(); ?></a>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>
<?php endif; ?>

<?php endforeach; ?>