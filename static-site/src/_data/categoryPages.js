// Builds one entry per (language x category) so each category page exists in every language.
const locales = require("./locales.json");
const categories = {
  el: require("./categories/el.json"),
  en: require("./categories/en.json"),
};

module.exports = locales.flatMap((lang) =>
  categories[lang.code].map((category) => ({ lang, category }))
);
