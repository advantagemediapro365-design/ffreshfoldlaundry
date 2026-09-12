import type { APIRoute } from 'astro';
import { buildCheckoutUrl, calculatePickupQuote, submitPickupBooking, validatePickupBooking } from '../../lib/wix';
import { getZipAvailability } from '../../lib/zipAvailability.js';

export const POST: APIRoute = async ({ request }) => {
  const formData = await request.formData();
  const booking = Object.fromEntries(formData.entries()) as Record<string, unknown>;
  const validation = validatePickupBooking(booking);
  const availability = getZipAvailability(booking.zipCode);
  if (!validation.ok || availability.status === 'invalid' || availability.status === 'waitlist') {
    const redirectUrl = new URL('/book-pickup', request.url);
    redirectUrl.searchParams.set('status', 'error');
    redirectUrl.searchParams.set('message', validation.message ?? (availability.status === 'waitlist' ? 'That ZIP code is not currently available for online booking. Please contact us to confirm a route or join the waitlist.' : availability.summary));
    return Response.redirect(redirectUrl.toString(), 303);
  }
  const quote = calculatePickupQuote(booking);
  booking.quotedWeight = quote.weight;
  booking.quotedLaundryRate = quote.laundryRate;
  booking.quotedAddOns = quote.addOns;
  booking.finalTotal = quote.total;
  const result = await submitPickupBooking(booking);

  if (!result.ok) {
    const redirectUrl = new URL('/book-pickup', request.url);
    redirectUrl.searchParams.set('status', 'error');
    redirectUrl.searchParams.set('message', result.message);
    return Response.redirect(redirectUrl.toString(), 303);
  }

  const checkoutUrl = buildCheckoutUrl({
    plan: String(booking.plan || ''),
    mode: 'pickup',
    booking: {
      finalTotal: booking.finalTotal,
      quotedWeight: booking.quotedWeight,
      bookingId: 'bookingId' in result ? result.bookingId : '',
    },
  });

  if (checkoutUrl) {
    return Response.redirect(checkoutUrl, 303);
  }

  const redirectUrl = new URL('/book-pickup', request.url);
  redirectUrl.searchParams.set('status', result.ok ? 'success' : 'error');
  redirectUrl.searchParams.set('message', result.message);

  return Response.redirect(redirectUrl.toString(), 303);
};
