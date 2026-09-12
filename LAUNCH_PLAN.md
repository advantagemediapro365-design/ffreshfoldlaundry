# Fresh Fold Launch Plan

> Use [DEVELOPMENT_PROCESS.md](DEVELOPMENT_PROCESS.md) for the phased implementation order and release gates. This document remains the detailed launch checklist for booking, subscriptions, service areas, QA, and deployment.

## Goal
Make subscriptions and pickup booking work reliably so customers can start service and the site can go live.

## Current Status
- Subscription pages and booking CTAs are present.
- The pickup flow exists as a multi-step UI on the site.
- The booking form now posts to `/api/book-pickup`, validates required fields, consent, and service-area status, calculates the quote on the server, and writes to the Wix `pickupBookings` collection when deployment credentials are configured.
- Production Wix storage still requires owner configuration of `WIX_SITE_ID`, `WIX_API_TOKEN`, and the `pickupBookings` collection permissions.

## Launch Requirements

### 1. Functional Booking Flow
- Customers can choose a plan or one-time pickup.
- Customers can enter contact details, address, ZIP, pickup timing, and laundry preferences.
- The booking form submits to the server endpoint and rejects incomplete or unavailable requests.
- Wix-backed requests receive a booking reference before payment redirect; payment/email confirmation configuration remains a deployment task.

### 2. Subscription Flow
- Each subscription CTA routes to the correct booking experience.
- The selected plan is reflected in the booking form or summary.
- Customers understand whether delivery is separate or included.

### 3. Service Area Validation
- The site checks if the customer ZIP code is serviceable.
- Unsupported ZIP codes show a clear message or waitlist flow.
- The booking form prevents invalid orders from moving forward.

### 4. Pricing and Billing Transparency
- Pricing is clearly explained.
- Customers understand the difference between laundry processing, delivery, mileage, and add-ons.
- Final totals are confirmed before payment or booking submission.

### 5. Launch Readiness
- The site builds without errors.
- Forms and navigation are tested on desktop and mobile.
- Contact information and support paths are visible.
- The live deployment is verified.

## Implementation Plan

### Phase 1 — Make the Booking Form Functional
- [x] Add real form submission handling for the pickup booking page.
- [x] Capture the fields needed for a booking request.
- [x] Send the submission to the Wix CMS backend endpoint.
- [x] Display a clear server error state when validation or Wix storage fails.
- [ ] Configure Wix credentials and collection permissions in the deployment environment.
- [ ] Add confirmed email/notification automation after Wix insertion.

### Phase 2 — Connect Subscription CTAs
- Pass the selected subscription plan into the booking journey.
- Show the chosen plan in the summary section.
- Make the flow feel like a true start-service experience.

### Phase 3 — Add Service Area Logic
- [x] Add ZIP-based availability validation to booking submission.
- [x] Keep unsupported ZIPs out of online booking and direct customers to contact/waitlist support.
- [ ] Add a dedicated waitlist submission endpoint and Wix collection.

### Phase 4 — Pre-Launch QA
- [ ] Test a Wix-backed booking end to end with production-like credentials.
- [ ] Confirm payment redirect receives only quote, plan, and booking reference.
- Test all CTA buttons on desktop and mobile.
- Test booking submission from each plan.
- Test service-area edge cases.
- Verify copy, pricing, and contact details.

### Phase 5 — Go Live
- Build the production site.
- Deploy the site.
- Verify the pages and forms on the live domain.
- Monitor for submissions and customer issues.

## Recommended Delivery Checklist
- [ ] Booking page submits real data
- [ ] Subscription CTAs route correctly
- [ ] Service area validation works
- [ ] Confirmation is shown after booking
- [ ] Pricing explanation is clear
- [ ] Site builds successfully
- [ ] Live site is tested end-to-end

## Suggested Owner Tasks
- Frontend: update form behavior, content, and UX
- Backend: handle booking submissions and notifications
- Operations: verify service area and customer support process

## Launch Success Criteria
The site is ready to go live when a customer can:
1. Choose a subscription or pickup option.
2. Enter their address and service details.
3. Submit a booking successfully.
4. Receive confirmation and know what happens next.
