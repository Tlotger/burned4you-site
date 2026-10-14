import type { Metadata } from "next";
import "../globals.css";
import { RootShell } from "@/components/RootShell";
import { siteConfig } from "@/config/site";

export const metadata: Metadata = {
  title: { default: siteConfig.name, template: `%s | ${siteConfig.name}` },
};

export default function EnLayout({ children }: { children: React.ReactNode }) {
  return <RootShell lang="en">{children}</RootShell>;
}
