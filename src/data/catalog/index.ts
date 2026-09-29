import type { Locale } from "@/i18n/config";
import { catalogFacts } from "./shared";
import { text as enText } from "./en";
import { text as elText } from "./el";
import type { Category, CatalogText } from "./types";

export type { Product, Category } from "./types";

const textByLocale: Record<Locale, CatalogText> = { en: enText, el: elText };

// Merges the language-independent facts (shared.ts) with each language's
// text, matched up by slug. Throws immediately (at import time, so it fails
// a build rather than shipping quietly broken) if a slug exists on one side
// but not the other — the two can no longer drift apart unnoticed.
function buildCategories(locale: Locale, text: CatalogText): Category[] {
  return catalogFacts.map((categoryFacts) => {
    const categoryText = text[categoryFacts.slug];
    if (!categoryText) {
      throw new Error(`[catalog] Missing "${locale}" text for category "${categoryFacts.slug}"`);
    }

    return {
      slug: categoryFacts.slug,
      heroImage: categoryFacts.heroImage,
      name: categoryText.name,
      tagline: categoryText.tagline,
      description: categoryText.description,
      products: categoryFacts.products.map((productFacts) => {
        const productText = categoryText.products[productFacts.slug];
        if (!productText) {
          throw new Error(
            `[catalog] Missing "${locale}" text for product "${productFacts.slug}" in category "${categoryFacts.slug}"`
          );
        }
        return { ...productFacts, ...productText };
      }),
    };
  });
}

const byLocale: Record<Locale, Category[]> = {
  en: buildCategories("en", textByLocale.en),
  el: buildCategories("el", textByLocale.el),
};

export function getCategories(locale: Locale) {
  return byLocale[locale];
}

export function getCategory(locale: Locale, slug: string) {
  return byLocale[locale].find((category) => category.slug === slug);
}
