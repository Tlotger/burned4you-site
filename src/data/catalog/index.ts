import type { Locale } from "@/i18n/config";
import { categories as en } from "./en";
import { categories as el } from "./el";

export type { Product, Category } from "./types";

const byLocale = { en, el } satisfies Record<Locale, typeof en>;

export function getCategories(locale: Locale) {
  return byLocale[locale];
}

export function getCategory(locale: Locale, slug: string) {
  return byLocale[locale].find((category) => category.slug === slug);
}
