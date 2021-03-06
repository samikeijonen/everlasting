<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Everlasting
 */

get_header(); ?>

	<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

		// Instagram feed.
		get_template_part( 'template-parts/content', 'insta-feed' );

		// Blog posts.
		get_template_part( 'template-parts/content', 'blog-area' );
		?>

	</main><!-- #main -->

<?php
get_footer();
