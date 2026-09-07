# Fresh Fold Launch Plan

> Use [DEVELOPMENT_PROCESS.md](DEVELOPMENT_PROCESS.md) for the phased implementation order and release gates. This document remains the detailed launch checklist for booking, subscriptions, service areas, QA, and deployment.

## Goal
Make subscriptions and pickup booking work reliably so customers can start service and the site can go live.

## Current Status
- Subscription pages and booking CTAs are present.
- The pickup flow exists as a multi-step UI on the site.
- The current booking form is a front-end mockup and does not yet submit real booking data.

## Launch Requirements

### 1. Functional Booking Flow
- Customers can choose a plan or one-time pickup.
- Customers can enter contact details, address, ZIP, pickup timing, and laundry preferences.
- The booking form submits successfully.
- A confirmation message or email is shown after submission.

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
- Add real form submission handling for the pickup booking page.
- Capture the fields needed for a booking request.
- Send the submission to an email, CRM, or backend endpoint.
- Display a clear success/error message.

### Phase 2 — Connect Subscription CTAs
- Pass the selected subscription plan into the booking journey.
- Show the chosen plan in the summary section.
- Make the flow feel like a true start-service experience.

### Phase 3 — Add Service Area Logic
- Add ZIP-based availability validation.
- Show either a booking path or a waitlist message.
- Make the experience clear for unsupported areas.

### Phase 4 — Pre-Launch QA
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
