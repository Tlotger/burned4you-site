import Link from "next/link";
import { Container } from "./Container";
import { getDictionary } from "@/i18n/dictionaries";
import { prefixFor, type Locale } from "@/i18n/config";

export function StatusPage({
  lang,
  kind,
  onRetry,
}: {
  lang: Locale;
  kind: "notFound" | "error";
  onRetry?: () => void;
}) {
  const { status } = getDictionary(lang);
  const title = kind === "notFound" ? status.notFoundTitle : status.errorTitle;
  const text = kind === "notFound" ? status.notFoundText : status.errorText;

  return (
    <section className="py-24">
      <Container className="flex flex-col items-start gap-6">
        <h1 className="font-display text-4xl font-bold text-charcoal">{title}</h1>
        <p className="max-w-xl text-charcoal/75">{text}</p>
        <div className="flex flex-wrap gap-3">
          {onRetry && (
            <button
              type="button"
              onClick={onRetry}
              className="inline-flex min-h-11 items-center rounded-full bg-ember-600 px-6 py-3 font-semibold text-white transition-colors hover:bg-ember-700"
            >
              {status.retry}
            </button>
          )}
          <Link
            href={`${prefixFor(lang)}/`}
            className="inline-flex min-h-11 items-center rounded-full border-2 border-charcoal/55 px-6 py-3 font-semibold text-charcoal transition-colors hover:border-ember-600 hover:text-ember-600"
          >
            {status.home}
          </Link>
        </div>
      </Container>
    </section>
  );
}
