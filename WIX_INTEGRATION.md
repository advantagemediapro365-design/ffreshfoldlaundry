# Wix Integration Setup

## Required environment variables
Add these to your local environment and deployment settings:

- `WIX_SITE_ID`
- `WIX_API_TOKEN`
- `WIX_SUBSCRIPTION_PLANS_COLLECTION` (default: `subscriptionPlans`)
- `WIX_PICKUP_BOOKINGS_COLLECTION` (default: `pickupBookings`)
- `WIX_PAYMENT_URL`
- `WIX_PAYMENT_SUCCESS_URL`
- `WIX_PAYMENT_CANCEL_URL`

The pickup flow calculates and sends `finalTotal`, `quotedWeight`, and itemized add-on values to `WIX_PAYMENT_URL`. Configure that checkout destination to use `finalTotal` as the charge amount (and do not replace it with a fixed product price), so the online charge matches the quote shown to the customer.

For Wix Payments, set `WIX_PAYMENT_URL` to your Wix checkout or product/plan URL. The site will redirect subscription and pickup requests there when the env var is present.

## Wix CMS collections to create

### 1. `subscriptionPlans`
Use this collection for subscription plan content.
Suggested fields:
- `title`
- `slug`
- `price`
- `includedPounds`
- `description`
- `overage`
- `delivery`
- `idealFor`
- `featured`
- `ctaLabel`
- `href`

### 2. `pickupBookings`
Use this collection to store pickup requests.
Suggested fields:
- `plan`
- `customerType`
- `fullName`
- `phone`
- `email`
- `zipCode`
- `laundryType`
- `estimatedWeight`
- `customWeight`
- `pickupWindow`
- `hypoallergenicDetergent`
- `scentBooster`
- `separateWhitesColors`
- `hangDry`
- `hangDryItems`
- `quotedWeight`
- `quotedLaundryRate`
- `quotedAddOns`
- `finalTotal`
- `status`
- `submittedAt`
- `source`

## Notes
- The booking page will still work in fallback mode locally if Wix env vars are not configured.
- For full production usage, configure a real Wix API token and collections in the Wix dashboard.
