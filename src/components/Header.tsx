import Link from "next/link";
import { Container } from "./Container";
import { MobileNav } from "./MobileNav";
import { LanguageSwitch } from "./LanguageSwitch";
import { NavLink } from "./NavLink";
import { siteConfig } from "@/config/site";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function Header({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);
  const links = [
    { href: `${prefix}/`, label: dict.nav.home },
    { href: `${prefix}/catalog`, label: dict.nav.catalog },
    { href: `${prefix}/about`, label: dict.nav.about },
    { href: `${prefix}/contact`, label: dict.nav.contact },
  ];

  return (
    <header className="sticky top-0 z-40 border-b border-white/10 bg-ink/95 backdrop-blur">
      <Container className="relative flex h-18 items-center justify-between py-3">
        <Link href={`${prefix}/`} className="flex items-center gap-2 font-display text-xl font-bold text-white">
          <span aria-hidden="true" className="text-2xl">🔥</span>
          {siteConfig.shortName}
        </Link>
        <nav aria-label={dict.a11y.mainNav} className="hidden items-center gap-8 md:flex">
          {links.map((link) => (
            <NavLink
              key={link.href}
              href={link.href}
              className="py-2 text-sm font-medium text-white/80 transition-colors hover:text-white aria-[current=page]:text-white aria-[current=page]:underline aria-[current=page]:underline-offset-8"
            >
              {link.label}
            </NavLink>
          ))}
        </nav>
        <div className="flex items-center gap-3">
          <LanguageSwitch
            lang={lang}
            label={dict.switchLabel}
            title={dict.switchTitle}
            className="hidden md:inline-flex"
          />
          <Link
            href={`${prefix}/contact`}
            className="hidden rounded-full bg-ember-600 px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-ember-700 sm:inline-flex"
          >
            {dict.nav.cta}
          </Link>
          <MobileNav lang={lang} />
        </div>
      </Container>
    </header>
  );
}
