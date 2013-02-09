<?php
/**
 * The Template for displaying all single posts.
 *
 * @package solar
 * @since solar 1.0
 */

get_header(); ?>

<section class="content-blog">

	<?php get_template_part( 'loop', 'index' ); ?>
	
</section><!-- .blog-content -->

<?php get_footer(); ?>