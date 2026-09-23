import Link from "next/link";
import { Container } from "./Container";
import { getCategories } from "@/data/catalog";
import { siteConfig } from "@/config/site";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function Footer({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);
  const categories = getCategories(lang);

  return (
    <footer className="border-t border-white/10 bg-ink text-white/70">
      <Container className="grid gap-10 py-14 md:grid-cols-4">
        <div>
          <div className="flex items-center gap-2 font-display text-lg font-bold text-white">
            <span className="text-xl">🔥</span>
            {siteConfig.name}
          </div>
          <p className="mt-3 max-w-xs text-sm leading-relaxed">{dict.description}</p>
        </div>

        <div>
          <h3 className="text-xs font-semibold tracking-wider text-ember-400 uppercase">{dict.footer.pages}</h3>
          <ul className="mt-4 space-y-2 text-sm">
            <li><Link className="hover:text-white" href={`${prefix}/`}>{dict.nav.home}</Link></li>
            <li><Link className="hover:text-white" href={`${prefix}/catalog`}>{dict.nav.catalog}</Link></li>
            <li><Link className="hover:text-white" href={`${prefix}/about`}>{dict.nav.about}</Link></li>
            <li><Link className="hover:text-white" href={`${prefix}/contact`}>{dict.nav.contact}</Link></li>
          </ul>
        </div>

        <div>
          <h3 className="text-xs font-semibold tracking-wider text-ember-400 uppercase">{dict.footer.categories}</h3>
          <ul className="mt-4 space-y-2 text-sm">
            {categories.slice(0, 4).map((category) => (
              <li key={category.slug}>
                <Link className="hover:text-white" href={`${prefix}/catalog/${category.slug}`}>
                  {category.name}
                </Link>
              </li>
            ))}
          </ul>
        </div>

        <div>
          <h3 className="text-xs font-semibold tracking-wider text-ember-400 uppercase">{dict.footer.contact}</h3>
          <ul className="mt-4 space-y-2 text-sm">
            <li>{siteConfig.email}</li>
            <li>{siteConfig.phone}</li>
            <li>{dict.location}</li>
          </ul>
        </div>
      </Container>
      <div className="border-t border-white/10 py-6 text-center text-xs text-white/50">
        © {new Date().getFullYear()} {siteConfig.name}. {dict.footer.rights}
      </div>
    </footer>
  );
}
