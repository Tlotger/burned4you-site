import Link from "next/link";
import { Category } from "@/data/catalog";

export function CategoryCard({ category }: { category: Category }) {
  return (
    <Link
      href={`/catalog/${category.slug}`}
      className="group flex flex-col rounded-3xl border border-ink/10 bg-paper p-7 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg"
    >
      <div className="flex h-16 w-16 items-center justify-center rounded-2xl bg-ember-500/10 text-3xl">
        {category.icon}
      </div>
      <p className="mt-5 text-xs font-semibold tracking-wider text-ember-600 uppercase">
        {category.tagline}
      </p>
      <h3 className="mt-1 font-display text-xl font-bold text-charcoal">{category.name}</h3>
      <p className="mt-2 flex-1 text-sm leading-relaxed text-charcoal/70">{category.description}</p>
      <span className="mt-5 inline-flex items-center gap-1 text-sm font-semibold text-ember-600">
        View {category.products.length} items
        <span className="transition-transform group-hover:translate-x-1">→</span>
      </span>
    </Link>
  );
}
