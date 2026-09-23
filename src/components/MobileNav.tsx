"use client";

import Link from "next/link";
import { useState } from "react";
import { LanguageSwitch } from "./LanguageSwitch";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function MobileNav({ lang }: { lang: Locale }) {
  const [open, setOpen] = useState(false);
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);
  const links = [
    { href: `${prefix}/`, label: dict.nav.home },
    { href: `${prefix}/catalog`, label: dict.nav.catalog },
    { href: `${prefix}/about`, label: dict.nav.about },
    { href: `${prefix}/contact`, label: dict.nav.contact },
  ];

  return (
    <div className="md:hidden">
      <button
        aria-label="Toggle menu"
        aria-expanded={open}
        onClick={() => setOpen((v) => !v)}
        className="flex h-10 w-10 items-center justify-center rounded-full text-white"
      >
        <span className="sr-only">Menu</span>
        {open ? (
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M6 6l12 12M18 6L6 18" strokeLinecap="round" />
          </svg>
        ) : (
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M4 7h16M4 12h16M4 17h16" strokeLinecap="round" />
          </svg>
        )}
      </button>
      <div
        className={`absolute inset-x-0 top-full grid border-b border-white/10 bg-ink px-6 shadow-xl transition-all duration-300 ease-out ${
          open ? "grid-rows-[1fr] pt-2 pb-6 opacity-100" : "grid-rows-[0fr] pt-0 pb-0 opacity-0"
        }`}
      >
        <nav className="flex flex-col gap-1 overflow-hidden">
          {links.map((link) => (
            <Link
              key={link.href}
              href={link.href}
              onClick={() => setOpen(false)}
              className="rounded-lg px-3 py-3 text-base font-medium text-white/85 transition-colors hover:bg-white/5 hover:text-white"
            >
              {link.label}
            </Link>
          ))}
          <div className="mt-2 flex items-center gap-3 border-t border-white/10 pt-3">
            <LanguageSwitch lang={lang} label={dict.switchLabel} title={dict.switchTitle} />
            <Link
              href={`${prefix}/contact`}
              onClick={() => setOpen(false)}
              className="rounded-full bg-ember-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-ember-600"
            >
              {dict.nav.cta}
            </Link>
          </div>
        </nav>
      </div>
    </div>
  );
}
