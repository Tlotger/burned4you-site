import type { Metadata } from "next";
import { Container } from "@/components/Container";
import { Button } from "@/components/Button";
import { siteConfig } from "@/config/site";

export const metadata: Metadata = {
  title: "About",
  description: `Learn more about ${siteConfig.name}.`,
};

const values = [
  {
    title: "Made to order",
    copy: "Nothing sits on a shelf. Every piece is cut and engraved after you place your order.",
  },
  {
    title: "Hand-finished",
    copy: "Every edge is sanded, sealed, and checked by hand before it ships.",
  },
  {
    title: "Real materials",
    copy: "Solid wood and acrylic accents — no flimsy shortcuts.",
  },
];

export default function AboutPage() {
  return (
    <>
      <section className="bg-ink py-20 text-white">
        <Container>
          <p className="text-xs font-semibold tracking-wider text-ember-400 uppercase">Our story</p>
          <h1 className="mt-3 max-w-2xl font-display text-4xl font-bold md:text-5xl">
            A small studio, obsessed with the details
          </h1>
          <p className="mt-6 max-w-2xl text-white/75">
            {siteConfig.name} started with a single laser cutter and a lot of curiosity. Today we
            design and engrave ornaments, bookmarks, and keepsakes for people who want something
            that couldn&apos;t have come from a big-box store.
          </p>
        </Container>
      </section>

      <section className="py-20">
        <Container>
          <div className="grid gap-8 md:grid-cols-3">
            {values.map((value) => (
              <div key={value.title} className="rounded-3xl border border-ink/10 bg-paper p-8">
                <h3 className="font-display text-lg font-bold text-charcoal">{value.title}</h3>
                <p className="mt-2 text-sm leading-relaxed text-charcoal/70">{value.copy}</p>
              </div>
            ))}
          </div>
        </Container>
      </section>

      <section className="bg-cream-soft py-20">
        <Container className="flex flex-col items-center gap-6 text-center">
          <h2 className="font-display text-3xl font-bold text-charcoal">
            Ready to bring your idea to life?
          </h2>
          <Button href="/contact">Get a Custom Quote →</Button>
        </Container>
      </section>
    </>
  );
}
