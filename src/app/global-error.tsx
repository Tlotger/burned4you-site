"use client";

import "./globals.css";

// Replaces the root layout when it fails to render, so it supplies its own <html>.
export default function GlobalError({ reset }: { error: Error & { digest?: string }; reset: () => void }) {
  return (
    <html lang="el">
      <body className="bg-cream">
        <main className="mx-auto flex min-h-screen max-w-xl flex-col justify-center gap-6 px-6 py-24">
          <h1 className="text-4xl font-bold text-charcoal">
            <span lang="el">Κάτι πήγε στραβά</span> / <span lang="en">Something went wrong</span>
          </h1>
          <button
            type="button"
            onClick={reset}
            className="inline-flex min-h-11 w-fit items-center rounded-full bg-ember-600 px-6 py-3 font-semibold text-white hover:bg-ember-700"
          >
            <span lang="el">Δοκιμάστε ξανά</span>&nbsp;/&nbsp;<span lang="en">Try again</span>
          </button>
        </main>
      </body>
    </html>
  );
}
