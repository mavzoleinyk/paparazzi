<!DOCTYPE html>
<!--[if IE 6]>
	<html class="lt-ie10 lt-ie9 lt-ie8 lt-ie7" id="ie6" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<![endif]-->
<!--[if IE 7]>
	<html class="lt-ie10 lt-ie9 lt-ie8" id="ie7" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<![endif]-->
<!--[if IE 8]>
    <html class="lt-ie10 lt-ie9" id="ie8" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<![endif]-->
<!--[if IE 9]>
    <html class="lt-ie10" id="ie9" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9) ]><!-->
    <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/assets/favicon/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/assets/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/assets/favicon/favicon-48x48.png" sizes="48x48">
	<?php wp_head(); ?>
	<?php
	
		if( is_attachment() or is_tag() or is_product_tag()){
			echo '<meta name="robots" content="noindex, nofollow" />';
		}

	?>

	<script>
		//** CONFIG **//
		(function($) {
			window.siteURL = '<?php echo site_url(); ?>/';
			window.templateURL = '<?php echo get_template_directory_uri(); ?>/';
		})(jQuery);
	</script>

    <?php render_template('analytics/retargetting'); ?>
	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "Organization",
			"url": "https://www.paparazzi-proposals.com",
			"logo": "https://www.paparazzi-proposals.com/themes/paparazzi-proposals/assets/img/pp-logo-small.png"
		}
	</script>
	<script type="application/ld+json">
		{
		"@context" : "http://schema.org",
		"@type" : "Organization",
		"name" : "Paparazzi Proposals",
		"url" : " ttps://www.paparazzi-proposals.com",
		"sameAs" : [ "https://twitter.com/proposalpics",
			"https://www.facebook.com/PaparazziProposals", "https://www.pinterest.com/ProposalPics/" ]
		}
	</script>

</head>

	<body <?php body_class(); ?>>
    <?php

        // If its not a proposal load a the nav
        if(!is_singular('proposal')) {

            render_template('navigation/main');

        }
