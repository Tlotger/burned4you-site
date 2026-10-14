(function () {
	var toggle = document.querySelector('.mobile-nav-toggle');
	var panel = document.getElementById('mobile-nav-panel');
	if (!toggle || !panel) return;

	toggle.addEventListener('click', function () {
		var open = toggle.classList.toggle('is-open');
		panel.classList.toggle('is-open', open);
		toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
	});

	panel.querySelectorAll('a').forEach(function (link) {
		link.addEventListener('click', function () {
			toggle.classList.remove('is-open');
			panel.classList.remove('is-open');
			toggle.setAttribute('aria-expanded', 'false');
		});
	});
})();
