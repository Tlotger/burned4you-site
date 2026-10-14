import { Container } from "@/components/Container";
import { siteConfig } from "@/config/site";
import { getDictionary } from "@/i18n/dictionaries";
import type { Locale } from "@/i18n/config";

export function AccessibilityView({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);
  const { accessibility } = dict;

  return (
    <section className="py-20">
      <Container className="max-w-3xl">
        <h1 className="font-display text-4xl font-bold text-charcoal">{accessibility.title}</h1>
        <p className="mt-6 text-charcoal/75">{accessibility.intro}</p>
        {accessibility.sections.map((section) => (
          <div key={section.title} className="mt-10">
            <h2 className="font-display text-xl font-bold text-charcoal">{section.title}</h2>
            <p className="mt-2 text-charcoal/75">{section.text}</p>
          </div>
        ))}
        <p className="mt-6">
          <a className="font-semibold text-ember-600 underline" href={`mailto:${siteConfig.email}`}>
            {siteConfig.email}
          </a>
        </p>
      </Container>
    </section>
  );
}
