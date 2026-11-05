<?php
/**
 * Homepage.
 *
 * @package FreshFold
 */
get_header();
$services = array(
	array( 'Residential', 'Everyday laundry', 'residential.png', '/book-pickup/' ),
	array( 'Student Laundry', 'Dorm & apartment', 'student-laundry-service.png', '/book-pickup/' ),
	array( 'Commercial', 'Businesses of all sizes', 'commercial.png', '/commercial-laundry/' ),
	array( 'Airbnb / STR', 'Short-term rentals', 'airbnb.png', '/commercial-laundry/' ),
	array( 'Salon & Spa', 'Towels & linens', 'salonspa.png', '/commercial-laundry/' ),
	array( 'Restaurant', 'Table linens & towels', 'restaurant.png', '/commercial-laundry/' ),
	array( 'Gym & Fitness', 'Towels & gear', 'gym-fitness-laundry.png', '/commercial-laundry/' ),
);
?>
<section class="home-hero">
	<div class="container hero-grid">
		<div class="hero-copy">
			<p class="eyebrow"><?php esc_html_e( 'LOCAL. RELIABLE. TRUSTED.', 'freshfold' ); ?></p>
			<h1><?php esc_html_e( 'Laundry Pickup & Delivery in Altoona, PA', 'freshfold' ); ?></h1>
			<p class="lead"><?php esc_html_e( 'Skip the laundromat. We pick up your laundry, wash, dry, fold and deliver it back clean and ready to put away. Check your ZIP code for route availability.', 'freshfold' ); ?></p>
			<div class="trust">
				<span aria-hidden="true">◎<b><?php esc_html_e( 'Convenient Pickup & Delivery', 'freshfold' ); ?></b></span>
				<span aria-hidden="true">♡<b><?php esc_html_e( 'Professional Care', 'freshfold' ); ?></b></span>
				<span aria-hidden="true">◷<b><?php esc_html_e( 'On-Time Every Time', 'freshfold' ); ?></b></span>
				<span aria-hidden="true">⌂<b><?php esc_html_e( 'Locally Owned', 'freshfold' ); ?></b></span>
			</div>
			<div class="hero-actions">
				<a class="button button-primary" href="<?php echo esc_url( home_url( '/book-pickup/' ) ); ?>">▣ <?php esc_html_e( 'Book My Pickup', 'freshfold' ); ?></a>
				<a class="button button-secondary" href="sms:+15704947523?body=Fresh%20Fold%20pickup%20request">☎ <?php esc_html_e( 'Text to Book', 'freshfold' ); ?></a>
				<a class="button button-secondary" href="tel:+15704947523">☎ <?php esc_html_e( 'Call 570-494-7523', 'freshfold' ); ?></a>
			</div>
			<p class="tnt">♥ <?php esc_html_e( 'Delivered by TNT Deliveries', 'freshfold' ); ?> <i><?php esc_html_e( 'Don’t forget to tip your delivery driver!', 'freshfold' ); ?></i></p>
		</div>
		<div class="hero-img">
			<img src="<?php echo freshfold_image( 'freshfold-home-hero.png' ); ?>" alt="<?php esc_attr_e( 'FreshFold laundry pickup and delivery service in Altoona, Pennsylvania', 'freshfold' ); ?>">
			<div class="price-badge"><?php esc_html_e( 'STANDARD SERVICE', 'freshfold' ); ?><strong>$1.89</strong><small><?php esc_html_e( 'PER POUND · Wash · Dry · Fold', 'freshfold' ); ?></small></div>
			<form class="zipbox" action="#" method="get" data-service-area-form>
				<h2><?php esc_html_e( '⌖ Check Your ZIP & Book Now', 'freshfold' ); ?></h2>
				<div class="zip-input-row">
					<label class="screen-reader-text" for="hero-zipcode"><?php esc_html_e( 'Enter your ZIP code', 'freshfold' ); ?></label>
					<input id="hero-zipcode" name="zipcode" placeholder="<?php esc_attr_e( 'Enter your ZIP code', 'freshfold' ); ?>" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" required>
					<button type="submit" aria-label="<?php esc_attr_e( 'Check ZIP code', 'freshfold' ); ?>">→</button>
				</div>
				<ul>
					<li><?php esc_html_e( 'See if we service your area', 'freshfold' ); ?></li>
					<li><?php esc_html_e( 'Choose your pickup date & time', 'freshfold' ); ?></li>
					<li><?php esc_html_e( 'Select your laundry preferences', 'freshfold' ); ?></li>
					<li><?php esc_html_e( 'Confirm and relax', 'freshfold' ); ?></li>
				</ul>
				<p class="plan-start"><?php esc_html_e( 'Plans starting at', 'freshfold' ); ?> <strong>$79/month</strong> + delivery</p>
				<p class="zipbox-result" role="status" aria-live="polite"></p>
			</form>
		</div>
	</div>
</section>

<section class="service-strip" aria-label="<?php esc_attr_e( 'Laundry services', 'freshfold' ); ?>">
	<div class="container service-grid">
		<?php foreach ( $services as $service ) : ?>
			<a href="<?php echo esc_url( home_url( $service[3] ) ); ?>">
				<img src="<?php echo freshfold_image( $service[2] ); ?>" alt="" loading="lazy">
				<b><?php echo esc_html( $service[0] ); ?></b>
				<small><?php echo esc_html( $service[1] ); ?></small>
			</a>
		<?php endforeach; ?>
	</div>
</section>

<section class="container twin section-space">
	<article class="card how-card">
		<h2><?php esc_html_e( 'How It Works', 'freshfold' ); ?></h2>
		<div class="how">
			<span><b>1</b><?php esc_html_e( 'Book', 'freshfold' ); ?><small><?php esc_html_e( 'Call, text or book online.', 'freshfold' ); ?></small></span><i aria-hidden="true">→</i>
			<span><b>2</b><?php esc_html_e( 'Pickup', 'freshfold' ); ?><small><?php esc_html_e( 'We collect your laundry.', 'freshfold' ); ?></small></span><i aria-hidden="true">→</i>
			<span><b>3</b><?php esc_html_e( 'Wash & Fold', 'freshfold' ); ?><small><?php esc_html_e( 'We clean with care.', 'freshfold' ); ?></small></span><i aria-hidden="true">→</i>
			<span><b>4</b><?php esc_html_e( 'Deliver', 'freshfold' ); ?><small><?php esc_html_e( 'Clean laundry returns to you.', 'freshfold' ); ?></small></span>
		</div>
	</article>
	<article class="card why-card">
		<div>
			<h2><?php esc_html_e( 'Why Choose Fresh Fold?', 'freshfold' ); ?></h2>
			<ul class="check-list">
				<li><?php esc_html_e( 'Local & Reliable', 'freshfold' ); ?></li>
				<li><?php esc_html_e( 'On-Time, Every Time', 'freshfold' ); ?></li>
				<li><?php esc_html_e( 'Care in Every Load', 'freshfold' ); ?></li>
				<li><?php esc_html_e( 'Easy Online Booking', 'freshfold' ); ?></li>
				<li><?php esc_html_e( 'Supporting Local Communities', 'freshfold' ); ?></li>
			</ul>
		</div>
		<img src="<?php echo freshfold_image( 'fresh-fold-laundry-care.png' ); ?>" alt="<?php esc_attr_e( 'Fresh Fold cares for every load', 'freshfold' ); ?>" loading="lazy">
	</article>
</section>

<section class="container offers section-space">
	<article class="price-box card">
		<h2><?php esc_html_e( 'Simple, Transparent Pricing', 'freshfold' ); ?></h2>
		<p><?php esc_html_e( 'No hidden fees. See exactly what you’ll pay.', 'freshfold' ); ?></p>
		<div class="price-details">
			<section><h3><?php esc_html_e( 'Laundry Processing', 'freshfold' ); ?></h3><b>$1.89 <small>/ lb</small></b><p><?php esc_html_e( 'Wash · Dry · Fold', 'freshfold' ); ?></p></section>
			<section><h3><?php esc_html_e( 'Delivery (TNT Deliveries)', 'freshfold' ); ?></h3><strong>$3.80 <?php esc_html_e( 'base dispatch fee', 'freshfold' ); ?></strong><p>+ $1.75 <?php esc_html_e( 'per round-trip mile', 'freshfold' ); ?></p></section>
			<section><h3><?php esc_html_e( 'Subscriptions Start at', 'freshfold' ); ?></h3><b>$79 <small>/ month</small></b><p>40 lb/month · 2 pickups</p><a href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>"><?php esc_html_e( 'View All Plans', 'freshfold' ); ?></a></section>
		</div>
		<a class="button button-primary" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'View Pricing', 'freshfold' ); ?> →</a>
	</article>
	<div class="offer-notes">
		<article class="card referral"><h2><?php esc_html_e( 'Know Someone Nearby Who Needs Laundry Done Too?', 'freshfold' ); ?></h2><p><?php esc_html_e( 'Book together and ask about shared-route savings.', 'freshfold' ); ?></p></article>
		<article class="card warning"><h2>△ <?php esc_html_e( 'Empty All Pockets Before Pickup', 'freshfold' ); ?></h2><p><?php esc_html_e( 'No flammable, hazardous, illegal, sharp or unsafe items. Significant messes or safety hazards may result in a $25 charge.', 'freshfold' ); ?></p></article>
	</div>
</section>

<section class="container area section-space">
	<article class="card area-card">
		<h2><?php esc_html_e( 'Our Service Areas', 'freshfold' ); ?></h2>
		<p><?php esc_html_e( 'Altoona · State College · Lock Haven · Blair County & surrounding areas', 'freshfold' ); ?></p>
		<div class="area-layout">
			<img src="<?php echo freshfold_image( 'servicearea.png' ); ?>" alt="<?php esc_attr_e( 'Central Pennsylvania service-area map', 'freshfold' ); ?>" loading="lazy">
			<div class="area-regions">
				<section><h3><?php esc_html_e( 'Active service', 'freshfold' ); ?></h3><p><b>Altoona</b> 16601, 16602</p><p><b>State College</b> 16801, 16802, 16803</p></section>
				<section><h3><?php esc_html_e( 'Weekly route', 'freshfold' ); ?></h3><p><b>Lock Haven</b> 17745</p></section>
				<section><h3><?php esc_html_e( 'Route-based service', 'freshfold' ); ?></h3><p><?php esc_html_e( 'Many communities in Blair and Centre counties. Check your ZIP to confirm availability.', 'freshfold' ); ?></p></section>
				<a class="button button-primary" href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"><?php esc_html_e( 'View Full Service Area', 'freshfold' ); ?> →</a>
			</div>
		</div>
	</article>
	<aside class="card quick-links"><h2><?php esc_html_e( 'Quick Links', 'freshfold' ); ?></h2>
		<a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'Pricing & Delivery', 'freshfold' ); ?></a>
		<a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"><?php esc_html_e( 'Service Areas', 'freshfold' ); ?></a>
		<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Laundry Tips', 'freshfold' ); ?></a>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'freshfold' ); ?></a>
		<a href="<?php echo esc_url( home_url( '/book-pickup/' ) ); ?>"><?php esc_html_e( 'Book Your Pickup', 'freshfold' ); ?></a>
	</aside>
</section>

<section class="container home-faq section-space">
	<h2><?php esc_html_e( 'Laundry pickup and delivery FAQs', 'freshfold' ); ?></h2>
	<details><summary><?php esc_html_e( 'How much does laundry delivery cost in Altoona?', 'freshfold' ); ?></summary><p><?php esc_html_e( 'Standard wash, dry, and fold processing is $1.89 per pound. Delivery costs $3.80 for the base dispatch fee plus $1.75 per round-trip mile. Your final delivery charge depends on the route distance.', 'freshfold' ); ?></p></details>
	<details><summary><?php esc_html_e( 'Do you offer same-day laundry pickup?', 'freshfold' ); ?></summary><p><?php esc_html_e( 'Same-day service may be available on eligible routes, subject to scheduling and capacity. Contact us or check your ZIP code to confirm.', 'freshfold' ); ?></p></details>
	<details><summary><?php esc_html_e( 'How do I know if my address is in your service area?', 'freshfold' ); ?></summary><p><?php esc_html_e( 'Enter your ZIP code in the availability checker or visit our service areas page. Route availability varies by location and schedule.', 'freshfold' ); ?></p></details>
</section>
<section class="community"><div class="container"><b><?php esc_html_e( '♥ Proudly Serving Central Pennsylvania', 'freshfold' ); ?><br><span><?php esc_html_e( 'Cleaner Clothes. Stronger Communities.', 'freshfold' ); ?></span></b><strong>▣ <?php esc_html_e( 'Delivered by TNT Deliveries', 'freshfold' ); ?></strong></div></section>
<?php get_footer(); ?>
