export type Product = {
  slug: string;
  name: string;
  description: string;
  material: string;
  startingPrice: number;
  turnaround: string;
};

export type Category = {
  slug: string;
  name: string;
  icon: string;
  tagline: string;
  description: string;
  products: Product[];
};

export const categories: Category[] = [
  {
    slug: "wooden-signs",
    name: "Wooden Signs & Decor",
    icon: "\u{1FAB5}",
    tagline: "Signage that warms up a room",
    description:
      "House signs, welcome boards, and wall art engraved into solid wood and finished by hand.",
    products: [
      {
        slug: "family-name-sign",
        name: "Family Name Sign",
        description: "A large entryway sign engraved with your family name and established date.",
        material: "Solid oak or pine",
        startingPrice: 38,
        turnaround: "3-5 days",
      },
      {
        slug: "house-number-plaque",
        name: "House Number Plaque",
        description: "Weather-treated address plaque with custom numerals and font.",
        material: "Sealed birch plywood",
        startingPrice: 24,
        turnaround: "2-4 days",
      },
      {
        slug: "map-coordinates-art",
        name: "Coordinates Wall Art",
        description: "Engraved map coordinates marking a special place — home, first date, a proposal spot.",
        material: "Walnut veneer",
        startingPrice: 32,
        turnaround: "3-5 days",
      },
    ],
  },
  {
    slug: "personalized-gifts",
    name: "Personalized Gifts",
    icon: "\u{1F381}",
    tagline: "Small things, made just for someone",
    description:
      "Photo engravings, keepsake boxes, and everyday items turned into one-of-a-kind gifts.",
    products: [
      {
        slug: "photo-engraved-frame",
        name: "Photo-Engraved Frame",
        description: "Upload a photo and we'll engrave a keepsake portrait into a wooden frame.",
        material: "Maple wood",
        startingPrice: 28,
        turnaround: "3-5 days",
      },
      {
        slug: "keepsake-box",
        name: "Initial Keepsake Box",
        description: "A lined wooden box engraved with initials or a short message.",
        material: "Bamboo",
        startingPrice: 22,
        turnaround: "2-4 days",
      },
      {
        slug: "engraved-jewelry-tag",
        name: "Engraved Jewelry Tag",
        description: "A dainty acrylic or metal tag engraved with a name, date, or coordinates.",
        material: "Acrylic or stainless steel",
        startingPrice: 14,
        turnaround: "1-3 days",
      },
    ],
  },
  {
    slug: "corporate-gifts",
    name: "Corporate & Business Gifts",
    icon: "\u{1F4BC}",
    tagline: "Branded gifts people actually keep",
    description:
      "Logo engraving on desk accessories, plaques, and bulk client or employee gifts.",
    products: [
      {
        slug: "logo-desk-plaque",
        name: "Logo Desk Plaque",
        description: "Office nameplate or award plaque engraved with your company logo.",
        material: "Walnut or acrylic",
        startingPrice: 26,
        turnaround: "3-6 days",
      },
      {
        slug: "branded-pen-set",
        name: "Branded Pen Set",
        description: "Wooden pens engraved with a logo, great for client gifts and events.",
        material: "Cherry wood",
        startingPrice: 12,
        turnaround: "5-7 days (bulk)",
      },
      {
        slug: "employee-award",
        name: "Employee Recognition Award",
        description: "A custom award piece engraved with employee name and achievement.",
        material: "Glass or walnut",
        startingPrice: 34,
        turnaround: "4-6 days",
      },
    ],
  },
  {
    slug: "wedding-gifts",
    name: "Wedding & Anniversary",
    icon: "\u{1F48D}",
    tagline: "For the milestones worth marking",
    description:
      "Guest books, cake toppers, and matching sets engraved for weddings and anniversaries.",
    products: [
      {
        slug: "wooden-guest-book",
        name: "Wooden Guest Book Alternative",
        description: "A engraved wood-slice or drop-box guest book guests sign with a pen.",
        material: "Birch",
        startingPrice: 45,
        turnaround: "5-7 days",
      },
      {
        slug: "cake-topper",
        name: "Custom Cake Topper",
        description: "Names or a monogram engraved into a slim acrylic or wood topper.",
        material: "Acrylic or plywood",
        startingPrice: 16,
        turnaround: "2-4 days",
      },
      {
        slug: "his-hers-glasses",
        name: "His & Hers Glass Set",
        description: "A matching pair of glasses engraved with names and wedding date.",
        material: "Glass",
        startingPrice: 30,
        turnaround: "3-5 days",
      },
    ],
  },
  {
    slug: "pet-tags",
    name: "Pet Tags & Accessories",
    icon: "\u{1F43E}",
    tagline: "For the four-legged family members",
    description: "Durable engraved pet ID tags and matching accessories.",
    products: [
      {
        slug: "pet-id-tag",
        name: "Pet ID Tag",
        description: "A round or bone-shaped tag engraved with your pet's name and your phone number.",
        material: "Stainless steel",
        startingPrice: 9,
        turnaround: "1-2 days",
      },
      {
        slug: "leash-hook",
        name: "Engraved Leash Hook",
        description: "A wall-mounted wooden hook engraved with your pet's name.",
        material: "Pine",
        startingPrice: 15,
        turnaround: "2-3 days",
      },
    ],
  },
  {
    slug: "drinkware",
    name: "Drinkware & Kitchen",
    icon: "☕",
    tagline: "Everyday items, personal touch",
    description: "Cutting boards, coasters, and tumblers engraved for the kitchen and table.",
    products: [
      {
        slug: "cutting-board",
        name: "Personalized Cutting Board",
        description: "A family name or recipe engraved into a solid wood cutting board.",
        material: "Acacia wood",
        startingPrice: 27,
        turnaround: "3-5 days",
      },
      {
        slug: "coaster-set",
        name: "Engraved Coaster Set",
        description: "A set of 4 matching coasters engraved with initials or a design.",
        material: "Slate or wood",
        startingPrice: 20,
        turnaround: "2-4 days",
      },
      {
        slug: "travel-tumbler",
        name: "Engraved Travel Tumbler",
        description: "A stainless steel tumbler engraved with a name or short message.",
        material: "Stainless steel",
        startingPrice: 18,
        turnaround: "2-3 days",
      },
    ],
  },
];

export function getCategory(slug: string) {
  return categories.find((category) => category.slug === slug);
}

export function getAllProducts() {
  return categories.flatMap((category) =>
    category.products.map((product) => ({ ...product, categorySlug: category.slug, categoryName: category.name }))
  );
}
