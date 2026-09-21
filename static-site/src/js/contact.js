// Pre-fills the contact form when arriving from a product's "Ask About This" button.
const params = new URLSearchParams(window.location.search);
const item = params.get("item");
const category = params.get("category");
if (item) document.getElementById("item").value = item;
if (category) document.getElementById("category").value = category;
