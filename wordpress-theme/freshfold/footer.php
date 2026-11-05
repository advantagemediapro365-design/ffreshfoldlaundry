<?php
/**
 * Theme footer.
 *
 * @package FreshFold
 */
?>
</main>
<footer class="site-footer">
	<div class="container">
		<div class="footer-brand-row">
			<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo freshfold_image( 'freshfold-logo.jpg' ); ?>" alt="">
				<span><strong>Fresh Fold</strong><small>ALTOONA<br>PICKUP & DELIVERY</small></span>
			</a>
			<p><?php esc_html_e( 'We Pick Up. We Wash. We Care. We Deliver.', 'freshfold' ); ?></p>
		</div>
		<div class="footer-grid">
			<section class="footer-section">
				<h2><?php esc_html_e( 'Fresh Fold Laundry Delivery Altoona', 'freshfold' ); ?></h2>
				<p><?php esc_html_e( 'Reliable laundry pickup and delivery for busy homes, students, businesses, and Airbnb hosts in Central PA.', 'freshfold' ); ?></p>
				<p><a href="tel:+15704947523">Call/Text 570-494-7523</a></p>
				<p><a href="mailto:info@freshfoldaltoona.com">info@freshfoldaltoona.com</a></p>
				<p><?php esc_html_e( 'Serving Altoona, State College, Lock Haven, Blair County, and nearby Central PA routes.', 'freshfold' ); ?></p>
			</section>
			<section class="footer-section">
				<h2><?php esc_html_e( 'Explore', 'freshfold' ); ?></h2>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'fallback_cb'    => 'freshfold_menu_fallback',
					)
				);
				?>
			</section>
			<section class="footer-section">
				<h2><?php esc_html_e( 'Service Areas', 'freshfold' ); ?></h2>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Altoona & Blair County</a></li>
					<li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">State College & Centre County</a></li>
					<li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Lock Haven</a></li>
				</ul>
			</section>
		</div>
		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> Fresh Fold Altoona. <?php esc_html_e( 'All rights reserved.', 'freshfold' ); ?></p>
			<a href="<?php echo esc_url( get_privacy_policy_url() ?: home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'freshfold' ); ?></a>
		</div>
	</div>
</footer>
<a class="call-float" href="tel:+15704947523"><span aria-hidden="true">☎</span><span><?php esc_html_e( 'Call us', 'freshfold' ); ?></span></a>
<?php wp_footer(); ?>
</body>
</html>
