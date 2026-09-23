"use client";

import { useEffect } from "react";

// The root layout can't know the locale without opting the whole site out of
// static generation, so each locale section corrects <html lang> on mount
// instead (the SSR/SSG default is "el", set once in the root layout).
export function SetHtmlLang({ lang }: { lang: string }) {
  useEffect(() => {
    document.documentElement.lang = lang;
  }, [lang]);

  return null;
}
