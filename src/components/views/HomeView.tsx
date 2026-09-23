import { Container } from "@/components/Container";
import { Button } from "@/components/Button";
import { CategoryCard } from "@/components/CategoryCard";
import { getCategories } from "@/data/catalog";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function HomeView({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);
  const categories = getCategories(lang);

  return (
    <>
      {/* Hero */}
      <section className="relative overflow-hidden bg-ink text-white">
        <div className="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-ember-500/20 blur-3xl" />
        <div className="pointer-events-none absolute -left-16 bottom-0 h-64 w-64 rounded-full bg-ember-400/10 blur-3xl" />
        <Container className="relative py-24 md:py-32">
          <p className="inline-block rounded-full border border-white/15 bg-white/5 px-4 py-1.5 text-xs font-semibold tracking-wider text-ember-400 uppercase">
            {dict.home.pill}
          </p>
          <h1 className="mt-6 max-w-2xl font-display text-4xl font-bold leading-tight md:text-6xl">
            {dict.home.h1Before}
            <span className="text-ember-500"> {dict.home.h1Em}</span>
          </h1>
          <p className="mt-6 max-w-xl text-lg text-white/75">
            {dict.description} {dict.home.lead2}
          </p>
          <div className="mt-10 flex flex-wrap gap-4">
            <Button href={`${prefix}/catalog`} variant="primary">
              {dict.home.browse}
            </Button>
            <Button href={`${prefix}/contact`} variant="outline">
              {dict.home.secondary}
            </Button>
          </div>

          <div className="mt-16 flex flex-wrap gap-10">
            {dict.stats.map((stat) => (
              <div key={stat.label}>
                <div className="font-display text-3xl font-bold text-ember-500">{stat.value}</div>
                <div className="text-sm text-white/60">{stat.label}</div>
              </div>
            ))}
          </div>
        </Container>
      </section>

      {/* Categories */}
      <section className="bg-cream py-24">
        <Container>
          <div className="mx-auto max-w-2xl text-center">
            <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">{dict.home.catsEyebrow}</p>
            <h2 className="mt-3 font-display text-3xl font-bold text-charcoal md:text-4xl">
              {dict.home.catsTitle}
            </h2>
            <p className="mt-4 text-charcoal/70">{dict.home.catsText}</p>
          </div>
          <div className="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {categories.map((category, index) => (
              <CategoryCard key={category.slug} category={category} lang={lang} index={index} />
            ))}
          </div>
        </Container>
      </section>

      {/* How it works */}
      <section className="bg-ink-soft py-24 text-white">
        <Container>
          <div className="mx-auto max-w-2xl text-center">
            <p className="text-xs font-semibold tracking-wider text-ember-400 uppercase">{dict.home.processEyebrow}</p>
            <h2 className="mt-3 font-display text-3xl font-bold md:text-4xl">{dict.home.processTitle}</h2>
          </div>
          <div className="mt-14 grid gap-8 md:grid-cols-3">
            {dict.home.steps.map((item) => (
              <div key={item.n} className="rounded-3xl border border-white/10 bg-white/5 p-8">
                <span className="font-display text-3xl font-bold text-ember-500">{item.n}</span>
                <h3 className="mt-4 font-display text-lg font-bold">{item.title}</h3>
                <p className="mt-2 text-sm text-white/70">{item.text}</p>
              </div>
            ))}
          </div>
        </Container>
      </section>

      {/* CTA */}
      <section className="bg-cream py-24">
        <Container className="flex flex-col items-center gap-6 rounded-3xl bg-ember-500 px-8 py-16 text-center text-white">
          <h2 className="font-display text-3xl font-bold md:text-4xl">{dict.home.ctaTitle}</h2>
          <p className="max-w-xl text-white/90">{dict.home.ctaText}</p>
          <Button href={`${prefix}/contact`} variant="outline" className="border-white text-white hover:bg-white/15">
            {dict.home.ctaButton}
          </Button>
        </Container>
      </section>
    </>
  );
}
