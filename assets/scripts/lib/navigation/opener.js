export function navOpener() {
	const { button, menu } = getElements();

	if (!button) {
		 return;
	}

	button.addEventListener('click', () => {
		if (!menu.classList.contains('active')) {
			showMenu(menu);
			blockBody();
		} else {
			hideMenu(menu);
			unblockBody();
		}
	});

	document.body.addEventListener('click', e => {
		if (e.target === menu || menu.contains(e.target) || e.target === button || button.contains(e.target) ) {
			return;
		}

		if (menu.classList.contains('active')) {
			hideMenu(menu);
			unblockBody();
		}
	});
}

function showMenu(menu = null) {
	const { header, body } = getElements();

	if (!menu) {
		menu = getElements().menu;
	}

	menu.style.top = `${header.getBoundingClientRect().bottom}px`;

	menu.classList.add('active');

	body.dispatchEvent(new Event('menu-opened'));
}

/**
 *
 * @param {Element|null} menu
 */
function hideMenu(menu = null) {
	if (!menu) {
		menu = getElements().menu;
	}
	const submenus = menu.querySelectorAll('.submenu');

	menu.classList.remove('active');

	for ( let i = 0; i < submenus.length; i++ ) {
		submenus[i].classList.remove('active');
	}

	getElements().body.dispatchEvent(new Event('menu-closed'));
}

function blockBody() {
	const { body } = getElements();
	body.style.overflow = 'hidden';
}

function unblockBody() {
	const { body } = getElements();
	body.style.overflow = '';
}

function getElements() {
	return {
		menu: document.querySelector('.navbar'),
		button: document.querySelector('.menu-button'),
		header: document.querySelector('.logo-header'),
		body: document.body,
	};
}
