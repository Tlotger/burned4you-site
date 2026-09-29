import type { CategoryFacts } from "./types";

// Prices are intentionally left unset — fill in real EUR prices here (e.g.
// `price: 18`) when they're decided. Nothing else needs to change: the
// price will show up on the site automatically once it's set.
export const catalogFacts: CategoryFacts[] = [
  {
    slug: "ornaments",
    heroImage: "/products/ornaments/nutcracker-hero.jpeg",
    products: [
      { slug: "nutcracker-ornament", image: "/products/ornaments/nutcracker-ornament.jpeg" },
      { slug: "deer-medallion-ornament", image: "/products/ornaments/deer-medallion-ornament.jpeg" },
      { slug: "layered-christmas-ornament", image: "/products/ornaments/layered-christmas-ornament.png" },
      { slug: "leaping-reindeer-ornament", image: "/products/ornaments/leaping-reindeer-ornament.jpeg" },
      { slug: "north-pole-signpost", image: "/products/ornaments/north-pole-signpost.jpeg" },
    ],
  },
  {
    slug: "bookmarks",
    heroImage: "/products/bookmarks/deer-forest-bookmark.jpeg",
    products: [
      { slug: "deer-forest-bookmark", image: "/products/bookmarks/deer-forest-bookmark.jpeg" },
      { slug: "be-merry-bright-bookmark", image: "/products/bookmarks/be-merry-bright-bookmark.jpeg" },
      { slug: "merry-xmas-bookmark", image: "/products/bookmarks/merry-xmas-bookmark.jpeg" },
      { slug: "gnome-ornament-bookmark", image: "/products/bookmarks/gnome-ornament-bookmark.jpeg" },
    ],
  },
  {
    slug: "coasters",
    heroImage: "/products/coasters/winter-village-coasters.jpeg",
    products: [
      { slug: "winter-village-coasters", image: "/products/coasters/winter-village-coasters.jpeg" },
      { slug: "fireside-coasters", image: "/products/coasters/fireside-coasters.jpeg" },
      { slug: "let-it-snow-coaster", image: "/products/coasters/let-it-snow-coaster.jpeg" },
      { slug: "merry-christmas-lights-coaster", image: "/products/coasters/merry-christmas-lights-coaster.jpeg" },
    ],
  },
  {
    slug: "tealight-holders",
    heroImage: "/products/tealights/deer-forest-tealight.jpeg",
    products: [
      { slug: "deer-forest-tealight", image: "/products/tealights/deer-forest-tealight.jpeg" },
      { slug: "gingerbread-house-tealight", image: "/products/tealights/gingerbread-house-tealight.jpeg" },
      { slug: "snowflake-star-tealight", image: "/products/tealights/snowflake-star-tealight.jpeg" },
      { slug: "pine-trees-tealight", image: "/products/tealights/pine-trees-tealight.jpeg" },
    ],
  },
  {
    slug: "earrings",
    heroImage: "/products/earrings/witch-cat-earrings.jpeg",
    products: [
      { slug: "witch-cat-earrings", image: "/products/earrings/witch-cat-earrings.jpeg" },
      { slug: "ghost-earrings", image: "/products/earrings/ghost-earrings.jpeg" },
      { slug: "heart-cat-earrings", image: "/products/earrings/heart-cat-earrings.jpeg" },
      { slug: "snowflake-heart-earrings", image: "/products/earrings/snowflake-heart-earrings.jpeg" },
    ],
  },
  {
    slug: "wooden-games",
    heroImage: "/products/games/camping-tic-tac-toe.jpeg",
    products: [
      { slug: "camping-tic-tac-toe", image: "/products/games/camping-tic-tac-toe.jpeg" },
      { slug: "pets-tic-tac-toe", image: "/products/games/pets-tic-tac-toe.jpeg" },
      { slug: "spring-tic-tac-toe", image: "/products/games/spring-tic-tac-toe.jpeg" },
      { slug: "summer-tic-tac-toe", image: "/products/games/summer-tic-tac-toe.jpeg" },
    ],
  },
  {
    slug: "pet-keepsakes",
    heroImage: "/products/pets/personalized-pet-ornament.jpeg",
    products: [
      {
        slug: "personalized-pet-ornament",
        image: "/products/pets/personalized-pet-ornament.jpeg",
        personalizable: true,
      },
    ],
  },
];
