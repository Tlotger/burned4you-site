import type { Metadata } from "next";
import { Container } from "@/components/Container";
import { CategoryCard } from "@/components/CategoryCard";
import { categories } from "@/data/catalog";

export const metadata: Metadata = {
  title: "Catalog",
  description: "Browse all custom laser engraving categories.",
};

export default function CatalogPage() {
  return (
    <section className="py-20">
      <Container>
        <div className="mx-auto max-w-2xl text-center">
          <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">Full catalog</p>
          <h1 className="mt-3 font-display text-4xl font-bold text-charcoal">Choose a category</h1>
          <p className="mt-4 text-charcoal/70">
            Every item is made to order. Pick a category to see examples, materials, and starting prices.
          </p>
        </div>
        <div className="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {categories.map((category, index) => (
            <CategoryCard key={category.slug} category={category} index={index} />
          ))}
        </div>
      </Container>
    </section>
  );
}
