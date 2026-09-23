import type { Metadata } from "next";
import { AboutView } from "@/components/views/AboutView";
import { getDictionary } from "@/i18n/dictionaries";

const dict = getDictionary("el");

export const metadata: Metadata = {
  title: dict.nav.about,
  description: dict.about.text,
};

export default function Page() {
  return <AboutView lang="el" />;
}
