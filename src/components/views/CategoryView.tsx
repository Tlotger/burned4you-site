import Image from "next/image";
import Link from "next/link";
import { Container } from "@/components/Container";
import { ProductCard } from "@/components/ProductCard";
import type { Category } from "@/data/catalog";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function CategoryView({ lang, category }: { lang: Locale; category: Category }) {
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);

  return (
    <section className="py-20">
      <Container>
        <Link href={`${prefix}/catalog`} className="text-sm font-semibold text-ember-600 hover:underline">
          {dict.catalog.back}
        </Link>
        <div className="mt-4 flex flex-col gap-6 md:flex-row md:items-center">
          <div className="relative h-48 w-full shrink-0 overflow-hidden rounded-3xl md:h-40 md:w-64">
            <Image src={category.heroImage} alt={category.name} fill sizes="256px" className="object-cover" priority />
          </div>
          <div>
            <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">{category.tagline}</p>
            <h1 className="mt-1 font-display text-3xl font-bold text-charcoal md:text-4xl">{category.name}</h1>
            <p className="mt-2 max-w-2xl text-charcoal/70">{category.description}</p>
          </div>
        </div>

        <div className="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {category.products.map((product, index) => (
            <ProductCard
              key={product.slug}
              product={product}
              categorySlug={category.slug}
              lang={lang}
              index={index}
            />
          ))}
        </div>
      </Container>
    </section>
  );
}
