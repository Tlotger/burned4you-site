"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import type { Locale } from "@/i18n/config";
import { otherLocale } from "@/i18n/config";

export function LanguageSwitch({
  lang,
  label,
  title,
  className = "",
}: {
  lang: Locale;
  label: string;
  title: string;
  className?: string;
}) {
  const pathname = usePathname() || "/";
  const basePath = lang === "en" ? pathname.replace(/^\/en/, "") || "/" : pathname;
  const target = lang === "el" ? (basePath === "/" ? "/en" : `/en${basePath}`) : basePath;
  const other = otherLocale(lang);

  return (
    <Link
      href={target}
      lang={other}
      hrefLang={other}
      aria-label={title}
      title={title}
      className={`lang-switch min-h-11 items-center ${className}`}
    >
      {label}
    </Link>
  );
}
