<?php
/**
 * Fresh Fold theme setup and site integrations.
 *
 * @package FreshFold
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function freshfold_setup() {
	load_theme_textdomain( 'freshfold', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 180,
			'width'       => 180,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'freshfold' ),
			'footer'  => __( 'Footer navigation', 'freshfold' ),
		)
	);
}
add_action( 'after_setup_theme', 'freshfold_setup' );

function freshfold_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'freshfold-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'freshfold-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'freshfold-main', get_template_directory_uri() . '/assets/css/main.css', array( 'freshfold-style' ), $theme_version );
	wp_enqueue_script( 'freshfold-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true );
	wp_localize_script(
		'freshfold-main',
		'freshFoldSettings',
		array(
			'serviceAreaUrl' => rest_url( 'freshfold/v1/service-area' ),
			'nonce'          => wp_create_nonce( 'wp_rest' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'freshfold_enqueue_assets' );

function freshfold_image( $filename ) {
	return esc_url( get_template_directory_uri() . '/assets/images/' . $filename );
}

function freshfold_menu_fallback() {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	$links = array(
		'Home'          => home_url( '/' ),
		'Pricing'       => home_url( '/pricing/' ),
		'Subscriptions' => home_url( '/subscriptions/' ),
		'Commercial'    => home_url( '/commercial-laundry/' ),
		'Service Areas' => home_url( '/service-areas/' ),
		'Blog'          => $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' ),
		'Contact'       => home_url( '/contact/' ),
	);

	echo '<ul class="menu">';
	foreach ( $links as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

function freshfold_register_service_area_route() {
	register_rest_route(
		'freshfold/v1',
		'/service-area',
		array(
			'methods'             => 'GET',
			'callback'            => 'freshfold_check_service_area',
			'permission_callback' => '__return_true',
			'args'                => array(
				'zip' => array(
					'required'          => true,
					'sanitize_callback' => 'sanitize_text_field',
				),
			),
		)
	);
}
add_action( 'rest_api_init', 'freshfold_register_service_area_route' );

function freshfold_check_service_area( WP_REST_Request $request ) {
	$zip = trim( (string) $request->get_param( 'zip' ) );
	if ( ! preg_match( '/^\d{5}$/', $zip ) ) {
		return new WP_REST_Response(
			array(
				'status'  => 'invalid',
				'label'   => __( 'Check needed', 'freshfold' ),
				'summary' => __( 'Please enter a valid 5-digit ZIP code so we can check availability.', 'freshfold' ),
			),
			200
		);
	}

	$active_zips = array(
		'16601' => 'Altoona',
		'16602' => 'Altoona',
		'16801' => 'State College',
		'16802' => 'State College',
		'16803' => 'State College',
	);
	$route_zips = array(
		'16823' => 'Bellefonte',
		'16827' => 'Boalsburg',
		'16851' => 'Lemont',
		'16853' => 'Milesburg',
		'16865' => 'Pennsylvania Furnace',
		'16868' => 'Pine Grove Mills',
		'16870' => 'Port Matilda',
		'16877' => 'Warriors Mark',
		'16686' => 'Tyrone',
		'16635' => 'Duncansville',
		'16648' => 'Hollidaysburg',
		'16617' => 'Bellwood',
		'16673' => 'Roaring Spring',
		'16662' => 'Martinsburg',
		'16625' => 'Claysburg',
		'16665' => 'Newry',
		'16641' => 'Gallitzin',
		'16630' => 'Cresson',
		'16693' => 'Williamsburg',
		'16652' => 'Huntingdon',
		'17726' => 'Castanea',
		'17748' => 'McElhattan',
		'17751' => 'Mill Hall',
	);

	if ( in_array( $zip, array( '16603', '16804', '16805' ), true ) ) {
		$result = array(
			'status'  => 'waitlist',
			'label'   => __( 'Physical address needed', 'freshfold' ),
			'summary' => __( 'This ZIP is associated with a P.O. Box. Please use the ZIP code for your physical pickup address.', 'freshfold' ),
		);
	} elseif ( isset( $active_zips[ $zip ] ) ) {
		$city   = $active_zips[ $zip ];
		$result = array(
			'status'  => 'active',
			'label'   => sprintf( __( '%s — active service', 'freshfold' ), $city ),
			'summary' => sprintf( __( '%s is in our coverage area. Call us at 570-494-7523 to schedule your pickup.', 'freshfold' ), $city ),
		);
	} elseif ( '17745' === $zip ) {
		$result = array(
			'status'  => 'weekly',
			'label'   => __( 'Lock Haven — weekly route', 'freshfold' ),
			'summary' => __( 'Lock Haven is in our coverage area. Call us at 570-494-7523 to confirm the next available route.', 'freshfold' ),
		);
	} elseif ( isset( $route_zips[ $zip ] ) ) {
		$result = array(
			'status'  => 'route',
			'label'   => sprintf( __( '%s — route-based', 'freshfold' ), $route_zips[ $zip ] ),
			'summary' => __( 'You are in our coverage area. Call us at 570-494-7523 to confirm the next available pickup route.', 'freshfold' ),
		);
	} else {
		$result = array(
			'status'  => 'waitlist',
			'label'   => __( 'Not on our route yet?', 'freshfold' ),
			'summary' => __( 'We are growing coverage. Contact us to ask about joining the waitlist.', 'freshfold' ),
		);
	}

	return new WP_REST_Response( $result, 200 );
}

function freshfold_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'freshfold-home';
	}
	return $classes;
}
add_filter( 'body_class', 'freshfold_body_classes' );
