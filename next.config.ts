import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  experimental: {
    // Multiple root layouts (one per locale) need a global 404 for unmatched URLs.
    globalNotFound: true,
  },
};

export default nextConfig;
