import Image from "next/image";
import Link from "next/link";
import type { CSSProperties } from "react";
import { Category } from "@/data/catalog";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

function splitTrailingArrow(text: string): [string, boolean] {
  const trimmed = text.trimEnd();
  const hasArrow = trimmed.endsWith("→");
  return [hasArrow ? trimmed.slice(0, -1).trimEnd() : text, hasArrow];
}

export function CategoryCard({
  category,
  lang,
  index = 0,
}: {
  category: Category;
  lang: Locale;
  index?: number;
}) {
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);
  const count = category.products.length;
  const viewLabel = count === 1 ? dict.catalog.viewOne : dict.catalog.viewMany.replace("{n}", String(count));
  const [labelText, hasArrow] = splitTrailingArrow(viewLabel);

  return (
    <Link
      href={`${prefix}/catalog/${category.slug}`}
      className="drop-in group flex flex-col overflow-hidden rounded-3xl border border-ink/10 bg-paper shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg"
      style={{ "--drop-in-delay": `${Math.min(index, 6) * 45}ms` } as CSSProperties}
    >
      <div className="relative h-48 w-full overflow-hidden bg-ink/5">
        <Image
          src={category.heroImage}
          alt={category.name}
          fill
          sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
          className="object-cover transition-transform duration-300 group-hover:scale-105"
          priority={index === 0}
        />
      </div>
      <div className="flex flex-1 flex-col p-7">
        <p className="text-xs font-semibold tracking-wider text-ember-600 uppercase">
          {category.tagline}
        </p>
        <h3 className="mt-1 font-display text-xl font-bold text-charcoal">{category.name}</h3>
        <p className="mt-2 flex-1 text-sm leading-relaxed text-charcoal/70">{category.description}</p>
        <span className="mt-5 inline-flex items-center gap-1 text-sm font-semibold text-ember-600">
          {labelText}
          {hasArrow && <span className="transition-transform group-hover:translate-x-1">→</span>}
        </span>
      </div>
    </Link>
  );
}
