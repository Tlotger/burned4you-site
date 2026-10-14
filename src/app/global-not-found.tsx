import type { Metadata } from "next";
import "./globals.css";
import { comfortaa, inter } from "./fonts";

export const metadata: Metadata = {
  title: "404 | Burned4You",
};

// Unmatched URLs have no locale, so this page is bilingual.
export default function GlobalNotFound() {
  return (
    <html lang="el" className={`${comfortaa.variable} ${inter.variable} h-full antialiased`}>
      <body className="flex min-h-full flex-col bg-cream">
        <main id="main" className="mx-auto flex w-full max-w-xl flex-1 flex-col justify-center gap-6 px-6 py-24">
          <h1 className="font-display text-4xl font-bold text-charcoal">
            <span lang="el">Η σελίδα δεν βρέθηκε</span> / <span lang="en">Page not found</span>
          </h1>
          <ul className="flex flex-col gap-3 text-lg font-semibold">
            <li>
              {/* Plain anchors: this page has no router context and the links cross root layouts. */}
              {/* eslint-disable-next-line @next/next/no-html-link-for-pages */}
              <a lang="el" href="/" className="inline-block py-2 text-ember-600 underline">
                Επιστροφή στην αρχική
              </a>
            </li>
            <li>
              <a lang="en" href="/en" className="inline-block py-2 text-ember-600 underline">
                Back to the homepage
              </a>
            </li>
          </ul>
        </main>
      </body>
    </html>
  );
}
