# Burned4You — Shop Website

A Next.js website for a custom laser-engraving shop (ornaments, bookmarks,
coasters, tealight holders, earrings, wooden games, and pet keepsakes).

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

There's also `scripts/dev.cmd` — a small Windows helper (see
`scripts/README.txt`) used only when previewing the site; you won't need
to run it yourself.

## Where things live

```
src/
  app/           Every page of the site (Home, Catalog, About, Contact, ...)
  components/    Reusable pieces used across pages (Header, Footer, cards, ...)
  data/          The product catalog — edit catalog.ts to change categories/products
  config/        Shop details (name, email, phone, social links) — see site.ts

public/
  products/      The photos shown on the live site, organized by category

_ProductPictures/  Your full raw photo library, organized for reference
                    (see its own README.txt) — not used by the site directly
```

To change what's on the site:
- **Products or categories** → edit `src/data/catalog.ts`
- **Shop name, email, phone, socials** → edit `src/config/site.ts`
- **Photos** → add/replace files in `public/products/<category>/`
- **Page text or layout** → edit the matching file under `src/app/`
