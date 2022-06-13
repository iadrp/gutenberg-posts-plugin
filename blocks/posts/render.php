<?php
/**
 * Render block
 *
 * @package  Gutenberg Posts Block
 * @author   Adrian P
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$query = new WP_Query(
	[
		'posts_per_page' => $attributes['postsToShow'],
		'post_status'    => 'publish',
		'order'          => $attributes['order'],
		'orderby'        => $attributes['orderBy'],
		'cat'            => $attributes['categories'],
		'post__not_in'   => [ get_queried_object_id() ],
	]
);

if ( ! $query->have_posts() ) {
	return;
}

$class = [
	'GPB-posts',
	$attributes['className'] ? $attributes['className'] : '',
	$attributes['horizontal'] ? ' GPB-horizontal-layout' : '',
	$attributes['align'] ? 'align' . $attributes['align'] : '',
];

?>
<section class="GPB-posts<?php echo implode( ' ', array_map( 'sanitize_html_class', $class ) ); ?>">
<?php

while ( $query->have_posts() ) {

	$query->the_post();

	?>
	<article class="GPB-post">
		<?php

		$post_id   = get_the_ID();
		$thumbnail = get_the_post_thumbnail( $post_id, 'medium_large' );

		if ( $attributes['displayThumb'] && $thumbnail ) {

			?>
			<div class="GPB-media-holder">
				<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php echo $thumbnail; // WPCS: XSS ok, sanitization ok. ?>
				</a>
			</div>
			<?php

		}

		?>
		<div class="GPB-content-holder">
			<?php

			$categories = get_the_terms( $post_id, 'category' );

			if ( ! empty( $categories ) ) {

				?>
				<ul class="GPB-post-terms">
				<?php

				foreach ( $categories as $category ) {

					?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $category->term_id ) ); ?>">
							<?php echo esc_html( $category->name ); ?>
						</a>
					</li>
					<?php

				}

				?>
				</ul>
				<?php

			}

			?>
			<h3 class="GPB-post-title">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php echo get_the_title(); ?>
				</a>
			</h3>

			<time class="GPB-post-date" datetime="<?php echo esc_attr( get_the_date( 'c', $post_id ) ); ?>"><?php echo get_the_date(); ?></time>,

			<span class="GPB-post-author">
				<?php esc_html_e( 'by', 'gutenberg-posts-block' ); ?>
				<a href="<?php echo esc_url( get_the_author_link() ); ?>">
					<?php echo get_the_author(); ?>
				</a>
			</span>
			<?php

			$excerpt = get_the_excerpt();

			if ( $excerpt ) {

				?>
				<div class="GPB-post-excerpt">
					<?php echo $excerpt; // WPCS: XSS ok, sanitization ok. ?>
				</div>
				<?php

			}

			?>
			<div>
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="GPB-post-readmore">
					<?php esc_html_e( 'Read more', 'gutenberg-posts-block' ); ?>
				</a>
			</div>

		</div>
	</article>
	<?php

}

?>
</section>
<?php

wp_reset_postdata();
