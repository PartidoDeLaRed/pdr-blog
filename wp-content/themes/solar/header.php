<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package solar
 * @since solar 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<title><?php wp_title( 'by', true, 'right' ); bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" >

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php

	$options = get_option ( 'solar_options' ); 

	echo $options['google_analytics'];

	if( isset( $options['color'] ) && '' != $options['color'] )
		$color = $options['color'];
	else 
		$color = '<?php echo $color ?>';

?>

<?php wp_head(); ?>
<style>
.wrap .content-blog article blockquote, 
.wrap .content-blog article .entry-content a:hover,
.wrap .content-blog article a:hover,
.wrap nav a:hover, nav li.current_page_item a
{border-color: <?php echo $color ?> !important;}

.wrap .content-blog article h2 a:hover
{ color: <?php echo $color ?> !important}

.wrap nav.pagination a:hover,
#respond #submit, article.post ::selection
{background-color: <?php echo $color ?>;}

<?php if($options['color']): ?>
	.wrap header.site-header h1#logo a{background-color: <?php echo $options['color'] ?> !important;}
<?php endif; ?>
<?php if (get_header_image()): ?>
	.wrap header.site-header h1#logo a{background-image: url(<?php echo get_header_image() ?> )  !important;}
<?php endif ?>
</style>

</head>

<body <?php body_class(); ?>>

<div class="relative tall">
	<div class="drawers absolute">
		<div class="right-drawer absolute">
	        <?php get_sidebar() ?>
	    </div>
	</div>

	<div id="content-fluid">
        <a href="#" id="open-left"></a>

        <div class="fix-container">
        	
			<div class="wrap">
				<?php do_action( 'before' ); ?>
				<header id="masthead" class="site-header" role="banner">
					<nav id="site-navigation" class="navigation-main" role="navigation">
						<h1 class="menu-toggle"><?php _e( 'Menu', 'solar' ); ?></h1>
						<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'solar' ); ?>"><?php _e( 'Skip to content', 'solar' ); ?></a></div>

						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav><!-- #site-navigation -->
					<hgroup>
						<h1 id="logo" class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><?php echo bloginfo('title') ?></a>
						</h1>

						<div class="info">
							<h2><?php echo bloginfo('title') ?></h2>
							<?php if ($options['theme_username']): ?>
								<h4><?php echo $options['theme_username'] ?></h4>
							<?php endif ?>
							<p class="bio"><?php echo $options['biography'] ?></p>
						</div>
					</hgroup>
						

				</header><!-- #masthead .site-header -->

