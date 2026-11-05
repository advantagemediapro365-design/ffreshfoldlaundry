<?php
/**
 * Theme header.
 *
 * @package FreshFold
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content"><?php esc_html_e( 'Skip to main content', 'freshfold' ); ?></a>
<header class="site-header">
	<div class="brand-bar">
		<div class="container brand-content">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Fresh Fold home', 'freshfold' ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'custom-logo' ) ); ?>
				<?php else : ?>
					<img src="<?php echo freshfold_image( 'freshfold-logo.jpg' ); ?>" alt="">
				<?php endif; ?>
				<span><b><?php bloginfo( 'name' ); ?></b><small><?php esc_html_e( 'Pick Up & Delivery', 'freshfold' ); ?></small></span>
			</a>
			<div class="brand-promise">Cleaner Clothes<br><strong>Happier Days</strong></div>
			<div class="brand-contact">
				<span><?php esc_html_e( 'Delivered by', 'freshfold' ); ?><br><strong>TNT Deliveries</strong></span>
				<a href="tel:+15704947523"><b><?php esc_html_e( 'Call or Text', 'freshfold' ); ?></b><strong>570-494-7523</strong></a>
				<a class="button button-primary header-book" href="<?php echo esc_url( home_url( '/book-pickup/' ) ); ?>"><?php esc_html_e( 'Book Your Pickup', 'freshfold' ); ?></a>
			</div>
		</div>
	</div>
	<nav class="navbar" aria-label="<?php esc_attr_e( 'Main navigation', 'freshfold' ); ?>">
		<div class="container nav-container">
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
				<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'freshfold' ); ?></span>
				<span></span><span></span><span></span>
			</button>
			<div class="nav-panel" id="primary-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'menu',
						'fallback_cb'    => 'freshfold_menu_fallback',
					)
				);
				?>
				<a class="button zip-link" href="<?php echo esc_url( home_url( '/service-areas/#zipcode' ) ); ?>">⌖ <?php esc_html_e( 'Check My ZIP', 'freshfold' ); ?></a>
			</div>
		</div>
	</nav>
</header>
<main id="main-content">
