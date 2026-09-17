import type { Metadata } from "next";
import { Suspense } from "react";
import { Container } from "@/components/Container";
import { ContactForm } from "@/components/ContactForm";
import { siteConfig } from "@/config/site";

export const metadata: Metadata = {
  title: "Contact",
  description: `Get a custom quote from ${siteConfig.name}.`,
};

export default function ContactPage() {
  return (
    <section className="py-20">
      <Container className="grid gap-12 lg:grid-cols-[1fr_1.3fr]">
        <div>
          <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">Get in touch</p>
          <h1 className="mt-3 font-display text-4xl font-bold text-charcoal">Request a Quote</h1>
          <p className="mt-4 text-charcoal/70">
            Tell us what you have in mind and we&apos;ll reply with pricing, materials, and a timeline.
          </p>

          <dl className="mt-10 space-y-4 text-sm">
            <div>
              <dt className="font-semibold text-charcoal">Email</dt>
              <dd className="text-charcoal/70">{siteConfig.email}</dd>
            </div>
            <div>
              <dt className="font-semibold text-charcoal">Phone</dt>
              <dd className="text-charcoal/70">{siteConfig.phone}</dd>
            </div>
            <div>
              <dt className="font-semibold text-charcoal">Studio</dt>
              <dd className="text-charcoal/70">{siteConfig.location}</dd>
            </div>
          </dl>
        </div>

        <div className="rounded-3xl border border-ink/10 bg-paper p-8 shadow-sm">
          <Suspense fallback={null}>
            <ContactForm />
          </Suspense>
        </div>
      </Container>
    </section>
  );
}
