import type { APIRoute } from 'astro';
import { getZipAvailability } from '../../lib/zipAvailability.js';

export const GET: APIRoute = ({ url }) => {
	const availability = getZipAvailability(url.searchParams.get('zip'));
	return new Response(JSON.stringify(availability), {
		headers: { 'Content-Type': 'application/json; charset=utf-8' },
	});
};
