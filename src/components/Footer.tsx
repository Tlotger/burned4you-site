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
            <span aria-hidden="true" className="text-xl">🔥</span>
            {siteConfig.name}
          </div>
          <p className="mt-3 max-w-xs text-sm leading-relaxed">{dict.description}</p>
        </div>

        <nav aria-label={dict.footer.pages}>
          <h2 className="text-sm font-semibold tracking-wide text-ember-400 uppercase">{dict.footer.pages}</h2>
          <ul className="mt-4 space-y-1 text-sm">
            <li><Link className="inline-block py-1.5 hover:text-white" href={`${prefix}/`}>{dict.nav.home}</Link></li>
            <li><Link className="inline-block py-1.5 hover:text-white" href={`${prefix}/catalog`}>{dict.nav.catalog}</Link></li>
            <li><Link className="inline-block py-1.5 hover:text-white" href={`${prefix}/about`}>{dict.nav.about}</Link></li>
            <li><Link className="inline-block py-1.5 hover:text-white" href={`${prefix}/contact`}>{dict.nav.contact}</Link></li>
          </ul>
        </nav>

        <nav aria-label={dict.footer.categories}>
          <h2 className="text-sm font-semibold tracking-wide text-ember-400 uppercase">{dict.footer.categories}</h2>
          <ul className="mt-4 space-y-1 text-sm">
            {categories.slice(0, 4).map((category) => (
              <li key={category.slug}>
                <Link className="inline-block py-1.5 hover:text-white" href={`${prefix}/catalog/${category.slug}`}>
                  {category.name}
                </Link>
              </li>
            ))}
          </ul>
        </nav>

        <div>
          <h2 className="text-sm font-semibold tracking-wide text-ember-400 uppercase">{dict.footer.contact}</h2>
          <ul className="mt-4 space-y-2 text-sm">
            <li>
              <a className="inline-block py-1.5 hover:text-white" href={`mailto:${siteConfig.email}`}>
                {siteConfig.email}
              </a>
            </li>
            <li>
              <a className="inline-block py-1.5 hover:text-white" href={`tel:${siteConfig.phone.replace(/\s/g, "")}`}>
                {siteConfig.phone}
              </a>
            </li>
            <li>{dict.location}</li>
          </ul>
        </div>
      </Container>
      <div className="flex flex-col items-center gap-2 border-t border-white/10 py-6 text-center text-sm text-white/60">
        <Link className="inline-block py-1.5 underline hover:text-white" href={`${prefix}/accessibility`}>
          {dict.footer.accessibility}
        </Link>
        <p>
          © {new Date().getFullYear()} {siteConfig.name}. {dict.footer.rights}
        </p>
      </div>
    </footer>
  );
}
