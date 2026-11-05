import type { APIRoute } from 'astro';

const siteUrl = 'https://freshfoldaltoona.com';
const dynamicPagePaths = [
	'/about',
	'/faq',
	'/student-laundry-service-state-college',
	'/delivery-route-policy',
	'/terms-of-service',
	'/privacy-policy',
	'/cookie-policy',
	'/refund-damage-policy',
	'/subscription-policy',
	'/pocket-heavy-soil-policy',
	'/fresh-fold-bag-policy',
	'/wash-dry-fold-service',
	'/laundry-pickup-service',
	'/same-day-laundry-service',
	'/next-day-laundry-service',
	'/senior-laundry-service',
	'/family-laundry-service',
	'/apartment-laundry-service',
	'/move-out-laundry-service',
	'/salon-spa-laundry-service',
	'/gym-laundry-service',
	'/restaurant-laundry-service',
	'/airbnb-rental-laundry-service',
	'/hotel-laundry-service',
	'/barbershop-laundry-service',
	'/massage-therapy-laundry-service',
	'/cleaning-company-laundry-service',
	'/high-volume-laundry-service',
	'/comforter-specialty-laundry',
	'/service-areas/altoona-pa',
	'/service-areas/state-college-pa',
	'/service-areas/lock-haven-pa',
	'/service-areas/blair-county-pa',
	'/service-areas/centre-county-pa',
	'/service-areas/central-pa',
];

const staticPagePaths = Object.keys(
	import.meta.glob('./**/*.astro', { eager: false }),
)
	.filter((path) => !path.includes('/api/') && !path.includes('['))
	.map((path) =>
		path
			.replace(/^\.\//, '/')
			.replace(/\/index\.astro$/, '/')
			.replace(/\.astro$/, ''),
	);

export const GET: APIRoute = () => {
	const pagePaths = [...new Set([...staticPagePaths, ...dynamicPagePaths])];
	const urls = pagePaths
		.map((path) => `\t<url><loc>${new URL(path, siteUrl).toString()}</loc></url>`)
		.join('\n');
	const xml = `<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n${urls}\n</urlset>`;

	return new Response(xml, {
		headers: {
			'Content-Type': 'application/xml; charset=utf-8',
			'Cache-Control': 'public, max-age=3600, s-maxage=3600',
		},
	});
};
