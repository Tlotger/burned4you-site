import type { Metadata } from "next";
import Link from "next/link";
import { notFound } from "next/navigation";
import { Container } from "@/components/Container";
import { ProductCard } from "@/components/ProductCard";
import { categories, getCategory } from "@/data/catalog";

export function generateStaticParams() {
  return categories.map((category) => ({ slug: category.slug }));
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ slug: string }>;
}): Promise<Metadata> {
  const { slug } = await params;
  const category = getCategory(slug);
  if (!category) return {};
  return {
    title: category.name,
    description: category.description,
  };
}

export default async function CategoryPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const category = getCategory(slug);
  if (!category) notFound();

  return (
    <section className="py-20">
      <Container>
        <Link href="/catalog" className="text-sm font-semibold text-ember-600 hover:underline">
          ← All categories
        </Link>
        <div className="mt-4 flex items-start gap-4">
          <div className="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-ember-500/10 text-3xl">
            {category.icon}
          </div>
          <div>
            <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">{category.tagline}</p>
            <h1 className="mt-1 font-display text-3xl font-bold text-charcoal md:text-4xl">{category.name}</h1>
            <p className="mt-2 max-w-2xl text-charcoal/70">{category.description}</p>
          </div>
        </div>

        <div className="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {category.products.map((product) => (
            <ProductCard
              key={product.slug}
              product={product}
              categorySlug={category.slug}
              categoryIcon={category.icon}
            />
          ))}
        </div>
      </Container>
    </section>
  );
}
