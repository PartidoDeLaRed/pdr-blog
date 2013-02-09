<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package solar
 * @since solar 1.0
 */

get_header(); ?>

<section class="content-blog">
	<?php get_template_part( 'loop', 'index' ); ?>
</section><!-- .blog-content -->

<?php get_footer(); ?>