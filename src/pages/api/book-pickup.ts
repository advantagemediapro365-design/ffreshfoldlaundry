import type { APIRoute } from 'astro';
import { buildCheckoutUrl, calculatePickupQuote, submitPickupBooking } from '../../lib/wix';

export const POST: APIRoute = async ({ request }) => {
  const formData = await request.formData();
  const booking = Object.fromEntries(formData.entries()) as Record<string, unknown>;
  const quote = calculatePickupQuote(booking);
  booking.quotedWeight = quote.weight;
  booking.quotedLaundryRate = quote.laundryRate;
  booking.quotedAddOns = quote.addOns;
  booking.finalTotal = quote.total;
  const result = await submitPickupBooking(booking);

  const checkoutUrl = buildCheckoutUrl({
    plan: String(booking.plan || ''),
    mode: 'pickup',
    booking,
  });

  if (checkoutUrl) {
    return Response.redirect(checkoutUrl, 303);
  }

  const redirectUrl = new URL('/book-pickup', request.url);
  redirectUrl.searchParams.set('status', result.ok ? 'success' : 'error');
  redirectUrl.searchParams.set('message', result.message);

  return Response.redirect(redirectUrl.toString(), 303);
};
