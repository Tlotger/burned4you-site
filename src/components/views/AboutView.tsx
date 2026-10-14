import { Container } from "@/components/Container";
import { Button } from "@/components/Button";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function AboutView({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);

  return (
    <>
      <section className="bg-ink py-20 text-white">
        <Container>
          <p className="text-sm font-semibold tracking-wide text-ember-400 uppercase">{dict.about.eyebrow}</p>
          <h1 className="mt-3 max-w-2xl font-display text-4xl font-bold md:text-5xl">{dict.about.title}</h1>
          <p className="mt-6 max-w-2xl text-white/75">{dict.about.text}</p>
        </Container>
      </section>

      <section className="py-20">
        <Container>
          <div className="grid gap-8 md:grid-cols-3">
            {dict.about.values.map((value) => (
              <div key={value.title} className="rounded-3xl border border-ink/10 bg-paper p-8">
                <h2 className="font-display text-lg font-bold text-charcoal">{value.title}</h2>
                <p className="mt-2 text-sm leading-relaxed text-charcoal/70">{value.text}</p>
              </div>
            ))}
          </div>
        </Container>
      </section>

      <section className="bg-cream-soft py-20">
        <Container className="flex flex-col items-center gap-6 text-center">
          <h2 className="font-display text-3xl font-bold text-charcoal">{dict.about.ctaTitle}</h2>
          <Button href={`${prefix}/contact`}>{dict.about.ctaButton}</Button>
        </Container>
      </section>
    </>
  );
}
