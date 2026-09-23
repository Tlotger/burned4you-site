import type { Metadata } from "next";
import { CatalogView } from "@/components/views/CatalogView";
import { getDictionary } from "@/i18n/dictionaries";

const dict = getDictionary("el");

export const metadata: Metadata = {
  title: dict.nav.catalog,
  description: dict.catalog.text,
};

export default function Page() {
  return <CatalogView lang="el" />;
}
