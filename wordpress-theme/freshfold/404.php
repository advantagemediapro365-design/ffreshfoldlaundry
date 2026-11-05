<?php
/**
 * Not found template.
 *
 * @package FreshFold
 */
get_header();
?>
<section class="page-hero"><div class="container"><p class="eyebrow">404</p><h1><?php esc_html_e( 'We couldn’t find that page.', 'freshfold' ); ?></h1><p><?php esc_html_e( 'Try a page from the menu, or head back to Fresh Fold’s homepage.', 'freshfold' ); ?></p><a class="button button-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Visit the homepage', 'freshfold' ); ?></a></div></section>
<?php get_footer(); ?>
