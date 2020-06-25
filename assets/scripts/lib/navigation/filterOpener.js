export function filterOpener() {
	const { openFilterButton, filterWrapper, body } = getElements();

	if (!openFilterButton) {
		return;
	}

	openFilterButton.addEventListener('click', () => {
		if (!filterWrapper) {
			return;
		}

		if (filterWrapper.classList.contains('active')) {
			filterWrapper.classList.remove('active');
			body.dispatchEvent(new Event('filter-closed'));
		} else {
			filterWrapper.classList.add('active');
			body.dispatchEvent(new Event('filter-opened'));
		}
	});
}

function getElements() {
	return {
		openFilterButton: document.querySelector('.js-filter-opener'),
		filterWrapper: document.querySelector('.js-filter-container'),
		body: document.body,
	};
}
