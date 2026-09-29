import Image from "next/image";
import Link from "next/link";
import type { CSSProperties } from "react";
import { Product } from "@/data/catalog";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";
import { formatPrice } from "@/lib/currency";

export function ProductCard({
  product,
  categorySlug,
  lang,
  index = 0,
}: {
  product: Product;
  categorySlug: string;
  lang: Locale;
  index?: number;
}) {
  const dict = getDictionary(lang);
  const prefix = prefixFor(lang);

  return (
    <div
      className="drop-in flex flex-col overflow-hidden rounded-3xl border border-ink/10 bg-paper shadow-sm transition-shadow hover:shadow-lg"
      style={{ "--drop-in-delay": `${Math.min(index, 6) * 45}ms` } as CSSProperties}
    >
      <div className="relative h-56 w-full overflow-hidden bg-ink/5">
        <Image
          src={product.image}
          alt={product.name}
          fill
          sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
          className="object-cover"
          priority={index === 0}
        />
      </div>
      <div className="flex flex-1 flex-col p-6">
        <h3 className="font-display text-lg font-bold text-charcoal">{product.name}</h3>
        <p className="mt-2 flex-1 text-sm leading-relaxed text-charcoal/70">{product.description}</p>
        <p className="mt-4 text-xs font-semibold text-charcoal/60">
          {dict.catalog.material} <span className="font-normal">{product.material}</span>
        </p>
        {product.personalizable && (
          <p className="mt-1 text-xs font-semibold text-ember-600">{dict.catalog.personalizable}</p>
        )}
        <div className="mt-5 flex items-center justify-between gap-3">
          <span className="text-sm font-semibold text-ember-600">
            {product.price != null ? formatPrice(product.price, lang) : dict.catalog.madeToOrder}
          </span>
          <Link
            href={`${prefix}/contact?item=${encodeURIComponent(product.name)}&category=${categorySlug}`}
            className="rounded-full bg-ember-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-ember-600"
          >
            {dict.catalog.ask}
          </Link>
        </div>
      </div>
    </div>
  );
}
