<?php
/**
 * Template name: No sidebar page
 *
 * The template without the sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Everlasting
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop. ?>

	</main><!-- #main -->

<?php
get_footer();
