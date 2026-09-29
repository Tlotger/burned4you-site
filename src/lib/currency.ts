import { siteConfig } from "@/config/site";
import type { Locale } from "@/i18n/config";

// en-IE (English as used in Ireland, an EU country) formats EUR the way an
// English-reading customer of a Greek/EU shop would expect ("€18.00"),
// rather than en-US's dollar-first conventions.
const intlLocale: Record<Locale, string> = { el: "el-GR", en: "en-IE" };

export function formatPrice(price: number, locale: Locale): string {
  return new Intl.NumberFormat(intlLocale[locale], {
    style: "currency",
    currency: siteConfig.currency,
  }).format(price);
}
