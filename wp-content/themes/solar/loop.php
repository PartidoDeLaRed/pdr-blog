<?php if ( ! have_posts() ) : ?>
<div id="post-0" class="post error404 not-found">
	<h1 class="entry-title"><?php _e( 'Not Found' ); ?></h1>
	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->
</div><!-- #post-0 -->
<?php endif; ?>


<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'content', get_post_format() ); ?>

<?php if (!is_page()): ?>
	<?php comments_template( '', true ); ?>
<?php endif ?>


<?php endwhile; // End the loop. Whew. ?>


<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<nav id="nav-below" class="pagination">
	<div class="older"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ); ?></div>
	<div class="newer"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ); ?></div>
</nav><!-- #nav-below --><?php endif; ?>

<?php if (is_single()): ?>
<nav id="nav-below" class="pagination">
	<div class="nav-previous"><a href="<?php echo esc_url( home_url( ) ); ?>">&larr; Back to blog</a></div>
</nav><!-- #nav-below -->
<?php endif ?>