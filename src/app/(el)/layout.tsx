import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";
import { SetHtmlLang } from "@/components/SetHtmlLang";

export default function ElLayout({ children }: { children: React.ReactNode }) {
  return (
    <>
      <SetHtmlLang lang="el" />
      <Header lang="el" />
      <main className="flex-1">{children}</main>
      <Footer lang="el" />
    </>
  );
}
