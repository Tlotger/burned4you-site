"use client";

import Link from "next/link";
import { useEffect, useId, useRef, useState } from "react";
import { LanguageSwitch } from "./LanguageSwitch";
import { NavLink } from "./NavLink";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function MobileNav({ lang }: { lang: Locale }) {
  const [open, setOpen] = useState(false);
  const panelId = useId();
  const toggleRef = useRef<HTMLButtonElement>(null);
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);
  const links = [
    { href: `${prefix}/`, label: dict.nav.home },
    { href: `${prefix}/catalog`, label: dict.nav.catalog },
    { href: `${prefix}/about`, label: dict.nav.about },
    { href: `${prefix}/contact`, label: dict.nav.contact },
  ];

  useEffect(() => {
    if (!open) return;
    function onKeyDown(event: KeyboardEvent) {
      if (event.key === "Escape") {
        setOpen(false);
        toggleRef.current?.focus();
      }
    }
    document.addEventListener("keydown", onKeyDown);
    return () => document.removeEventListener("keydown", onKeyDown);
  }, [open]);

  return (
    <div className="md:hidden">
      <button
        ref={toggleRef}
        type="button"
        aria-label={open ? dict.a11y.closeMenu : dict.a11y.openMenu}
        aria-expanded={open}
        aria-controls={panelId}
        onClick={() => setOpen((v) => !v)}
        className="flex h-11 w-11 items-center justify-center rounded-full text-white"
      >
        {open ? (
          <svg aria-hidden="true" focusable="false" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M6 6l12 12M18 6L6 18" strokeLinecap="round" />
          </svg>
        ) : (
          <svg aria-hidden="true" focusable="false" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M4 7h16M4 12h16M4 17h16" strokeLinecap="round" />
          </svg>
        )}
      </button>
      <div
        id={panelId}
        inert={!open}
        className={`absolute inset-x-0 top-full grid border-b border-white/10 bg-ink px-6 shadow-xl transition-all duration-300 ease-out ${
          open ? "visible grid-rows-[1fr] pt-2 pb-6 opacity-100" : "invisible grid-rows-[0fr] pt-0 pb-0 opacity-0"
        }`}
      >
        <nav aria-label={dict.a11y.mobileNav} className="flex flex-col gap-1 overflow-hidden">
          {links.map((link) => (
            <NavLink
              key={link.href}
              href={link.href}
              onClick={() => setOpen(false)}
              className="rounded-lg px-3 py-3 text-base font-medium text-white/85 transition-colors hover:bg-white/5 hover:text-white aria-[current=page]:bg-white/10 aria-[current=page]:text-white"
            >
              {link.label}
            </NavLink>
          ))}
          <div className="mt-2 flex items-center gap-3 border-t border-white/10 pt-3">
            <LanguageSwitch lang={lang} label={dict.switchLabel} title={dict.switchTitle} className="inline-flex" />
            <Link
              href={`${prefix}/contact`}
              onClick={() => setOpen(false)}
              className="rounded-full bg-ember-600 px-4 py-3 text-sm font-semibold text-white transition-colors hover:bg-ember-700"
            >
              {dict.nav.cta}
            </Link>
          </div>
        </nav>
      </div>
    </div>
  );
}
