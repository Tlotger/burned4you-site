import { Container } from "@/components/Container";
import { CategoryCard } from "@/components/CategoryCard";
import { getCategories } from "@/data/catalog";
import { getDictionary } from "@/i18n/dictionaries";
import type { Locale } from "@/i18n/config";

export function CatalogView({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);
  const categories = getCategories(lang);

  return (
    <section className="py-20">
      <Container>
        <div className="mx-auto max-w-2xl text-center">
          <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">{dict.catalog.eyebrow}</p>
          <h1 className="mt-3 font-display text-4xl font-bold text-charcoal">{dict.catalog.title}</h1>
          <p className="mt-4 text-charcoal/70">{dict.catalog.text}</p>
        </div>
        <div className="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {categories.map((category, index) => (
            <CategoryCard key={category.slug} category={category} lang={lang} index={index} />
          ))}
        </div>
      </Container>
    </section>
  );
}
