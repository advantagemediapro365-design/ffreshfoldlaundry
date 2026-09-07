# Fresh Fold Delivery Development Process

This process converts the September 2026 sitemap and developer directions into gated implementation phases. Complete the gate for one phase before starting the next phase's release work.

## Working Rules

- Treat the approved sitemap, page slugs, CTA system, pricing, service statuses, and footer structure as the source of truth.
- Build the page and data structure before polishing copy.
- Do not publish thin duplicate town pages, unverified service promises, private addresses, or outdated pricing.
- Use `npm.cmd` or the project-local Wix CLI on Windows when the package scripts use Unix-only environment-variable syntax.
- Record each page's status in the SEO tracker before marking it complete.

## Phase 0: Baseline And Tracker

**Goal:** Establish the source of truth and a measurable starting point.

**Tasks**

- Create or maintain the SEO tracker with these columns:
  `Page Name | URL Slug | Page Type | Priority | Service Area | Target Keyword | Secondary Keywords | SEO Title | Meta Description | H1 | H2 Sections | Primary CTA | Secondary CTA | Internal Links Needed | Images Needed | Image File Name | Image Alt Text | Status | Assigned To | Needs Tony Review | Published URL | Tested on Mobile | Broken Links Checked | Indexed / Submitted | Notes`
- Audit current routes, existing pages, old pricing, private-address references, duplicate content, and missing forms.
- Confirm the public domain, canonical domain, phone number `570-494-7523`, service statuses, and current pricing with operations.
- Define CMS fields for service areas before adding more location pages.

**Gate**

- Tracker exists and every planned page has an owner, priority, slug, page type, CTA, and status.
- No unresolved conflict remains between the sitemap, page copy, and current pricing.

## Phase 1: Sitemap, Shell, And Core Navigation

**Goal:** Make the site structure crawlable and usable before feature work.

**Build order**

1. Home
2. Pricing
3. Book Pickup
4. Service Areas
5. Altoona service-area page
6. State College service-area page
7. Lock Haven service-area page
8. Subscriptions
9. Delivery Pass
10. Commercial Laundry
11. FAQ
12. Contact
13. Delivery & Route Policy
14. Pocket & Heavy Soil Policy
15. Fresh Fold Bag Policy
16. Terms and Privacy
17. Top Blair County pages
18. Student laundry page
19. Commercial industry pages
20. Blog categories

**Tasks**

- Create the approved lowercase slugs and route ownership.
- Implement the shared header, CTA system, footer columns, canonical metadata, and responsive navigation.
- Add the required footer groups: Fresh Fold Delivery, Services, Service Areas, Commercial, and Policies.
- Add the public phone number and public service-area wording; never add a private address.
- Add a primary CTA above the fold on every public page.

**Gate**

- Main navigation works on desktop and mobile.
- Phase 1 routes load, have one H1, and have no dead primary CTA links.
- Footer links resolve to real routes or an explicitly tracked pending route.

## Phase 2: Service-Area Data And Templates

**Goal:** Scale local pages from verified data instead of copied hard-coded pages.

**CMS collection fields**

`locationName | slug | county | state | zipCodes | serviceStatus | routeFrequency | primaryKeyword | secondaryKeywords | seoTitle | metaDescription | h1 | introCopy | serviceCopy | deliveryCopy | subscriptionCopy | commercialCopy | localFAQ1 | localFAQ2 | localFAQ3 | nearbyLocations | primaryCTA | secondaryCTA | heroImage | heroImageAlt | publishedStatus | noIndexStatus | lastReviewed`

**Tasks**

- Build the shared service-area template and populate Altoona, State College, Lock Haven, and Blair County first.
- Use honest statuses: Active Daily, Active Weekly, Route-Based, Waitlist, Not Available, or Custom Quote Required.
- Require every indexed service-area page to include a city-specific hero, status, how-it-works section, pricing preview, delivery explanation, subscription option, commercial option, three local FAQs, nearby links, and final CTA.
- Link every service-area page to `/pricing`, `/book-pickup`, `/subscriptions`, `/delivery-pass`, `/commercial-laundry`, `/service-areas`, and `/contact`.
- Keep small or duplicate town pages as draft/noindex until unique local copy and route status are verified.

**Gate**

- Every published service-area page has unique local content and a reviewed status.
- No page promises daily service where operations only supports weekly, route-based, or waitlist service.

## Phase 3: Conversion And Backend Workflows

**Goal:** Turn the page shell into a working customer acquisition flow.

**Booking flow**

- Collect customer type, name, phone, email, ZIP, address, laundry weight, pickup window, preferences, add-ons, photo upload, delivery estimate, pickup reservation credit, and customer responsibility acknowledgement.
- Validate ZIP and service status before allowing submission.
- Show a clear estimate separating laundry processing, delivery/mileage, add-ons, discounts, and tips.
- Preserve selected subscription plans when a customer enters from a plan CTA.
- Submit to a backend endpoint and show confirmation or a useful retry message.

**Additional workflows**

- Commercial quote form with `Get Commercial Quote` as the primary CTA.
- Subscription interest or sign-up flow when payment setup supports it.
- Delivery Pass sign-up flow when payment setup supports it.
- Backend order records with status, actual weight, add-ons, delivery fee, tip, and notes.
- Basic driver pickup/drop-off proof-photo workflow.
- Admin ability to view, edit, and assign orders.

**Gate**

- A customer can complete one-time booking and each subscription entry path end to end.
- Success, validation failure, unsupported ZIP, and server failure states are tested.
- Operations receives or can view every submitted request.

## Phase 4: Content, SEO, And Image System

**Goal:** Make every indexable page useful, specific, and internally connected.

**SEO requirements**

- One H1 per page.
- SEO title and meta description on every public page.
- Lowercase hyphenated slugs.
- At least two relevant internal links on every public page.
- Commercial pages link to Commercial Laundry, Pricing, Book Pickup, Service Areas, and Contact.
- Blog posts link to Book Pickup, Pricing, and Service Areas.
- Policy pages link to Book Pickup, Contact, and a relevant service page.
- Use the approved meta description pattern without keyword stuffing.
- Remove all old pricing before publishing.

**Image requirements**

- Rename uploaded images to descriptive filenames such as `fresh-fold-delivery-[service]-[city]-[description].jpg`.
- Compress images where practical.
- Add natural, specific alt text under about 125 characters.
- Do not publish random camera filenames or generic repeated alt text.

**Gate**

- Tracker has title, description, H1, headings, internal links, image filename, and alt text for every page marked ready.
- Copy is unique enough for the page to deserve indexing.
- No private address, old pricing, or unsupported service claim remains.

## Phase 5: QA And Indexing Readiness

**Goal:** Prove the experience works before search engines are invited to index it.

**QA checklist**

- Test every main CTA from desktop and mobile.
- Test every subscription CTA and selected-plan handoff.
- Test serviceable, unsupported, waitlist, and route-based ZIP cases.
- Test booking, contact, commercial quote, and ZIP forms.
- Test success, validation, and failure states.
- Check phone number `570-494-7523`, canonical domain, title, description, H1 count, image alt text, and internal links.
- Check all footer and navigation links.
- Run the production build and review generated output.
- Check responsive layouts for every live page.

**Indexing rules**

- Publish/index main money pages after QA.
- Publish/index major service-area pages only after unique content is reviewed.
- Keep weak duplicate pages draft or noindex.
- Keep admin, driver, and washer portals login-protected and noindex.
- Publish policy pages and link them in the footer and checkout.
- Publish blog categories only when they contain posts or useful introductory content.

**Gate**

- Every tracker row has QA status, mobile status, broken-link status, and indexing decision.
- No page is submitted for indexing while a required gate is incomplete.

## Phase 6: Release And Handoff

**Goal:** Launch safely and leave an operating feedback loop.

**Tasks**

- Build the production site with the local Wix CLI or approved release command.
- Deploy and verify Home, Pricing, Book Pickup, Subscriptions, Service Areas, Contact, and Commercial Laundry on the live domain.
- Submit or update the sitemap and verify robots/canonical URLs use the public domain.
- Confirm real booking and quote submissions reach operations.
- Record the published URL and release date in the tracker.
- Monitor first-day submissions, failed forms, unsupported ZIP requests, and customer questions.

**Gate**

- Live pages, forms, tracking, sitemap, canonical URLs, and operations notifications are verified.
- Known gaps are documented with an owner and next action rather than silently shipped.

## Approved CTA System

| Page type | Primary CTA | Secondary CTA |
| --- | --- | --- |
| Home | Book Pickup | Check My ZIP Code |
| Pricing | Book Pickup | View Subscriptions |
| Subscriptions | Start Subscription | Add Delivery Pass |
| Delivery Pass | Join Delivery Pass | See Delivery Pricing |
| Commercial | Get Commercial Quote | Call/Text 570-494-7523 |
| Service Area | Check My ZIP Code | Book Pickup |
| Student | Start Student Plan | Parent Pay Option |
| Blog | Book Pickup | Read Pricing |
| FAQ | Book Pickup | Contact Us |
| Policy | Book Pickup | Contact Support |

## Current Repository Handoff

- Existing launch documents remain useful as implementation checklists.
- Use this process as the phase order and release gate.
- Update the SEO tracker after each page or workflow changes state.
- The next recommended work item is Phase 0: reconcile the sitemap, current routes, current pricing, and tracker before adding more pages or copy.
