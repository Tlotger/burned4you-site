import Link from "next/link";
import { Product } from "@/data/catalog";

export function ProductCard({
  product,
  categorySlug,
  categoryIcon,
}: {
  product: Product;
  categorySlug: string;
  categoryIcon: string;
}) {
  return (
    <div className="flex flex-col overflow-hidden rounded-3xl border border-ink/10 bg-paper shadow-sm transition-shadow hover:shadow-lg">
      <div className="flex h-40 items-center justify-center bg-gradient-to-br from-ember-500/15 to-ember-400/5 text-5xl">
        {categoryIcon}
      </div>
      <div className="flex flex-1 flex-col p-6">
        <h3 className="font-display text-lg font-bold text-charcoal">{product.name}</h3>
        <p className="mt-2 flex-1 text-sm leading-relaxed text-charcoal/70">{product.description}</p>
        <dl className="mt-4 grid grid-cols-2 gap-2 text-xs text-charcoal/60">
          <div>
            <dt className="font-semibold text-charcoal/80">Material</dt>
            <dd>{product.material}</dd>
          </div>
          <div>
            <dt className="font-semibold text-charcoal/80">Turnaround</dt>
            <dd>{product.turnaround}</dd>
          </div>
        </dl>
        <div className="mt-5 flex items-center justify-between">
          <span className="font-display text-lg font-bold text-ember-600">
            From €{product.startingPrice}
          </span>
          <Link
            href={`/contact?item=${encodeURIComponent(product.name)}&category=${categorySlug}`}
            className="rounded-full bg-ember-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-ember-600"
          >
            Request a Quote
          </Link>
        </div>
      </div>
    </div>
  );
}
