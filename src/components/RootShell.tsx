import { comfortaa, inter } from "@/app/fonts";
import { Header } from "./Header";
import { Footer } from "./Footer";
import { getDictionary } from "@/i18n/dictionaries";
import type { Locale } from "@/i18n/config";

// Each locale section is its own root layout, so <html lang> is correct in the
// server-rendered HTML (not patched after hydration).
export function RootShell({ lang, children }: { lang: Locale; children: React.ReactNode }) {
  const dict = getDictionary(lang);

  return (
    <html lang={lang} className={`${comfortaa.variable} ${inter.variable} h-full antialiased`}>
      <body className="flex min-h-full flex-col bg-cream">
        <a href="#main" className="skip-link">
          {dict.a11y.skip}
        </a>
        <Header lang={lang} />
        <main id="main" tabIndex={-1} className="flex-1 focus:outline-none">
          {children}
        </main>
        <Footer lang={lang} />
      </body>
    </html>
  );
}
