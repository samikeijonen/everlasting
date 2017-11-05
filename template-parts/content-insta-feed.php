<?php
/**
 * Get Instagram Feed.
 *
 * @package Everlasting
 */

// Instagram feed.
if ( function_exists( 'dude_insta_feed' ) && get_theme_mod( 'insta_access_token' ) ) :
	echo '<div class="insta-feed-section front-page-section grid-wrapper grid-wrapper-3cl">';
	$instagram_feed = dude_insta_feed()->get_user_images( '2953074118' );
	foreach ( $instagram_feed['data'] as $item ) : ?>
		<div class="insta-feed-wrapper">
			<div class="entry-inner entry-inner-bg" style="background-image:url('<?php echo esc_url( $item['images']['standard_resolution']['url'] ); ?>');">
				<div class="bg-wrapper">
					<a href="<?php echo esc_url( $item['link'] ); ?>" rel="bookmark">
						<header class="entry-header">
							<?php
							// Likes.
							$count = $item['likes']['count'];
							echo everlasting_get_svg( array( 'icon' => 'heart' ) );
							echo '<span class="like-count" aria-label="' . absint( $count ) . esc_html( ' likes', 'everlasting' ) . '">' . absint( $count ) . '</span>';
							?>
						</header>
					</a>
				</div>
			</div>
		</div>
	<?php endforeach;
	echo '</div>';
endif;
