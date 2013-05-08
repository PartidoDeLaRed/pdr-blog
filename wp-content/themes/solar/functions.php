<?php
/**
 * solar functions and definitions
 *
 * @package solar
 * @since solar 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since solar 1.0
 */

require_once('inc/wp-updates-theme.php');
new WPUpdatesThemeUpdater( 'http://wp-updates.com/api/1/theme', 195, basename(get_template_directory()) );

add_action('admin_head', 'load_theme_scripts');

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


if ( ! function_exists( 'solar_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since solar 1.0
 */
function solar_setup() {
	
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );
	
	/**
	 * Custom functions that act independently of the theme templates
	 */
	require_once ( get_stylesheet_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on solar, use a find and replace
	 * to change 'solar' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'solar', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'solar' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	// add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // solar_setup
add_action( 'after_setup_theme', 'solar_setup' );
add_action( 'load-post.php', 'wp_svbtle_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'wp_svbtle_post_meta_boxes_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since solar 1.0
 */
function solar_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'solar' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'solar_widgets_init' );

/**
 * Enqueue scripts and styles
 */

function load_theme_scripts() {
    wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic');
}

function solar_scripts() {
	global $post;

	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'prettify',  get_template_directory_uri() . '/js/prettify/prettify.css');
	// wp_enqueue_style( 'jquery-pageslide',  get_template_directory_uri() . '/js/jquery-pageslide/jquery.pageslide.css');
	wp_enqueue_style( 'style', get_stylesheet_uri() );


	wp_enqueue_script( 'pageslide',  get_template_directory_uri() . '/js/jquery-pageslide/jquery.pageslide.custom.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'view-js',  get_template_directory_uri() . '/js/view-js/view.min.js?auto', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'prettify', get_template_directory_uri() . '/js/prettify/prettify.js', array( ), '20120206', true );
	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/js/site.js', array( 'jquery', 'prettify'), '20120206', true );




	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'solar_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


function wp_svbtle_external_url( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), '_wp_svbtle_external_url' ); ?>
	<p>
		<input class="widefat" type="text" name="wp_svbtle_external_url" id="wp_svbtle_external_url" value="<?php echo esc_attr( get_post_meta( $object->ID, '_wp_svbtle_external_url', true ) ); ?>" size="30" />
	</p>
<?php }


function wp_svbtle_post_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'wp_svbtle_add_post_meta_boxes' );
	add_action( 'save_post', 'wp_svbtle_save_post_class_meta', 10, 2 );
}

function wp_svbtle_add_post_meta_boxes() {
	add_meta_box(
		'wp_svbtle_external_url', esc_html__( 'External Url', 'example' ),
		'wp_svbtle_external_url',
		'post',
		'side',
		'high'
	);
}

function wp_svbtle_save_post_class_meta( $post_id, $post ) {

	if ( !isset( $_POST['_wp_svbtle_external_url'] ) || !wp_verify_nonce( $_POST['_wp_svbtle_external_url'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	$new_meta_value = ( isset( $_POST['wp_svbtle_external_url'] ) ? esc_url_raw( $_POST['wp_svbtle_external_url'] ) : '' );

	$meta_key = '_wp_svbtle_external_url';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}

function print_post_title() {
	
	global $post;
	
	$thePostID = $post->ID;
	$post_id = get_post($thePostID);
	$title = $post_id->post_title;
	$perm = get_permalink($post_id);
	$post_keys = array(); $post_val = array();
	$post_keys = get_post_custom_keys($thePostID);
	$is_link = 0;

	if (!empty($post_keys)) {
	
		foreach ($post_keys as $pkey) {
			if ($pkey=='_wp_svbtle_external_url' || $pkey=='_wp_svbtle_external_url' || $pkey=='_wp_svbtle_external_url') {
			$post_val = get_post_custom_values($pkey);
			}
		}
	
		if (empty($post_val)) {
			$link = $perm;
		} else {
			$link = $post_val[0];
			$is_link = 1;
		}
	
	} else {
	
		$link = $perm;
	
	}
	
	if ($is_link): ?>
		<h2 class="link">
			<a href="<?php echo $link ?>" class="title"><?php echo the_title() ?></a>
	<a href="<?php echo the_permalink() ?>" class="anchor"><img src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/anchor.svg" class="scalable"></a>
		</h2>
	
	<?php else: ?>
	
		<h2 class="no-link">
			<a href="<?php the_permalink(); ?>" class="no-link" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

	<?php endif; 

}  



