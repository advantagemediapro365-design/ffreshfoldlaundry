import type { APIRoute } from 'astro';
import { buildCheckoutUrl } from '../../lib/wix';

export const GET: APIRoute = async ({ request, url }) => {
  const plan = url.searchParams.get('plan') ?? '';
  const mode = url.searchParams.get('mode') ?? 'subscription';
  const checkoutUrl = buildCheckoutUrl({ plan, mode });

  if (checkoutUrl) {
    return Response.redirect(checkoutUrl, 303);
  }

  const fallbackUrl = new URL('/book-pickup', request.url);
  fallbackUrl.searchParams.set('plan', plan);
  fallbackUrl.searchParams.set('checkout', 'true');
  return Response.redirect(fallbackUrl.toString(), 303);
};
