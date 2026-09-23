export type Locale = "el" | "en";

export const locales: Locale[] = ["el", "en"];
export const defaultLocale: Locale = "el";

export function prefixFor(locale: Locale) {
  return locale === "en" ? "/en" : "";
}

export function otherLocale(locale: Locale): Locale {
  return locale === "el" ? "en" : "el";
}
