<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package solar
 * @since solar 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses solar_header_style()
 * @uses solar_admin_header_style()
 * @uses solar_admin_header_image()
 *
 * @package solar
 */
function solar_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '000',
		'width'                  => 200,
		'height'                 => 200,
		'flex-height'            => true,
		'header-text'            => false,
		'wp-head-callback'       => 'solar_header_style',
		'admin-head-callback'    => 'solar_admin_header_style',
		'admin-preview-callback' => 'solar_admin_header_image',
	);

	$args = apply_filters( 'solar_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}


		register_default_headers( array(
		'atom' => array(
			'url' => '%s/images/icons/atom_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/atom.png',
			'description' => 'atom'
		),
		'bear' => array(
			'url' => '%s/images/icons/bear_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/bear.png',
			'description' => 'bear'
		),
		'bolt' => array(
			'url' => '%s/images/icons/bolt_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/bolt.png',
			'description' => 'bolt'
		),
		'bullhorn' => array(
			'url' => '%s/images/icons/bullhorn_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/bullhorn.png',
			'description' => 'bullhorn'
		),
		'business_man' => array(
			'url' => '%s/images/icons/business_man_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/business_man.png',
			'description' => 'business_man'
		),
		'cassette' => array(
			'url' => '%s/images/icons/cassette_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cassette.png',
			'description' => 'cassette'
		),
		'cell_phone' => array(
			'url' => '%s/images/icons/cell_phone_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cell_phone.png',
			'description' => 'cell_phone'
		),
		'chain_link' => array(
			'url' => '%s/images/icons/chain_link_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/chain_link.png',
			'description' => 'chain_link'
		),
		'coffee' => array(
			'url' => '%s/images/icons/coffee_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/coffee.png',
			'description' => 'coffee'
		),
		'cog_head' => array(
			'url' => '%s/images/icons/cog_head_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cog_head.png',
			'description' => 'cog_head'
		),
		'day_night' => array(
			'url' => '%s/images/icons/day_night_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/day_night.png',
			'description' => 'day_night'
		),
		'disapprove' => array(
			'url' => '%s/images/icons/disapprove_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/disapprove.png',
			'description' => 'disapprove'
		),
		'dog' => array(
			'url' => '%s/images/icons/dog_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/dog.png',
			'description' => 'dog'
		),
		'eye' => array(
			'url' => '%s/images/icons/eye_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/eye.png',
			'description' => 'eye'
		),
		'film' => array(
			'url' => '%s/images/icons/film_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/film.png',
			'description' => 'film'
		),
		'flask' => array(
			'url' => '%s/images/icons/flask_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/flask.png',
			'description' => 'flask'
		),
		'ghost' => array(
			'url' => '%s/images/icons/ghost_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/ghost.png',
			'description' => 'ghost'
		),
		'glasses' => array(
			'url' => '%s/images/icons/glasses_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/glasses.png',
			'description' => 'glasses'
		),
		'hat' => array(
			'url' => '%s/images/icons/hat_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/hat.png',
			'description' => 'hat'
		),
		'heart' => array(
			'url' => '%s/images/icons/heart_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/heart.png',
			'description' => 'heart'
		),
		'infection' => array(
			'url' => '%s/images/icons/infection_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/infection.png',
			'description' => 'infection'
		),
		'infinity' => array(
			'url' => '%s/images/icons/infinity_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/infinity.png',
			'description' => 'infinity'
		),
		'iphone' => array(
			'url' => '%s/images/icons/iphone_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/iphone.png',
			'description' => 'iphone'
		),
		'like' => array(
			'url' => '%s/images/icons/like_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/like.png',
			'description' => 'like'
		),
		'man_stairs' => array(
			'url' => '%s/images/icons/man_stairs_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/man_stairs.png',
			'description' => 'man_stairs'
		),
		'mine_cross' => array(
			'url' => '%s/images/icons/mine_cross_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/mine_cross.png',
			'description' => 'mine_cross'
		),
		'motorcycle' => array(
			'url' => '%s/images/icons/motorcycle_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/motorcycle.png',
			'description' => 'motorcycle'
		),
		'no_smoking' => array(
			'url' => '%s/images/icons/no_smoking_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/no_smoking.png',
			'description' => 'no_smoking'
		),
		'pan_ui' => array(
			'url' => '%s/images/icons/pan_ui_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/pan_ui.png',
			'description' => 'pan_ui'
		),
		'radio' => array(
			'url' => '%s/images/icons/radio_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/radio.png',
			'description' => 'radio'
		),
		'paperplane' => array(
			'url' => '%s/images/icons/paperplane_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/paperplane.png',
			'description' => 'radio'
		),
		'robot_square' => array(
			'url' => '%s/images/icons/robot_square_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/robot_square.png',
			'description' => 'robot_square'
		),
		'soccer_shoe' => array(
			'url' => '%s/images/icons/soccer_shoe_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/soccer_shoe.png',
			'description' => 'soccer_shoe'
		),
		'automobile' => array(
			'url' => '%s/images/icons/automobile_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/automobile.png',
			'description' => 'automobile'
		),
		'guitar' => array(
			'url' => '%s/images/icons/guitar_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/guitar.png',
			'description' => 'guitar'
		),
		'acting' => array(
			'url' => '%s/images/icons/acting_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/acting.png',
			'description' => 'acting'
		),
		'cloudrain' => array(
			'url' => '%s/images/icons/cloudrain_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/cloudrain.png',
			'description' => 'cloudrain'
		),
		'whale' => array(
			'url' => '%s/images/icons/whale_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/whale.png',
			'description' => 'whale'
		),
		'money' => array(
			'url' => '%s/images/icons/money_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/money.png',
			'description' => 'money'
		),
		'sunrise' => array(
			'url' => '%s/images/icons/sunrise_large.png',
			'thumbnail_url' => '%s/images/icons/thumbs/sunrise.png',
			'description' => 'sunrise'
		)
	) );
}
add_action( 'after_setup_theme', 'solar_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package solar
 * @since solar 1.1
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'solar_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see solar_custom_header_setup().
 *
 * @since solar 1.0
 */
function solar_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // solar_header_style

if ( ! function_exists( 'solar_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see solar_custom_header_setup().
 *
 * @since solar 1.0
 */
function solar_admin_header_style() {
?>
	<?php $options = get_option ( 'solar_options' ); ?>

	<style type="text/css">

	.header-preview{width: 500px;}
	 h1#logo {float: left; margin-right: 20px;}
	 h1#logo a {
		background-color: <?php echo $options['color'] ?> ;
		<?php if(header_image()): ?>
		background-image: url("<?php echo header_image() ?>") ;
		<?php else: ?>
		background-image: url("<?php echo get_stylesheet_directory_uri() ?>/images/logo.png") ;
		<?php endif; ?>
		background-position: center;
		background-repeat: no-repeat;
		border-radius: 5px;
		height: 150px;
		width: 150px;
		text-indent: -10000em;
		display: block;
	}
	.header-preview h2{font-weight: bold;}
	.header-preview .info p.bio{font-size: 16px;line-height: 26px; color: #666;}
	</style>
<?php
}
endif; // solar_admin_header_style

if ( ! function_exists( 'solar_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see solar_custom_header_setup().
 *
 * @since solar 1.0
 */
function solar_admin_header_image() { ?>
<?php $options = get_option ( 'solar_options' ); ?>

 <div class="header-preview">
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
 </div>

<?php }
endif; // solar_admin_header_image