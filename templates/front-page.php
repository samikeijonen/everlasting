<?php
/**
 * Template name: Front Page
 *
 * The template for displaying the Front Page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Everlasting
 */

get_header(); ?>

	<main id="main" class="site-main">

		<?php
		// Featured menu.
		get_template_part( 'menus/menu', 'featured' );

		// Page content.
		while ( have_posts() ) : the_post();
			echo '<div class="main-content-section front-page-section section">';
				echo '<div class="wrapper wrapper-smaller-center">';

					get_template_part( 'template-parts/content', get_post_type() );

				echo '</div><!-- .wrapper -->';
			echo '</div><!-- .main-content-section -->';
		endwhile; // End of the loop.

		// Instagram feed.
		get_template_part( 'template-parts/content', 'insta-feed' );

		// Testimonials.
		get_template_part( 'template-parts/content', 'testimonial-area' );
		?>

	</main><!-- #main -->

<?php
get_footer();
