"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import type { ComponentProps } from "react";

type NavLinkProps = Omit<ComponentProps<typeof Link>, "href" | "aria-current"> & { href: string };

const normalize = (path: string) => path.replace(/\/+$/, "") || "/";

// Link that marks itself as the current page for assistive tech. A locale home
// ("/" or "/en") only matches exactly; other links match their whole subtree.
export function NavLink({ href, children, ...props }: NavLinkProps) {
  const path = normalize(usePathname() || "/");
  const target = normalize(href);
  const isLocaleHome = target === "/" || target === "/en";
  const current = isLocaleHome ? path === target : path === target || path.startsWith(`${target}/`);

  return (
    <Link href={href} aria-current={current ? "page" : undefined} {...props}>
      {children}
    </Link>
  );
}
