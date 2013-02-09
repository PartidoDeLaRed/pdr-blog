<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package solar
 * @since solar 1.0
 */

get_header(); ?>
<section class="content-blog">
	<?php get_template_part( 'loop', 'index' ); ?>
</section><!-- .blog-content -->

<?php get_footer(); ?>