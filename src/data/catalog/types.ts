// Facts about a product that don't change by language — kept in one place
// (shared.ts) so a price or photo can never drift between translations.
export type ProductFacts = {
  slug: string;
  image: string;
  /** EUR, excluding VAT/shipping. Leave unset until real pricing is set. */
  price?: number;
  /** Whether this item can be personalized (e.g. a name or short text). */
  personalizable?: boolean;
};

export type CategoryFacts = {
  slug: string;
  heroImage: string;
  products: ProductFacts[];
};

// Translated text for a product/category, looked up by slug so it can't
// silently get out of order with the facts above.
export type ProductText = {
  name: string;
  description: string;
  material: string;
};

export type CategoryText = {
  name: string;
  tagline: string;
  description: string;
  products: Record<string, ProductText>;
};

export type CatalogText = Record<string, CategoryText>;

// The merged, ready-to-render shape used throughout the app.
export type Product = ProductFacts & ProductText;

export type Category = {
  slug: string;
  heroImage: string;
  name: string;
  tagline: string;
  description: string;
  products: Product[];
};
