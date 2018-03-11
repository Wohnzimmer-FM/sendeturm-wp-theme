<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head();?>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body <?php body_class();?>>
	<a class="skip-link screen-reader-text sr-only sr-only-focusable" href="#content"><?php esc_html_e('Skip to content', 'sendeturm');?></a>

	<header id="page-header">
		<div id="main-nav" class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
			
			<img src="<?php assets_url();?>brand/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
			<?php bloginfo('name');?>
			</a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNav">
			<?php bootstrap_navigation('header-menu', 'navbar-nav mr-auto mt-2 mt-lg-0'); ?>

			<form id="header-search" class="form-inline " action="<?php echo home_url( '/' ); ?>" method="get">
				<input class="form-control" name="s" value="<?php the_search_query(); ?>" type="search" placeholder="<?php _e('Search', 'sendeturm'); ?>" aria-label="<?php _e('Search', 'sendeturm'); ?>">
				<button class="btn" type="submit">
				<svg width="15px" height="15px">
					<path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
				</svg>
				</button>
				</form>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">