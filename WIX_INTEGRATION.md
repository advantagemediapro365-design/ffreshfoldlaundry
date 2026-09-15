# Wix Integration Setup

## Required environment variables
Add these to your local environment and deployment settings:

- `WIX_SITE_ID`
- `WIX_API_TOKEN`
- `WIX_SUBSCRIPTION_PLANS_COLLECTION` (default: `subscriptionPlans`)
- `WIX_PICKUP_BOOKINGS_COLLECTION` (default: `pickupBookings`)
- `WIX_CONTACT_MESSAGES_COLLECTION` (default: `contactMessages`)
- `WIX_PAYMENT_URL`
- `WIX_PAYMENT_SUCCESS_URL`
- `WIX_PAYMENT_CANCEL_URL`

The server requires `WIX_SITE_ID` and `WIX_API_TOKEN` before it will accept
an online booking. Keep the token server-side in Wix deployment secrets; do
not expose it as a `PUBLIC_` variable. The token must have permission to add
items to the `pickupBookings` collection.

The pickup flow calculates and sends `finalTotal`, `quotedWeight`, and itemized add-on values to `WIX_PAYMENT_URL`. Configure that checkout destination to use `finalTotal` as the charge amount (and do not replace it with a fixed product price), so the online charge matches the quote shown to the customer.

Personal booking fields are written to Wix CMS and are not forwarded in the
checkout URL. Only the quote, plan, and Wix booking reference are sent to the
configured payment destination.

For Wix Payments, set `WIX_PAYMENT_URL` to your Wix checkout or product/plan URL. The site will redirect subscription and pickup requests there when the env var is present.

### Deployment environment note
The deployed contact endpoint requires `WIX_SITE_ID` and `WIX_API_TOKEN` at runtime. If `wix env set` returns `VELO.APP_ENVIRONMENT_VARIABLE_UPSERT` with `PERMISSION_DENIED`, this app is not allowed to manage deployment variables through the CLI. A Wix site owner or administrator must add the variables in the app/site Environment Variables settings, or grant the app that environment-variable permission, and then release the site again. Do not put the API token in a `PUBLIC_` variable or commit `.env.local`.

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
- `policyConsentAt` (server-side consent timestamp; the checkbox value is not stored)

### 3. `contactMessages`
Use this collection for messages submitted through the public contact form.
Create these fields:
- `fullName` (Text)
- `phone` (Text)
- `email` (Text)
- `servicePreference` (Text)
- `contactPreference` (Text)
- `city` (Text)
- `questionType` (Text)
- `message` (Text)
- `contactConsentAt` (Date)
- `receivedAt` (Date)
- `status` (Text)
- `source` (Text)

Set permissions to `insert: ANYONE`, `read: ADMIN`, `update: ADMIN`, and `remove: ADMIN`.
The consent checkbox is validated but is not stored; only `contactConsentAt` is retained.

## Notes
- The booking page will still work in fallback mode locally if Wix env vars are not configured.
- For full production usage, configure a real Wix API token and collections in the Wix dashboard.
