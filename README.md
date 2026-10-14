# Burned4You — Shop Website

A WordPress + WooCommerce site for a custom laser-engraving shop (ornaments,
bookmarks, coasters, tealight holders, earrings, wooden games, and pet
keepsakes). Two languages: **Greek is the default** (`/`), **English is at
`/en/`**.

## Where things live

- **[`wordpress-theme/`](wordpress-theme/)** — the theme's source of truth
  (PHP templates, assets, one-off setup scripts) and the local-environment
  notes (XAMPP paths, wp-cli, first-time setup, routing quirks). Start there.
- **[`public/products/`](public/products/)** — the curated product photos
  the theme's catalog-import script reads from.
- **[`ESHOP-MIGRATION.md`](ESHOP-MIGRATION.md)** — the migration plan that
  led here (it also covers two paths that were *not* taken: a cart bolted
  onto a Next.js site, and headless WooCommerce). Kept for context.
- **`_ProductPictures/`** (gitignored, not in the repo) — raw photo
  originals; `public/products/` holds the curated copies actually used.

## Running it locally

WordPress core itself isn't in this repo. The local stack is XAMPP
(Apache + MySQL + PHP), with WordPress core at
`C:\xampp\htdocs\burned4you` and this theme copied into its
`wp-content/themes/burned4you/`. Full setup, deploy, and first-run steps
are in [`wordpress-theme/README.md`](wordpress-theme/README.md).

Once XAMPP's Apache and MySQL are running, the site is at
`http://localhost/burned4you/` (and `http://localhost/burned4you/en/`).
