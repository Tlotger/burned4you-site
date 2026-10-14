"use client";

import { StatusPage } from "@/components/StatusPage";

export default function Error({ reset }: { error: Error & { digest?: string }; reset: () => void }) {
  return <StatusPage lang="en" kind="error" onRetry={reset} />;
}
