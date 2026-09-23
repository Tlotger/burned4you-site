"use client";

import { useSearchParams } from "next/navigation";
import { useState, FormEvent } from "react";
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
      <div className="rounded-3xl border border-ember-500/30 bg-ember-500/10 p-8 text-center">
        <h3 className="font-display text-xl font-bold text-charcoal">{dict.contact.successTitle}</h3>
        <p className="mt-2 text-charcoal/70">{dict.contact.successText}</p>
        <button
          onClick={() => setStatus("idle")}
          className="mt-6 rounded-full border-2 border-ink/15 px-5 py-2.5 text-sm font-semibold hover:border-ember-500"
        >
          {dict.contact.sendAnother}
        </button>
      </div>
    );
  }

  return (
    <form onSubmit={handleSubmit} className="grid gap-5">
      <div className="grid gap-5 sm:grid-cols-2">
        <Field label={dict.contact.name} name="name" required />
        <Field label={dict.contact.email} name="email" type="email" required />
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
            className="w-full rounded-xl border border-ink/15 bg-paper px-4 py-3 text-sm focus:border-ember-500 focus:outline-none"
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
        </label>
        <textarea
          id="message"
          name="message"
          required
          rows={5}
          className="w-full rounded-xl border border-ink/15 bg-paper px-4 py-3 text-sm focus:border-ember-500 focus:outline-none"
          placeholder={dict.contact.placeholder}
        />
      </div>

      {status === "error" && (
        <p className="rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">{errorMessage}</p>
      )}

      <button
        type="submit"
        disabled={status === "submitting"}
        className="inline-flex w-fit items-center gap-2 rounded-full bg-ember-500 px-6 py-3 font-semibold text-white transition-colors hover:bg-ember-600 disabled:opacity-60"
      >
        {status === "submitting" ? dict.contact.sending : dict.contact.send}
      </button>
    </form>
  );
}

function Field({
  label,
  name,
  type = "text",
  required,
  defaultValue,
}: {
  label: string;
  name: string;
  type?: string;
  required?: boolean;
  defaultValue?: string;
}) {
  return (
    <div>
      <label className="mb-1.5 block text-sm font-semibold text-charcoal" htmlFor={name}>
        {label}
      </label>
      <input
        id={name}
        name={name}
        type={type}
        required={required}
        defaultValue={defaultValue}
        className="w-full rounded-xl border border-ink/15 bg-paper px-4 py-3 text-sm focus:border-ember-500 focus:outline-none"
      />
    </div>
  );
}
