# Fresh Fold Launch Checklist

## 1. Frontend & Navigation
- [ ] Verify `/subscriptions` page loads correctly.
- [ ] Confirm all subscription CTA buttons navigate to `/book-pickup`.
- [ ] Confirm `/book-pickup` is accessible from header/footer and key pages.
- [ ] Ensure branding, plan pricing, and service messaging are consistent.
- [ ] Confirm mobile responsiveness for subscription and booking pages.

## 2. Booking Form Implementation
- [ ] Convert the static booking UI into a real form.
- [ ] Add `name` attributes for every input field.
- [ ] Add a `form` `method="POST"` and `action="/api/book-pickup"` or external form endpoint.
- [ ] Implement client-side step navigation for the 6-step booking process.
- [ ] Preserve selected subscription plan in the booking session when launched from plan CTAs.
- [ ] Include required fields:
  - Customer type
  - Name
  - Phone
  - Email
  - ZIP code
  - Address details
  - Laundry weight selection
  - Pickup window
  - Add-ons / preferences
- [ ] Add a confirmation page or success message after submission.
- [ ] Provide clear validation/error messages for missing or invalid inputs.

## 3. Subscription Flow Wiring
- [ ] Map each subscription plan CTA to a plan-specific booking flow.
- [ ] Preselect the plan or show selected plan details on `/book-pickup`.
- [ ] Confirm the selected plan is included in the booking payload.
- [ ] Clearly state that delivery is separate unless a promotion applies.
- [ ] Ensure plan detail pages link back to the booking page.

## 4. Service Area Validation
- [ ] Implement ZIP code availability check.
- [ ] Display serviceable / non-serviceable messaging immediately after ZIP entry.
- [ ] Prevent submission if ZIP is outside service area.
- [ ] Provide a waitlist or contact path for unsupported ZIP codes.
- [ ] Confirm the service area list is up to date with operations.

## 5. Pricing & Transparency
- [ ] Show estimated laundry cost and dispatch fee clearly.
- [ ] Display that delivery/mileage is calculated separately.
- [ ] Include add-on pricing and any first-month discounts.
- [ ] Add a summary section that updates with customer selections.
- [ ] Clarify that final total is based on actual weight and route conditions.

## 6. Backend / Submission Handling
- [ ] Add an API endpoint or backend handler to receive booking requests.
- [ ] Ensure submissions are forwarded to email, CRM, or operations team.
- [ ] Store booking details securely if using a database.
- [ ] Create admin notification or alert for new bookings.
- [ ] Log submission errors and display friendly retry messaging.

## 7. QA / Testing
- [ ] Test booking flow from every plan CTA.
- [ ] Test booking flow from `/book-pickup` directly.
- [ ] Test service area ZIP validation and waitlist path.
- [ ] Test form submission success and failure behavior.
- [ ] Test desktop and mobile layouts.
- [ ] Run `npm run build` and confirm no build errors.

## 8. Deployment & Go-Live
- [ ] Build the site with `npm run build`.
- [ ] Deploy with `npm run release` or chosen production workflow.
- [ ] Verify live pages:
  - `/subscriptions`
  - `/book-pickup`
  - `/contact`
- [ ] Confirm booking submissions are received on live site.
- [ ] Monitor first-day submissions for any issues.

## 9. Post-Launch Checks
- [ ] Review analytics for page visits and submissions.
- [ ] Confirm all contact links and CTA buttons are functional.
- [ ] Update copy if customers report confusion on delivery pricing.
- [ ] Fix any issues with unsupported ZIP codes or route availability.
