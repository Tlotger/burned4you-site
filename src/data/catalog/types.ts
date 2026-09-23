export type Product = {
  slug: string;
  name: string;
  description: string;
  material: string;
  image: string;
};

export type Category = {
  slug: string;
  name: string;
  tagline: string;
  description: string;
  heroImage: string;
  products: Product[];
};
