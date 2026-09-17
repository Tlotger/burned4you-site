import { Container } from "@/components/Container";
import { Button } from "@/components/Button";
import { CategoryCard } from "@/components/CategoryCard";
import { categories } from "@/data/catalog";
import { siteConfig } from "@/config/site";

export default function Home() {
  return (
    <>
      {/* Hero */}
      <section className="relative overflow-hidden bg-ink text-white">
        <div className="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-ember-500/20 blur-3xl" />
        <div className="pointer-events-none absolute -left-16 bottom-0 h-64 w-64 rounded-full bg-ember-400/10 blur-3xl" />
        <Container className="relative py-24 md:py-32">
          <p className="inline-block rounded-full border border-white/15 bg-white/5 px-4 py-1.5 text-xs font-semibold tracking-wider text-ember-400 uppercase">
            Custom laser engraving studio
          </p>
          <h1 className="mt-6 max-w-2xl font-display text-4xl font-bold leading-tight md:text-6xl">
            We turn your ideas into
            <span className="text-ember-500"> engraved keepsakes</span>
          </h1>
          <p className="mt-6 max-w-xl text-lg text-white/75">
            {siteConfig.description} Every piece is cut, engraved, and finished by hand — made to order, just for you.
          </p>
          <div className="mt-10 flex flex-wrap gap-4">
            <Button href="/catalog" variant="primary">
              Browse the Catalog →
            </Button>
            <Button href="/contact" variant="outline">
              Get a Custom Quote
            </Button>
          </div>

          <div className="mt-16 flex flex-wrap gap-10">
            {siteConfig.stats.map((stat) => (
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
            <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">What we make</p>
            <h2 className="mt-3 font-display text-3xl font-bold text-charcoal md:text-4xl">
              Explore our categories
            </h2>
            <p className="mt-4 text-charcoal/70">
              From wooden signs to wedding keepsakes — every category is fully customizable.
            </p>
          </div>
          <div className="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {categories.map((category) => (
              <CategoryCard key={category.slug} category={category} />
            ))}
          </div>
        </Container>
      </section>

      {/* How it works */}
      <section className="bg-ink-soft py-24 text-white">
        <Container>
          <div className="mx-auto max-w-2xl text-center">
            <p className="text-xs font-semibold tracking-wider text-ember-400 uppercase">Simple process</p>
            <h2 className="mt-3 font-display text-3xl font-bold md:text-4xl">How ordering works</h2>
          </div>
          <div className="mt-14 grid gap-8 md:grid-cols-3">
            {[
              {
                step: "01",
                title: "Tell us your idea",
                copy: "Pick a category and send us your idea, photo, or design through our quote form.",
              },
              {
                step: "02",
                title: "We craft a proof",
                copy: "We confirm material, size, and price, then get your piece ready to engrave.",
              },
              {
                step: "03",
                title: "Delivered to your door",
                copy: "Your finished, hand-checked piece ships out or is ready for local pickup.",
              },
            ].map((item) => (
              <div key={item.step} className="rounded-3xl border border-white/10 bg-white/5 p-8">
                <span className="font-display text-3xl font-bold text-ember-500">{item.step}</span>
                <h3 className="mt-4 font-display text-lg font-bold">{item.title}</h3>
                <p className="mt-2 text-sm text-white/70">{item.copy}</p>
              </div>
            ))}
          </div>
        </Container>
      </section>

      {/* CTA */}
      <section className="bg-cream py-24">
        <Container className="flex flex-col items-center gap-6 rounded-3xl bg-ember-500 px-8 py-16 text-center text-white">
          <h2 className="font-display text-3xl font-bold md:text-4xl">Have something in mind?</h2>
          <p className="max-w-xl text-white/90">
            Send us your idea and we&apos;ll get back to you with a quote within {siteConfig.stats[2]?.value ?? "a day"}.
          </p>
          <Button href="/contact" variant="outline" className="border-white text-white hover:bg-white/15">
            Start Your Order
          </Button>
        </Container>
      </section>
    </>
  );
}
