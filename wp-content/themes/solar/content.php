<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php echo print_post_title() ?>

	<?php if (!is_page()): ?>
	<time class="entry-meta">
		<i class="ball"></i>
		<div class="posted-on">
			<?php solar_posted_on() ?>
		</div>
	</time><!-- .entry-meta -->
	<?php endif ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>') ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:'), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->