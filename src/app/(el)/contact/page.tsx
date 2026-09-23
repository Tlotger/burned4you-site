import type { Metadata } from "next";
import { ContactView } from "@/components/views/ContactView";
import { getDictionary } from "@/i18n/dictionaries";

const dict = getDictionary("el");

export const metadata: Metadata = {
  title: dict.nav.contact,
  description: dict.contact.text,
};

export default function Page() {
  return <ContactView lang="el" />;
}
