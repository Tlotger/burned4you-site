import { Suspense } from "react";
import { Container } from "@/components/Container";
import { ContactForm } from "@/components/ContactForm";
import { siteConfig } from "@/config/site";
import { getDictionary } from "@/i18n/dictionaries";
import type { Locale } from "@/i18n/config";

export function ContactView({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);

  return (
    <section className="py-20">
      <Container className="grid gap-12 lg:grid-cols-[1fr_1.3fr]">
        <div>
          <p className="text-sm font-semibold tracking-wide text-ember-600 uppercase">{dict.contact.eyebrow}</p>
          <h1 className="mt-3 font-display text-4xl font-bold text-charcoal">{dict.contact.title}</h1>
          <p className="mt-4 text-charcoal/70">{dict.contact.text}</p>

          <dl className="mt-10 space-y-4 text-sm">
            <div>
              <dt className="font-semibold text-charcoal">{dict.contact.email}</dt>
              <dd>
                <a className="text-charcoal/70 underline hover:text-ember-600" href={`mailto:${siteConfig.email}`}>
                  {siteConfig.email}
                </a>
              </dd>
            </div>
            <div>
              <dt className="font-semibold text-charcoal">{dict.contact.phone}</dt>
              <dd>
                <a className="text-charcoal/70 underline hover:text-ember-600" href={`tel:${siteConfig.phone.replace(/\s/g, "")}`}>
                  {siteConfig.phone}
                </a>
              </dd>
            </div>
            <div>
              <dt className="font-semibold text-charcoal">{dict.contact.studio}</dt>
              <dd className="text-charcoal/70">{dict.location}</dd>
            </div>
          </dl>
        </div>

        <div className="rounded-3xl border border-ink/10 bg-paper p-8 shadow-sm">
          <Suspense fallback={null}>
            <ContactForm lang={lang} />
          </Suspense>
        </div>
      </Container>
    </section>
  );
}
