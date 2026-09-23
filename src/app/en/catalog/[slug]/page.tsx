import type { Metadata } from "next";
import { notFound } from "next/navigation";
import { CategoryView } from "@/components/views/CategoryView";
import { getCategories, getCategory } from "@/data/catalog";

export function generateStaticParams() {
  return getCategories("en").map((category) => ({ slug: category.slug }));
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ slug: string }>;
}): Promise<Metadata> {
  const { slug } = await params;
  const category = getCategory("en", slug);
  if (!category) return {};
  return {
    title: category.name,
    description: category.description,
  };
}

export default async function Page({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const category = getCategory("en", slug);
  if (!category) notFound();

  return <CategoryView lang="en" category={category} />;
}
