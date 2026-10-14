(function () {
	var form = document.getElementById('b4y-contact-form');
	if (!form || typeof b4yContact === 'undefined') return;

	var card = form.closest('.contact-form-card');
	var success = card ? card.querySelector('.form-success') : null;
	var errorEl = form.querySelector('.form-error');
	var submitBtn = form.querySelector('.form-submit');
	var itemField = form.querySelector('[name="item"]');
	var categoryField = form.querySelector('[name="category"]');

	// Prefill from ?item=&category=, same as the "Ask About This" link on a
	// product card (src/components/ContactForm.tsx read these via useSearchParams).
	var params = new URLSearchParams(window.location.search);
	if (itemField && params.get('item')) {
		itemField.value = params.get('item');
	}
	if (categoryField && params.get('category')) {
		categoryField.value = params.get('category');
	}

	function showError(message) {
		if (!errorEl) return;
		errorEl.textContent = message;
		errorEl.hidden = false;
	}

	function resetForm() {
		form.reset();
		form.hidden = false;
		if (success) success.hidden = true;
		if (errorEl) errorEl.hidden = true;
	}

	if (success) {
		var resetBtn = success.querySelector('.form-success__reset');
		if (resetBtn) resetBtn.addEventListener('click', resetForm);
	}

	form.addEventListener('submit', function (event) {
		event.preventDefault();
		if (errorEl) errorEl.hidden = true;
		if (submitBtn) {
			submitBtn.disabled = true;
			submitBtn.textContent = b4yContact.i18n.sending;
		}

		var data = new FormData(form);
		data.append('action', 'b4y_contact');
		data.append('nonce', b4yContact.nonce);
		data.append('language', b4yContact.lang);

		fetch(b4yContact.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' })
			.then(function (res) { return res.json().then(function (json) { return { ok: res.ok, json: json }; }); })
			.then(function (result) {
				if (!result.ok || !result.json || !result.json.success) {
					throw new Error('request failed');
				}
				form.hidden = true;
				if (success) success.hidden = false;
			})
			.catch(function () {
				showError(b4yContact.i18n.error);
			})
			.finally(function () {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = b4yContact.i18n.send;
				}
			});
	});
})();
