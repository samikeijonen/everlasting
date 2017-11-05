<?php
/**
 * The blog template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Everlasting
 */

get_header(); ?>

	<main id="main" class="site-main">

		<?php if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			// Previous/next page navigation. Function is located in inc/template-tags.php.
			everlasting_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</main><!-- #main -->

<?php
get_footer();
