import type { Metadata } from "next";
import { HomeView } from "@/components/views/HomeView";
import { getDictionary } from "@/i18n/dictionaries";

const dict = getDictionary("el");

export const metadata: Metadata = {
  title: dict.nav.home,
  description: dict.description,
};

export default function Page() {
  return <HomeView lang="el" />;
}
