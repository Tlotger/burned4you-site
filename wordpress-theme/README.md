# Burned4You — WordPress + WooCommerce theme

Source for the WordPress rebuild described in [`../ESHOP-MIGRATION.md`](../ESHOP-MIGRATION.md)
(Path C). This is the theme's source of truth; WordPress core itself is not
checked in here (same as `node_modules` for the Next.js site).

## Local environment

- **Stack**: XAMPP (Apache + MySQL + PHP 8.2) at `C:\xampp`, WordPress core
  at `C:\xampp\htdocs\burned4you`, site at `http://localhost/burned4you/`.
- **wp-cli**: `C:\xampp\wp-cli.phar`, run with XAMPP's own PHP:
  `C:\xampp\php\php.exe C:\xampp\wp-cli.phar --path=C:\xampp\htdocs\burned4you ...`
- **Plugins**: WooCommerce, Polylang (free — not the paid "Polylang for
  WooCommerce" add-on; products/categories are translated via Polylang's
  generic custom-post-type/taxonomy support instead).
- **Languages**: Greek is default and unprefixed (`/`), English is under
  `/en/` — mirrors the Next.js site's `prefixFor()` exactly.

## Deploying the theme

The working copy lives directly under
`C:\xampp\htdocs\burned4you\wp-content\themes\burned4you\` during
development. This folder (`burned4you/`) is copied there wholesale after
edits:

```powershell
Remove-Item -Recurse -Force C:\xampp\htdocs\burned4you\wp-content\themes\burned4you
Copy-Item -Recurse wordpress-theme\burned4you C:\xampp\htdocs\burned4you\wp-content\themes\burned4you
```

## First-time setup (fresh WordPress install)

Run once, in order, via `wp eval-file <script> --path=... `, after
WordPress core + WooCommerce + Polylang are installed and this theme is
activated:

1. `setup-scripts/01-setup-polylang.php` — languages (el default/hidden,
   en `/en/`), makes WooCommerce products/categories translatable, basic
   WooCommerce store settings.
2. `setup-scripts/02-setup-pages.php` — creates the Home/Catalog/About/
   Contact pages in both languages, links translations, sets the static
   front page, builds per-language primary nav menus.
3. `setup-scripts/03-import-catalog.php` — imports the 7 categories / 26
   products from `../src/data/catalog/{shared,el,en}.ts`, with images from
   `../public/products/`.
4. `setup-scripts/04-translate-strings.php` — populates the Greek
   translation of every static UI string (nav, buttons, section copy)
   registered via `pll_register_string()` in `inc/template-helpers.php`.

## Known quirks worth knowing before touching routing

- **`/catalog`, `/about`, `/contact` share the same slug in both
  languages** (matching the Next.js site's URL structure). WordPress's
  page-slug uniqueness check isn't Polylang-aware, and `pagename` query
  resolution doesn't filter by language either — both are worked around in
  `inc/routes.php` with custom rewrite rules + a `pre_get_posts` hook at
  priority 9999 (must run after WooCommerce's and Polylang's own
  `pre_get_posts` hooks). Read the comments in that file before changing
  the URL structure.
- **Polylang's `language` taxonomy uses `lang` as its public query var**,
  which collides with anything else that reads a `lang` query var —
  `inc/routes.php` clears it after use, the same way Polylang's own
  front-page code does.
- **WooCommerce's "Coming Soon" mode** intercepts frontend requests
  unpredictably during local development; kept off via
  `01-setup-polylang.php`. Turning it back on is a real pre-launch step
  (Phase 5 in the migration doc), not needed for building.

## Scope of this pass

No prices, payment gateway, VAT/shipping, or real checkout — products
carry a "Made to order" / "Ask About This" flow identical to the Next.js
site's inquiry-only UX. See the "Not doing in this pass" section of the
approved plan for what's deliberately deferred.
