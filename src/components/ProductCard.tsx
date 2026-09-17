import Image from "next/image";
import Link from "next/link";
import { Product } from "@/data/catalog";

export function ProductCard({
  product,
  categorySlug,
}: {
  product: Product;
  categorySlug: string;
}) {
  return (
    <div className="flex flex-col overflow-hidden rounded-3xl border border-ink/10 bg-paper shadow-sm transition-shadow hover:shadow-lg">
      <div className="relative h-56 w-full overflow-hidden bg-ink/5">
        <Image
          src={product.image}
          alt={product.name}
          fill
          sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
          className="object-cover"
        />
      </div>
      <div className="flex flex-1 flex-col p-6">
        <h3 className="font-display text-lg font-bold text-charcoal">{product.name}</h3>
        <p className="mt-2 flex-1 text-sm leading-relaxed text-charcoal/70">{product.description}</p>
        <p className="mt-4 text-xs font-semibold text-charcoal/60">
          Material: <span className="font-normal">{product.material}</span>
        </p>
        <div className="mt-5 flex items-center justify-between gap-3">
          <span className="text-sm font-semibold text-ember-600">Made to order</span>
          <Link
            href={`/contact?item=${encodeURIComponent(product.name)}&category=${categorySlug}`}
            className="rounded-full bg-ember-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-ember-600"
          >
            Ask About This
          </Link>
        </div>
      </div>
    </div>
  );
}
