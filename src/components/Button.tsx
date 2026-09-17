import Link from "next/link";
import { ReactNode } from "react";

type ButtonProps = {
  href: string;
  children: ReactNode;
  variant?: "primary" | "outline" | "ghost";
  className?: string;
};

const variants: Record<NonNullable<ButtonProps["variant"]>, string> = {
  primary:
    "bg-ember-500 text-white hover:bg-ember-600 shadow-lg shadow-ember-500/20",
  outline:
    "border-2 border-white/30 text-white hover:bg-white/10",
  ghost:
    "border-2 border-ink/15 text-charcoal hover:border-ember-500 hover:text-ember-600",
};

export function Button({ href, children, variant = "primary", className = "" }: ButtonProps) {
  return (
    <Link
      href={href}
      className={`inline-flex items-center gap-2 rounded-full px-6 py-3 font-semibold transition-colors ${variants[variant]} ${className}`}
    >
      {children}
    </Link>
  );
}
