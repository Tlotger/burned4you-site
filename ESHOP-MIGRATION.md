# E-shop migration plan

This tracks turning the current catalog-only site into a real store: what's
done, what's still an open decision, and the concrete steps for each option
so work can start the moment a choice is made.

## Status

- [x] **Phase 0 — stop the duplication.** The old static Bootstrap site
  (`static-site/`) was frozen, then removed outright. The Next.js/TS site
  is the only site going forward. (commits `aca7264`, `d3b5dd0`)
- [x] **Phase 1 — fix the data model before adding money to it.** Product
  facts that don't change by language (photo, price, whether it's
  personalizable) now live in one place, `src/data/catalog/shared.ts`,
  instead of being duplicated inside the Greek and English text files. A
  build-time check throws immediately if a product's facts and its
  translated text ever fall out of sync. (commit `aca7264`)
- [ ] **Phase 2 — pick the cart/checkout platform.** Not yet decided —
  see below.
- [ ] **Phase 3 — orders reach you somewhere useful.**
- [ ] **Phase 4 — Greek legal groundwork.**
- [ ] **Phase 5 — test, then launch.**

---

## The open decision: which platform

Three options are on the table. All three keep the same payment-processor
card fee (Stripe/PayPal, roughly 1.5–2.9% depending on card) — that part is
identical everywhere, so it's left out of the comparison below.

| | **Snipcart** (on the current Next.js site) | **Headless WooCommerce** | **Full WordPress + WooCommerce rebuild** |
|---|---|---|---|
| What changes | Add a cart script + buy buttons to the site as it is today | Current site stays exactly as-is; WooCommerce runs invisibly as the product/order backend | Current site is retired; rebuilt as a WordPress theme |
| Design & bilingual routing | Kept, unchanged | Kept, unchanged | Rebuilt from scratch (Polylang for the bilingual part) |
| Who can add a product later | Needs someone who can edit the code | You, via `wp-admin` — no code | You, via `wp-admin` — no code |
| Extra cut on every sale | **2%**, or a flat **$20/month** if under $1,000/month in sales (verified live at snipcart.com/pricing) | **0%** | **0%** |
| Extra recurring cost | Snipcart fee above | WordPress hosting (~€5–25/mo, separate from the Next.js hosting) + a bilingual WooCommerce plugin (Polylang for WooCommerce, **~€99/yr**, verified live at polylang.pro) | WordPress hosting only (~€5–25/mo) + the same Polylang plugin (~€99/yr) |
| Greek myDATA e-invoicing / local carriers (ELTA, ACS, Speedex) | Not built in; would need checking case by case | Mature plugin ecosystem exists | Same as headless |
| Effort to build | Smallest — a script tag and buy buttons | Real setup work — I'd build the API connection between the two systems | Largest — a full theme rebuild |

**My read:** if keeping today's design/URLs matters most, it's Snipcart vs.
headless WooCommerce. If being able to run the shop yourself without
needing a developer for routine changes matters most, it's one of the two
WooCommerce paths. Full WordPress is the only option where you're not
dependent on a developer at all going forward, at the cost of the biggest
rebuild now.

---

## Path A — Snipcart (fastest)

1. Sign up at snipcart.com, grab the public API key.
2. Fill in real prices in `src/data/catalog/shared.ts` (currently all unset).
3. Add the Snipcart script/CSS to the site (a small client component).
4. Turn each `ProductCard`'s "Ask About This" button into an "Add to Cart"
   button carrying `data-item-id/name/price/url/image`.
5. Add `data-item-custom1-name="Pet's name"` (etc.) on products where
   `personalizable: true` — currently just the pet ornament.
6. Add a cart icon to `Header`/`MobileNav` (Snipcart supplies the cart
   drawer and checkout UI itself).
7. In the Snipcart dashboard: set currency to EUR, set the VAT rate, set
   shipping zones (Greece / rest of EU / international) as a flat-rate
   table — Snipcart has no live Greek courier integration.
8. **Verify Snipcart's own checkout UI actually supports Greek** before
   going further — if it doesn't, the bilingual site breaks at checkout,
   the one moment it matters most.
9. Continue to [Phase 3 onward](#phase-3-orders-reach-you-somewhere-useful).

## Path B — Headless WooCommerce

1. Install WordPress + WooCommerce somewhere it'll actually be hosted
   (can start on the local environment in the [appendix](#appendix-running-wordpress-locally-for-building--testing) and move to real
   hosting later — WooCommerce itself doesn't need to be public-facing).
2. Enable the WooCommerce REST API (or install WPGraphQL + WPGraphQL for
   WooCommerce) and generate API credentials.
3. Recreate the 26 products and 7 categories inside WooCommerce (photos,
   descriptions, prices) — this becomes the new source of truth, replacing
   `src/data/catalog/shared.ts`, `en.ts`, and `el.ts`.
4. Build the connection in the Next.js site: fetch product/category data
   from WooCommerce's API instead of the local catalog files, keeping the
   same page components and design.
5. Wire checkout: either redirect to a WooCommerce-hosted checkout page
   styled to match, or build a custom checkout that calls WooCommerce's
   Store API / Checkout Block API directly.
6. Add a webhook receiver (a new `/api/webhooks/woocommerce` route,
   matching the existing `/api/contact` pattern) so new orders can be
   logged or trigger a notification.
7. Install a myDATA e-invoicing plugin and a Greek shipping plugin
   (ELTA/ACS/Speedex) in WooCommerce.
8. Continue to [Phase 3 onward](#phase-3-orders-reach-you-somewhere-useful).

## Path C — Full WordPress + WooCommerce rebuild

1. Set up WordPress + WooCommerce, first locally (see
   [appendix](#appendix-running-wordpress-locally-for-building--testing)), later on real hosting.
2. Pick a starting theme (a free WooCommerce-ready theme, or a page
   builder like Elementor) and begin matching the current design: the
   ember/cream palette, Comfortaa headings, the card layouts.
3. Install Polylang + Polylang for WooCommerce; recreate the Greek/English
   text for every page and product.
4. Recreate the 26 products and 7 categories directly in WooCommerce, in
   both languages.
5. Configure payment gateway (Stripe/PayPal), VAT, shipping zones and
   rates, and a myDATA e-invoicing plugin.
6. Recreate the contact form (WooCommerce/WordPress form plugin, or a
   custom one) and the personalization field on the pet ornament product
   (WooCommerce's built-in custom product fields, or a plugin like
   Advanced Product Fields).
7. Point the domain at the new WordPress hosting once it's ready; retire
   the Next.js deployment.
8. Continue to [Phase 3 onward](#phase-3-orders-reach-you-somewhere-useful).

---

## Phase 3: orders reach you somewhere useful

Applies to all three paths.

- Decide where you actually want to see new orders day to day: the
  platform's own dashboard (Snipcart's or WooCommerce's `wp-admin`) is
  enough to start.
- If orders should also land somewhere else (a spreadsheet, an email
  alert, a Slack message), wire that up via the webhook from Phase 2.

## Phase 4 — Greek legal groundwork (not code, but blocking)

Applies to all three paths.

- Business details (ΑΦΜ) visible on the site.
- Terms of service, a privacy/GDPR notice, and a cookie-consent banner.
- A returns policy stating personalized/made-to-order items are exempt
  from the standard 14-day EU withdrawal right.
- Confirm with an accountant whether the chosen platform's receipts
  satisfy **myDATA** e-invoicing, or whether a separate step is needed.

## Phase 5 — test, then launch

Applies to all three paths.

- Full purchase flow in test mode, in both languages, on mobile and
  desktop.
- Confirm a personalization field (e.g. a pet's name) actually reaches
  the order, not just the cart.
- Check tax/shipping math for a Greek address and one outside Greece.
- Soft-launch to a few real customers before announcing widely.

---

## Appendix: running WordPress locally, for building & testing

Only needed for Path B or C. This runs WordPress on this machine only —
nobody else can see it. Going live afterward needs real web hosting,
which has to be purchased directly (not something that can be set up on
your behalf).

1. Install **XAMPP** (bundles Apache, MySQL, and PHP) — available via
   `winget install ApacheFriends.Xampp.8.2`. This starts real local
   services (a web server and a database), so it's worth confirming
   before installing, the same way Node.js was.
2. Download WordPress core into XAMPP's `htdocs` folder, create a MySQL
   database, and run through the WordPress install wizard.
3. Install the WooCommerce plugin and run its setup wizard (currency,
   store address, payment methods in test mode).
4. Install Polylang (+ Polylang for WooCommerce, if going bilingual from
   the start).
5. Start adding products and building/matching the design.

---

*Last updated after Phase 0 and Phase 1 were completed. Update the status
checklist above as later phases are finished.*
