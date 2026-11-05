<?php
/**
 * Blog and archive template.
 *
 * @package FreshFold
 */
get_header();
?>
<section class="page-hero"><div class="container"><p class="eyebrow"><?php esc_html_e( 'FRESH FOLD JOURNAL', 'freshfold' ); ?></p><h1><?php echo is_home() ? esc_html__( 'Laundry Tips & News', 'freshfold' ) : wp_kses_post( get_the_archive_title() ); ?></h1></div></section>
<div class="container post-grid">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'post-card card' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?></a><?php endif; ?>
				<p class="post-meta"><?php echo esc_html( get_the_date() ); ?></p>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'freshfold' ); ?> →</a>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No posts yet. Check back soon for laundry tips and news.', 'freshfold' ); ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
