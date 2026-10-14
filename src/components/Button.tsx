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
    "bg-ember-600 text-white hover:bg-ember-700 shadow-lg shadow-ember-600/20",
  outline:
    "border-2 border-white/55 text-white hover:bg-white/10",
  ghost:
    "border-2 border-charcoal/55 text-charcoal hover:border-ember-600 hover:text-ember-600",
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
