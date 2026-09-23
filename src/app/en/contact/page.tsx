import type { Metadata } from "next";
import { ContactView } from "@/components/views/ContactView";
import { getDictionary } from "@/i18n/dictionaries";

const dict = getDictionary("en");

export const metadata: Metadata = {
  title: dict.nav.contact,
  description: dict.contact.text,
};

export default function Page() {
  return <ContactView lang="en" />;
}
