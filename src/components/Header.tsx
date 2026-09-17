import Link from "next/link";
import { Container } from "./Container";
import { MobileNav } from "./MobileNav";
import { siteConfig } from "@/config/site";

const links = [
  { href: "/", label: "Home" },
  { href: "/catalog", label: "Catalog" },
  { href: "/about", label: "About" },
  { href: "/contact", label: "Contact" },
];

export function Header() {
  return (
    <header className="sticky top-0 z-40 border-b border-white/10 bg-ink/95 backdrop-blur">
      <Container className="relative flex h-18 items-center justify-between py-3">
        <Link href="/" className="flex items-center gap-2 font-display text-xl font-bold text-white">
          <span className="text-2xl">🔥</span>
          {siteConfig.shortName}
        </Link>
        <nav className="hidden items-center gap-8 md:flex">
          {links.map((link) => (
            <Link
              key={link.href}
              href={link.href}
              className="text-sm font-medium text-white/80 transition-colors hover:text-white"
            >
              {link.label}
            </Link>
          ))}
        </nav>
        <div className="flex items-center gap-2">
          <Link
            href="/contact"
            className="hidden rounded-full bg-ember-500 px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-ember-600 sm:inline-flex"
          >
            Get a Quote
          </Link>
          <MobileNav />
        </div>
      </Container>
    </header>
  );
}
