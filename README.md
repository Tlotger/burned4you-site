# Burned4You — Shop Website

A Next.js website for a custom laser-engraving shop (ornaments, bookmarks,
coasters, tealight holders, earrings, wooden games, and pet keepsakes).
Two languages: **Greek is the default** (`/`), **English is at `/en/`**.

## Running it

Open a terminal in this folder and run:

```bash
npm run dev
```

Then open [http://localhost:3000](http://localhost:3000) in a browser.

## The available scripts

These are run with `npm run <name>`, defined in `package.json`:

| Script  | What it does                                              |
| ------- | ---------------------------------------------------------- |
| `dev`   | Starts the site locally for editing, with live reload.     |
| `build` | Builds the optimized, production-ready version of the site.|
| `start` | Runs the already-built production version (run `build` first). |
| `lint`  | Checks the code for mistakes and style issues.              |

`dev` runs with the `--webpack` flag instead of Next's default Turbopack
dev server — a Turbopack bug in this Next.js version 404s on `/en/catalog/*`
pages otherwise. `build`/`start` are unaffected and use Turbopack normally.

There's also `scripts/dev.cmd` — a small Windows helper (see
`scripts/README.txt`) used only when previewing the site; you won't need
to run it yourself.

## Where things live

```
src/
  app/
    (el)/          Greek pages — this folder name is invisible in the URL,
                    so (el)/page.tsx is served at "/", (el)/about/page.tsx
                    at "/about", etc.
    en/             English pages, same structure, served under "/en/..."
    layout.tsx      The outermost HTML shell (fonts, <html lang>)
    api/contact/    The contact form's backend endpoint (shared by both languages)

  components/
    views/          The actual page content (HomeView, CatalogView, ...) —
                    each one takes a `lang` prop and is reused by both the
                    Greek and English route files, so there's only one copy
                    of each page's layout/markup to maintain
    Header.tsx, Footer.tsx, MobileNav.tsx, LanguageSwitch.tsx, ...
                    Shared UI, all `lang`-aware

  i18n/
    config.ts       The list of languages and their URL prefixes
    dictionaries/   All page wording — el.ts (Greek) and en.ts (English)

  data/
    catalog/        The product catalog — en.ts and el.ts (categories +
                    products), kept in sync by hand: same slugs, images,
                    and order in both files, only the text differs

  config/
    site.ts         Shop details that don't change by language (name,
                    email, phone)

public/
  products/         The photos shown on the live site, organized by category

_ProductPictures/  Your full raw photo library, organized for reference
                    (see its own README.txt) — not used by the site directly
```

## To change what's on the site

- **Wording** (buttons, headings, labels) → edit the matching key in BOTH
  `src/i18n/dictionaries/el.ts` and `en.ts`. Keep the two files the same
  shape — the Greek file is a translation of the English one.
- **Products or categories** → edit BOTH `src/data/catalog/el.ts` and
  `en.ts`. Keep the same `slug`, `image`, and order in both; only the
  Greek/English text differs.
- **Adding a whole new category or product** → add it to both catalog
  files, in the same position in each list. Its page is created
  automatically in both languages.
- **Shop name, email, phone** → edit `src/config/site.ts` (shared, not
  per-language).
- **Photos** → add/replace files in `public/products/<category>/`.
- **Page layout** (not wording) → edit the matching file under
  `src/components/views/`.

## Adding a third language later

Add the language to `src/i18n/config.ts`, create
`src/i18n/dictionaries/<code>.ts` and `src/data/catalog/<code>.ts`, add the
code to the `byLocale` object in `src/data/catalog/index.ts` and to
`dictionaries` in `src/i18n/dictionaries/index.ts`, then copy the `en/`
route folder to a new folder named after the language code.

## Not done yet

- The Greek text is a draft; please have a native speaker review it.
- No `hreflang` tags yet (they tell Google which page is the Greek/English
  twin) — they need the final website address to be added correctly.
