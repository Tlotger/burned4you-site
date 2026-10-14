import { Comfortaa, Inter } from "next/font/google";

export const comfortaa = Comfortaa({
  variable: "--font-comfortaa",
  subsets: ["latin", "greek"],
  weight: ["500", "600", "700"],
});

export const inter = Inter({
  variable: "--font-inter",
  subsets: ["latin", "greek"],
});
