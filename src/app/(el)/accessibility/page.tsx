import type { Metadata } from "next";
import { AccessibilityView } from "@/components/views/AccessibilityView";
import { getDictionary } from "@/i18n/dictionaries";

const dict = getDictionary("el");

export const metadata: Metadata = {
  title: dict.accessibility.title,
  description: dict.accessibility.intro,
};

export default function Page() {
  return <AccessibilityView lang="el" />;
}
