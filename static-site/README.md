# Burned4You — static version (Eleventy + Bootstrap)

Plain HTML + Bootstrap, with shared pieces written once. No TypeScript.

## Run it

    npm install        (first time only)
    npm start          (opens a live-reloading site at http://localhost:8080)
    npm run build      (creates the finished site in the _site/ folder)

Upload the contents of `_site/` to any web host (Netlify, GitHub Pages, ...).

## Where to edit things

    src/_data/site.json         Shop name, email, phone, stats, contact form address
    src/_data/categories.json   Every category and product (name, text, photo path)
    src/products/               The product photos
    src/css/style.css           Colors, cards, animations
    src/_includes/header.njk    Top menu        (footer.njk = bottom of every page)
    src/_includes/macros.njk    The category card and product card layouts
    src/*.njk, src/catalog/     The pages themselves (plain HTML with {{ }} placeholders)

## To add a product
Add a photo to `src/products/<category>/`, then add an entry to the matching
category in `src/_data/categories.json`. The card and page appear automatically.

## Contact form
It posts to Formspree. Create a free form at formspree.io and put its address
in `src/_data/site.json` (`formEndpoint`) — until then the form won't deliver.
