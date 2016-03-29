<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<?php include_once('../_includes/globals.inc.php'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><!-- desktop and mobile favicons -->
    <meta name='msapplication-TileColor' content='#2e373c'>
    <meta name='msapplication-TileImage' content='mstile-144x144.png'>
    <meta name="msapplication-config" content="<?php echo DIR_IMAGES; ?>_misc/_favicons/browserconfig.xml">
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-192x192.png' sizes='192x192'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-160x160.png' sizes='160x160'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-96x96.png' sizes='96x96'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-16x16.png' sizes='16x16'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-32x32.png' sizes='32x32'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-57x57.png' sizes='57x57'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-114x114.png' sizes='114x114'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-72x72.png' sizes='72x72'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-144x144.png' sizes='144x144'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-60x60.png' sizes='60x60'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-120x120.png' sizes='120x120'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-76x76.png' sizes='76x76'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-152x152.png' sizes='152x152'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-180x180.png' sizes='180x180'>
    <link rel="shortcut icon" href="<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon.ico">

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<!-- import Font Awesome by Dave Gandy - http://fontawesome.io -->
    <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet'  type='text/css'>
    <!-- import Google fonts :: Open Sans :: Light, Regular, Bold, Extra Bold -->
    <link href='http://fonts.googleapis.com/css?family=Reenie+Beanie|Open+Sans:200,400,700,800' rel='stylesheet' type='text/css'>
    <!-- reset all default browser styles -->
    <link href='<?php echo DIR_STYLES.'reset.min.css'; ?>' rel='stylesheet' type='text/css'>
    <!-- import all global page styles -->
    <link href='<?php echo DIR_STYLES.'style.min.css'; ?>' rel='stylesheet' type='text/css'>
	<script>(function(){document.documentElement.className='js'})();</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php include_once('../_includes/header.inc.php'); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyfifteen' ); ?></a>

	<div id="sidebar" class="sidebar">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif;
				?>
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'twentyfifteen' ); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->

		<?php get_sidebar(); ?>
	</div><!-- .sidebar -->

	<div id="content" class="site-content">
