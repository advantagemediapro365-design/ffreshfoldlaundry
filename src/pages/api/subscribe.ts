import type { APIRoute } from 'astro';
import { buildCheckoutUrl } from '../../lib/wix';

const planPrices: Record<string, number> = {
	'student-plan': 79,
	'weekly-household-plan': 129,
	'family-plan': 199,
  'route-plus-plan': 299,
};

export const POST: APIRoute = async ({ request }) => {
  const subscription = Object.fromEntries(await (await request.formData()).entries()) as Record<string, unknown>;
  const plan = String(subscription.plan || '');
  const monthlyPrice = planPrices[plan];
  if (!monthlyPrice) return Response.redirect(new URL('/subscribe?status=error&message=Please+choose+a+valid+subscription+plan.', request.url), 303);

  const total = monthlyPrice + (subscription.deliveryPass ? 7.99 : 0);
  subscription.monthlyTotal = total.toFixed(2);
  subscription.planPrice = monthlyPrice.toFixed(2);
  const checkoutUrl = buildCheckoutUrl({ plan, mode: 'subscription', booking: subscription });
  if (checkoutUrl) return Response.redirect(checkoutUrl, 303);

  const fallback = new URL('/subscribe', request.url);
  fallback.searchParams.set('plan', plan);
  fallback.searchParams.set('status', 'error');
  fallback.searchParams.set('message', 'Online checkout is not configured yet. Please use WhatsApp or email to start your plan.');
  return Response.redirect(fallback, 303);
};
