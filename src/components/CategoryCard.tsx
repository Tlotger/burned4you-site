import Image from "next/image";
import Link from "next/link";
import type { CSSProperties } from "react";
import { Category } from "@/data/catalog";

export function CategoryCard({ category, index = 0 }: { category: Category; index?: number }) {
  return (
    <Link
      href={`/catalog/${category.slug}`}
      className="drop-in group flex flex-col overflow-hidden rounded-3xl border border-ink/10 bg-paper shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg"
      style={{ "--drop-in-delay": `${Math.min(index, 8) * 70}ms` } as CSSProperties}
    >
      <div className="relative h-48 w-full overflow-hidden bg-ink/5">
        <Image
          src={category.heroImage}
          alt={category.name}
          fill
          sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
          className="object-cover transition-transform duration-300 group-hover:scale-105"
        />
      </div>
      <div className="flex flex-1 flex-col p-7">
        <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">
          {category.tagline}
        </p>
        <h3 className="mt-1 font-display text-xl font-bold text-charcoal">{category.name}</h3>
        <p className="mt-2 flex-1 text-sm leading-relaxed text-charcoal/70">{category.description}</p>
        <span className="mt-5 inline-flex items-center gap-1 text-sm font-semibold text-ember-600">
          View {category.products.length} items
          <span className="transition-transform group-hover:translate-x-1">→</span>
        </span>
      </div>
    </Link>
  );
}
