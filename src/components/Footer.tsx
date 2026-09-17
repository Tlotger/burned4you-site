import Link from "next/link";
import { Container } from "./Container";
import { categories } from "@/data/catalog";
import { siteConfig } from "@/config/site";

export function Footer() {
  return (
    <footer className="border-t border-white/10 bg-ink text-white/70">
      <Container className="grid gap-10 py-14 md:grid-cols-4">
        <div>
          <div className="flex items-center gap-2 font-display text-lg font-bold text-white">
            <span className="text-xl">🔥</span>
            {siteConfig.name}
          </div>
          <p className="mt-3 max-w-xs text-sm leading-relaxed">
            {siteConfig.description}
          </p>
        </div>

        <div>
          <h3 className="text-xs font-semibold tracking-wider text-ember-400 uppercase">Pages</h3>
          <ul className="mt-4 space-y-2 text-sm">
            <li><Link className="hover:text-white" href="/">Home</Link></li>
            <li><Link className="hover:text-white" href="/catalog">Catalog</Link></li>
            <li><Link className="hover:text-white" href="/about">About</Link></li>
            <li><Link className="hover:text-white" href="/contact">Contact</Link></li>
          </ul>
        </div>

        <div>
          <h3 className="text-xs font-semibold tracking-wider text-ember-400 uppercase">Categories</h3>
          <ul className="mt-4 space-y-2 text-sm">
            {categories.slice(0, 4).map((category) => (
              <li key={category.slug}>
                <Link className="hover:text-white" href={`/catalog/${category.slug}`}>
                  {category.name}
                </Link>
              </li>
            ))}
          </ul>
        </div>

        <div>
          <h3 className="text-xs font-semibold tracking-wider text-ember-400 uppercase">Contact</h3>
          <ul className="mt-4 space-y-2 text-sm">
            <li>{siteConfig.email}</li>
            <li>{siteConfig.phone}</li>
            <li>{siteConfig.location}</li>
          </ul>
        </div>
      </Container>
      <div className="border-t border-white/10 py-6 text-center text-xs text-white/50">
        © {new Date().getFullYear()} {siteConfig.name}. All rights reserved.
      </div>
    </footer>
  );
}
