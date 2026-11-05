<?php
/**
 * Standard WordPress page template.
 *
 * @package FreshFold
 */
get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		$page_slug      = get_post_field( 'post_name', get_the_ID() );
		$designed_pages = array( 'pricing', 'subscriptions', 'commercial-laundry', 'service-areas', 'contact', 'blog' );
		if ( in_array( $page_slug, $designed_pages, true ) ) :
?>
<div class="ff-page ff-page-<?php echo esc_attr( $page_slug ); ?>">
	<?php the_content(); ?>
	<?php if ( 'blog' === $page_slug ) : ?>
		<section class="ff-section">
			<div class="container">
				<div class="ff-blog-grid">
					<?php
					$default_post = get_page_by_path( 'hello-world', OBJECT, 'post' );
					$recent_posts = new WP_Query(
						array(
							'post_type'           => 'post',
							'post_status'         => 'publish',
							'posts_per_page'      => 9,
							'post__not_in'        => $default_post instanceof WP_Post ? array( $default_post->ID ) : array(),
							'ignore_sticky_posts' => true,
						)
					);
					if ( $recent_posts->have_posts() ) :
						while ( $recent_posts->have_posts() ) :
							$recent_posts->the_post();
					?>
					<article <?php post_class( 'ff-card ff-blog-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="ff-blog-image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?></a>
						<?php else : ?>
							<div class="ff-blog-image ff-blog-image-placeholder" aria-hidden="true">Fresh Fold</div>
						<?php endif; ?>
						<div class="ff-blog-card-body">
							<p class="ff-blog-meta"><?php echo esc_html( get_the_date() ); ?><?php if ( get_the_category() ) : ?> · <?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?><?php endif; ?></p>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<a class="ff-text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article', 'freshfold' ); ?> →</a>
						</div>
					</article>
					<?php
						endwhile;
						wp_reset_postdata();
					else :
					?>
						<div class="ff-card ff-blog-empty">
							<span class="ff-kicker"><?php esc_html_e( 'Coming soon', 'freshfold' ); ?></span>
							<h2><?php esc_html_e( 'Fresh ideas for laundry day.', 'freshfold' ); ?></h2>
							<p><?php esc_html_e( 'Our team is preparing practical care tips, student laundry guides, and updates from Central Pennsylvania. Check back soon.', 'freshfold' ); ?></p>
							<a class="button button-primary" href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"><?php esc_html_e( 'Explore our service areas', 'freshfold' ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>
<?php
		else :
?>
<section class="page-hero"><div class="container"><p class="eyebrow"><?php esc_html_e( 'FRESH FOLD LAUNDRY DELIVERY', 'freshfold' ); ?></p><h1><?php the_title(); ?></h1></div></section>
<div class="container content-layout">
	<article <?php post_class( 'page-content card' ); ?>>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</article>
	<aside class="page-aside card"><h2><?php esc_html_e( 'Ready to get started?', 'freshfold' ); ?></h2><p><?php esc_html_e( 'We pick up, wash, fold, and deliver laundry across Central PA.', 'freshfold' ); ?></p><a class="button button-primary" href="<?php echo esc_url( home_url( '/book-pickup/' ) ); ?>"><?php esc_html_e( 'Book Your Pickup', 'freshfold' ); ?></a><p><a href="tel:+15704947523">Call/Text 570-494-7523</a></p></aside>
</div>
<?php
		endif;
	endwhile;
endif;
get_footer();
?>
