# Burned4You — static version (Eleventy + Bootstrap) — ARCHIVED

**This site is frozen and no longer maintained.** The Next.js/TS site in the
project root was chosen as the one site going forward for the e-shop build,
so it wouldn't make sense to keep duplicating every change (catalog, prices,
wording, cart) across two codebases. Keep this folder for reference if you
want to compare designs, but don't add real prices or new products here —
they won't reach customers.

Everything below describes how this site used to work, back when it was
kept in sync with the Next.js version.

---

Plain HTML + Bootstrap, with shared pieces written once. No TypeScript.
Two languages: **Greek is the default** (`/`), **English is at `/en/`**.

## Run it

    npm install        (first time only)
    npm start          (opens a live-reloading site at http://localhost:8080)
    npm run build      (creates the finished site in the _site/ folder)

Upload the contents of `_site/` to any web host (Netlify, GitHub Pages, ...).
If `npm start` ever shows odd errors after you add or rename data files, stop
it (Ctrl+C) and start it again.

## Where to edit things

    src/_data/ui/el.json           All Greek wording (menu, buttons, headings, form labels)
    src/_data/ui/en.json           The same wording in English
    src/_data/categories/el.json   Greek categories + products
    src/_data/categories/en.json   English categories + products
    src/_data/site.json            Shop name, email, phone, contact form address (shared)
    src/_data/locales.json         The list of languages and their URL prefixes
    src/products/                  The product photos
    src/css/style.css              Colors, cards, animations
    src/_includes/                 header.njk, footer.njk, macros.njk (card layouts), base.njk
    src/*.njk, src/catalog/        The pages (HTML with {{ }} placeholders)

## Changing text
Edit the matching key in BOTH `ui/el.json` and `ui/en.json`. Keep the two files
in the same shape (same keys) — the Greek file is a translation of the English one.
The brand name "Burned4You" is written literally inside a few sentences; if you
rename the shop, search for it.

## To add a product
1. Add the photo to `src/products/<category>/`.
2. Add the product to the matching category in BOTH `categories/el.json` and
   `categories/en.json`. Keep the same `slug`, `image`, and order in both; only
   `name`, `description`, and `material` differ by language.

## To add a whole new category
Same as above, but add it to both category files (same position in both lists).
Its page is created automatically in both languages.

## Adding a third language later
Add an entry to `locales.json`, create `ui/<code>.json` and `categories/<code>.json`,
and add the new code to the `categories` object in `src/_data/categoryPages.js`.

## Contact form
It posts to Formspree. Create a free form at formspree.io and put its address
in `src/_data/site.json` (`formEndpoint`) — until then the form won't deliver.
Each message includes a hidden `language` field (el/en).

## Not done yet
- `hreflang` tags (they tell Google which page is the Greek/English twin). They
  need the final website address, so add them once the domain is known.
- The Greek text is a draft; please have a native speaker review it.
