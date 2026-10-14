"use client";

import { useSearchParams } from "next/navigation";
import { useEffect, useRef, useState, FormEvent } from "react";
import { getCategories } from "@/data/catalog";
import { getDictionary } from "@/i18n/dictionaries";
import type { Locale } from "@/i18n/config";

type Status = "idle" | "submitting" | "success" | "error";

export function ContactForm({ lang }: { lang: Locale }) {
  const dict = getDictionary(lang);
  const categories = getCategories(lang);
  const searchParams = useSearchParams();
  const prefillItem = searchParams.get("item") ?? "";
  const prefillCategory = searchParams.get("category") ?? "";

  const [status, setStatus] = useState<Status>("idle");
  const [errorMessage, setErrorMessage] = useState("");
  const successRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (status === "success") successRef.current?.focus();
  }, [status]);

  async function handleSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setStatus("submitting");
    setErrorMessage("");

    const form = event.currentTarget;
    const data = Object.fromEntries(new FormData(form).entries());

    try {
      const res = await fetch("/api/contact", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ ...data, language: lang }),
      });

      if (!res.ok) throw new Error();

      setStatus("success");
      form.reset();
    } catch {
      setStatus("error");
      setErrorMessage(dict.contact.genericError);
    }
  }

  if (status === "success") {
    return (
      <div
        ref={successRef}
        tabIndex={-1}
        role="status"
        className="rounded-3xl border border-ember-600/40 bg-ember-500/10 p-8 text-center focus:outline-none"
      >
        <h2 className="font-display text-xl font-bold text-charcoal">{dict.contact.successTitle}</h2>
        <p className="mt-2 text-charcoal/70">{dict.contact.successText}</p>
        <button
          type="button"
          onClick={() => setStatus("idle")}
          className="mt-6 rounded-full border-2 border-charcoal/55 px-5 py-3 text-sm font-semibold hover:border-ember-600"
        >
          {dict.contact.sendAnother}
        </button>
      </div>
    );
  }

  return (
    <form onSubmit={handleSubmit} aria-busy={status === "submitting"} className="grid gap-5">
      <p className="text-sm text-charcoal/75">{dict.contact.requiredNote}</p>
      <div className="grid gap-5 sm:grid-cols-2">
        <Field label={dict.contact.name} name="name" autoComplete="name" required />
        <Field label={dict.contact.email} name="email" type="email" autoComplete="email" required />
      </div>

      <div className="grid gap-5 sm:grid-cols-2">
        <div>
          <label className="mb-1.5 block text-sm font-semibold text-charcoal" htmlFor="category">
            {dict.contact.category}
          </label>
          <select
            id="category"
            name="category"
            defaultValue={prefillCategory}
            className={fieldClass}
          >
            <option value="">{dict.contact.general}</option>
            {categories.map((category) => (
              <option key={category.slug} value={category.slug}>
                {category.name}
              </option>
            ))}
          </select>
        </div>
        <Field label={dict.contact.item} name="item" defaultValue={prefillItem} />
      </div>

      <div>
        <label className="mb-1.5 block text-sm font-semibold text-charcoal" htmlFor="message">
          {dict.contact.message}
          <RequiredMark />
        </label>
        <textarea
          id="message"
          name="message"
          required
          rows={5}
          className={fieldClass}
          placeholder={dict.contact.placeholder}
        />
      </div>

      {status === "error" && (
        <p role="alert" className="rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">
          {errorMessage}
        </p>
      )}

      <button
        type="submit"
        disabled={status === "submitting"}
        className="inline-flex w-fit items-center gap-2 rounded-full bg-ember-600 px-6 py-3 font-semibold text-white transition-colors hover:bg-ember-700 disabled:opacity-60"
      >
        {status === "submitting" ? dict.contact.sending : dict.contact.send}
      </button>
    </form>
  );
}

const fieldClass = "w-full rounded-xl border border-charcoal/55 bg-paper px-4 py-3 text-sm";

function RequiredMark() {
  return (
    <span aria-hidden="true" className="text-ember-600">
      {" "}
      *
    </span>
  );
}

function Field({
  label,
  name,
  type = "text",
  required,
  autoComplete,
  defaultValue,
}: {
  label: string;
  name: string;
  type?: string;
  required?: boolean;
  autoComplete?: string;
  defaultValue?: string;
}) {
  return (
    <div>
      <label className="mb-1.5 block text-sm font-semibold text-charcoal" htmlFor={name}>
        {label}
        {required && <RequiredMark />}
      </label>
      <input
        id={name}
        name={name}
        type={type}
        required={required}
        autoComplete={autoComplete}
        defaultValue={defaultValue}
        className={fieldClass}
      />
    </div>
  );
}
