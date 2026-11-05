Fresh Fold Laundry WordPress Theme
==================================

This installable WordPress theme recreates the Fresh Fold Laundry Delivery Altoona site's visual style: navy and aqua colors, responsive navigation, laundry service cards, pickup and delivery calls to action, service-area ZIP checker, pricing highlights, and a mobile-friendly layout.

Install
-------
1. Zip the `freshfold` folder, or upload it to `wp-content/themes/freshfold/`.
2. In WordPress, open Appearance > Themes and activate "Fresh Fold Laundry".
3. Set the site title under Settings > General. Optionally add a custom logo under Appearance > Customize > Site Identity.
4. Create WordPress pages with these slugs to use the included custom layouts: `pricing`, `subscriptions`, `commercial-laundry`, `service-areas`, `contact`, and `blog`. Keep the page content in place; the theme renders these pages using their structured content and the matching responsive styles.
5. Under Appearance > Menus, create a primary menu and assign it to "Primary navigation". Optionally assign another menu to "Footer navigation".
6. Publish articles as WordPress posts. The `blog` page displays published posts automatically and shows a coming-soon message when there are none. Do not set it as the Posts page in Settings > Reading; it must remain a regular page for its custom layout.

The home page is supplied by `front-page.php` at the site root. Use Settings > Reading to choose whether WordPress should show a static front page or the latest posts on the site root.

The ZIP checker reports the current route availability and directs customers to call for route confirmation. Booking, payment, subscriptions, analytics, cookie consent, and contact forms must be connected to the provider or plugins selected for the live WordPress site; this theme does not submit orders or collect customer details.

Image assets are bundled in `assets/images/` and are served locally from the active theme.
