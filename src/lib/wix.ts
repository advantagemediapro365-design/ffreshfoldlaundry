export type SubscriptionPlan = {
  id: string;
  title: string;
  slug: string;
  price: string;
  includedPounds: string;
  description: string;
  overage: string;
  delivery: string;
  idealFor: string;
  featured?: boolean;
  ctaLabel: string;
  href: string;
};

export type PickupQuote = {
  weight: number;
  laundryRate: number;
  pickupAndDelivery: number;
  addOns: number;
  total: number;
};

export type BookingValidation = {
  ok: boolean;
  message?: string;
};

const asPositiveNumber = (value: unknown, fallback = 0) => {
  const number = Number(value);
  return Number.isFinite(number) && number > 0 ? number : fallback;
};

/** Calculates the customer-facing pickup total on the server. Never trust a browser-submitted total. */
export function calculatePickupQuote(booking: Record<string, unknown>): PickupQuote {
  const selectedWeight = String(booking.estimatedWeight || '20');
  const weight = selectedWeight === 'custom'
    ? asPositiveNumber(booking.customWeight, 20)
    : asPositiveNumber(selectedWeight, 20);
  const safeWeight = Math.min(weight, 1000);
  const has = (name: string) => Boolean(booking[name]);
  const hangDryItems = has('hangDry') ? Math.min(asPositiveNumber(booking.hangDryItems, 1), 100) : 0;
  const laundryRate = safeWeight * 1.89;
  const pickupAndDelivery = 3.8;
  const addOns = (has('hypoallergenicDetergent') ? safeWeight * 0.25 : 0)
    + (has('scentBooster') ? 3 : 0)
    + (has('separateWhitesColors') ? 5 : 0)
    + hangDryItems;
  const total = laundryRate + pickupAndDelivery + addOns;

  return {
    weight: safeWeight,
    laundryRate: Number(laundryRate.toFixed(2)),
    pickupAndDelivery,
    addOns: Number(addOns.toFixed(2)),
    total: Number(total.toFixed(2)),
  };
}

export function validatePickupBooking(booking: Record<string, unknown>): BookingValidation {
  const requiredFields = ['fullName', 'phone', 'email', 'pickupAddress', 'zipCode', 'pickupWindow'];
  const missing = requiredFields.find((field) => !String(booking[field] ?? '').trim());
  if (missing) return { ok: false, message: 'Please complete all required pickup details.' };
  if (booking.policyConsent !== 'on') return { ok: false, message: 'Please agree to the required policies before submitting your pickup request.' };
  if (!/^\S+@\S+\.\S+$/.test(String(booking.email).trim())) return { ok: false, message: 'Please enter a valid email address.' };
  if (!/^\d{5}$/.test(String(booking.zipCode).trim())) return { ok: false, message: 'Please enter a valid 5-digit ZIP code.' };
  const selectedWeight = String(booking.estimatedWeight || '');
  const weight = selectedWeight === 'custom' ? Number(booking.customWeight) : Number(selectedWeight);
  if (!Number.isFinite(weight) || weight <= 0 || weight > 1000) return { ok: false, message: 'Please enter a laundry estimate between 1 and 1,000 pounds.' };
  return { ok: true };
}

const fallbackPlans: SubscriptionPlan[] = [
  {
    id: 'student-plan',
		title: 'Fresh Starter',
    slug: 'student-plan',
		price: '$79/month',
		includedPounds: '40 lb/month',
		description: 'Great for individuals and light laundry loads.',
		overage: '$1.75/lb',
		delivery: '$0 base + $1.25/round-trip mile',
		idealFor: 'Individuals and light loads',
		ctaLabel: 'Start Fresh Starter',
    href: '/api/checkout?plan=student-plan&mode=subscription',
  },
  {
    id: 'weekly-household-plan',
		title: 'Fresh Weekly',
    slug: 'weekly-household-plan',
		price: '$129/month',
		includedPounds: '75 lb/month',
		description: 'Ideal for busy professionals and couples.',
		overage: '$1.65/lb',
		delivery: '$0 base + $1.25/round-trip mile',
		idealFor: 'Busy professionals and couples',
		ctaLabel: 'Start Fresh Weekly',
    href: '/api/checkout?plan=weekly-household-plan&mode=subscription',
  },
  {
    id: 'family-plan',
		title: 'Fresh Family',
    slug: 'family-plan',
		price: '$199/month',
		includedPounds: '125 lb/month',
		description: 'For families with bigger laundry needs.',
		overage: '$1.55/lb',
		delivery: '$0 base + $1.25/round-trip mile',
		idealFor: 'Families with bigger laundry needs',
    ctaLabel: 'Start Family Plan',
    href: '/api/checkout?plan=family-plan&mode=subscription',
  },
  {
    id: 'route-plus-plan',
		title: 'Fresh Route Plus',
    slug: 'route-plus-plan',
    price: '$299/month',
    includedPounds: '200 lb/month',
		description: 'For high-volume homes, shared houses, and recurring heavy users.',
    overage: '$1.50/lb',
		delivery: '$0 base + $1.25/round-trip mile',
    idealFor: 'High-volume homes and shared houses',
    featured: true,
    ctaLabel: 'Start Route Plus',
    href: '/api/checkout?plan=route-plus-plan&mode=subscription',
  },
];

export function buildCheckoutUrl({
  plan = '',
  mode = 'subscription',
  booking = {},
}: {
  plan?: string;
  mode?: string;
  booking?: Record<string, unknown>;
} = {}) {
  const checkoutBaseUrl = String(import.meta.env.WIX_PAYMENT_URL || '');
  if (!checkoutBaseUrl) {
    return '';
  }

  const url = new URL(checkoutBaseUrl);
  if (plan) {
    url.searchParams.set('plan', plan);
  }
  if (mode) {
    url.searchParams.set('mode', mode);
  }

  Object.entries(booking).forEach(([key, value]) => {
    if (value !== undefined && value !== null && value !== '') {
      url.searchParams.set(key, String(value));
    }
  });

  return url.toString();
}

function normalizePlan(item: Record<string, unknown>, index: number): SubscriptionPlan {
  return {
    id: String(item._id ?? item.id ?? `${item.slug ?? 'plan'}-${index}`),
    title: String(item.title ?? item.planName ?? fallbackPlans[index]?.title ?? 'Subscription Plan'),
    slug: String(item.slug ?? item.planSlug ?? fallbackPlans[index]?.slug ?? 'plan'),
    price: String(item.price ?? item.monthlyPrice ?? fallbackPlans[index]?.price ?? '$0/month'),
    includedPounds: String(item.includedPounds ?? item.includedLaundry ?? fallbackPlans[index]?.includedPounds ?? '0 lb/month'),
    description: String(item.description ?? item.summary ?? fallbackPlans[index]?.description ?? 'Wix CMS plan description'),
    overage: String(item.overage ?? item.overagePrice ?? fallbackPlans[index]?.overage ?? 'Contact us'),
    delivery: String(item.delivery ?? item.deliveryDetails ?? fallbackPlans[index]?.delivery ?? 'Separate'),
    idealFor: String(item.idealFor ?? fallbackPlans[index]?.idealFor ?? 'Customers who need recurring service'),
    featured: Boolean(item.featured ?? fallbackPlans[index]?.featured ?? false),
    ctaLabel: String(item.ctaLabel ?? fallbackPlans[index]?.ctaLabel ?? 'Start this plan'),
    href: String(item.href ?? `${fallbackPlans[index]?.href ?? '/api/checkout'}?plan=${encodeURIComponent(String(item.slug ?? item.planSlug ?? fallbackPlans[index]?.slug ?? 'plan'))}`),
  };
}

export async function getSubscriptionPlans(): Promise<SubscriptionPlan[]> {
  const collectionName = String(import.meta.env.WIX_SUBSCRIPTION_PLANS_COLLECTION || 'subscriptionPlans');
  const accessToken = String(import.meta.env.WIX_API_TOKEN || import.meta.env.WIX_ACCESS_TOKEN || import.meta.env.WIX_API_KEY || '');
  const siteId = String(import.meta.env.WIX_SITE_ID || '');

  if (!accessToken || !siteId) {
    return fallbackPlans;
  }

  try {
    const response = await fetch('https://www.wixapis.com/wix-data/v1/items/query', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${accessToken}`,
        'wix-site-id': siteId,
      },
      body: JSON.stringify({
        query: {
          collectionId: collectionName,
        },
      }),
    });

    if (!response.ok) {
      throw new Error(`Wix CMS request failed with ${response.status}`);
    }

    const payload = await response.json();
    const items = Array.isArray(payload?.items) ? payload.items : [];
    if (items.length > 0) {
      return items.map((item, index) => normalizePlan(item as Record<string, unknown>, index));
    }
  } catch (error) {
    console.error('Unable to load Wix subscription plans', error);
  }

  return fallbackPlans;
}

export async function submitPickupBooking(booking: Record<string, unknown>) {
  const collectionName = String(import.meta.env.WIX_PICKUP_BOOKINGS_COLLECTION || 'pickupBookings');
  const accessToken = String(import.meta.env.WIX_API_TOKEN || import.meta.env.WIX_ACCESS_TOKEN || import.meta.env.WIX_API_KEY || '');
  const siteId = String(import.meta.env.WIX_SITE_ID || '');

  if (!accessToken || !siteId) {
    return {
      ok: false,
      message: 'Wix booking storage is not configured yet. Please contact us while the booking connection is being completed.',
      mode: 'fallback' as const,
    };
  }

  try {
    const response = await fetch('https://www.wixapis.com/wix-data/v1/items', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${accessToken}`,
        'wix-site-id': siteId,
      },
      body: JSON.stringify({
        item: {
          ...booking,
          policyConsent: undefined,
          policyConsentAt: new Date().toISOString(),
          submittedAt: new Date().toISOString(),
          status: 'new',
          source: 'fresh-fold-site',
        },
        collectionId: collectionName,
      }),
    });

    if (!response.ok) {
      throw new Error(`Wix booking submission failed with ${response.status}`);
    }

    const payload = await response.json();

    return {
      ok: true,
      message: 'Thanks! Your pickup request was sent to your Wix-connected booking collection.',
      bookingId: String(payload?.item?._id ?? ''),
      mode: 'wix' as const,
    };
  } catch (error) {
    console.error('Unable to submit pickup booking to Wix', error);
    return {
      ok: false,
      message: 'We could not reach your Wix booking collection right now. Please contact us directly.',
      mode: 'error' as const,
    };
  }
}
