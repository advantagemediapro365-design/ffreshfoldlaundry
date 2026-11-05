(function () {
	'use strict';

	var menuButton = document.querySelector('.menu-toggle');
	var navPanel = document.querySelector('.nav-panel');

	if (menuButton && navPanel) {
		var closeMenu = function () {
			menuButton.setAttribute('aria-expanded', 'false');
			navPanel.classList.remove('is-open');
		};

		menuButton.addEventListener('click', function () {
			var isOpen = menuButton.getAttribute('aria-expanded') === 'true';
			menuButton.setAttribute('aria-expanded', String(!isOpen));
			navPanel.classList.toggle('is-open', !isOpen);
		});
		navPanel.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', closeMenu);
		});
		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape' && menuButton.getAttribute('aria-expanded') === 'true') {
				closeMenu();
				menuButton.focus();
			}
		});
	}

	document.querySelectorAll('[data-service-area-form]').forEach(function (form) {
		form.addEventListener('submit', function (event) {
			event.preventDefault();
			var input = form.querySelector('input[name="zipcode"]');
			var result = form.querySelector('.zipbox-result');
			var zip = input ? input.value.trim() : '';

			if (!result || !input || !input.checkValidity()) {
				if (input) input.reportValidity();
				return;
			}

			result.textContent = 'Checking your ZIP code...';
			fetch(freshFoldSettings.serviceAreaUrl + '?zip=' + encodeURIComponent(zip), {
				headers: { 'X-WP-Nonce': freshFoldSettings.nonce }
			})
				.then(function (response) {
					if (!response.ok) throw new Error('ZIP check failed');
					return response.json();
				})
				.then(function (availability) {
					result.textContent = availability.label + ': ' + availability.summary;
					result.dataset.status = availability.status;
					result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
				})
				.catch(function () {
					result.textContent = 'We could not check your ZIP code right now. Please call 570-494-7523.';
					result.dataset.status = 'error';
					result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
				});
		});
	});
})();
