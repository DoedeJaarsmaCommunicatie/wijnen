export class Linker {
	/**
	 * @type {NodeListOf<HTMLElement>}
	 */
	elements;

	/**
	 *
	 * @param {string} selector
	 * @param {?string} slug
	 */
	constructor(selector, slug = null) {
		this.selector = selector;
		this.slug = slug? slug : selector;
	}

	init() {
		this.setElements();

		if (!this.elementsExist()) {
			if (process.env.NODE_ENV !== 'production') {
				throw new Error(`${this.slug.toUpperCase()} niet gevonden.`);
			}
			// Silently fail for google errors
			return;
		}

		// noinspection JSIgnoredPromiseFromCall
		this.loop();

		return this;
	}

	setElements() {
		this.elements = document.querySelectorAll(`[data-attribute=${this.selector}]`);
	}

	elementsExist() {
		if (!this.elements) {
			return false;
		}

		return this.elements.length >= 1;
	}

	async loop() {
		for (let element in this.elements) {
			if (this.elements.hasOwnProperty(element)) {
				/** @var {HTMLElement} el */
				const el = this.elements[element];

				let res;
				try {
					res = await fetch(`/wp-json/wp/v2/${this.slug}?slug=${el.dataset.value}`)
				} catch { return; }
				const body = await res.json();

				const hasComma = el.innerHTML.endsWith(', ');
				try {
					el.innerHTML = `<a href="${body[0].link}">${body[0].title.rendered}</a>${hasComma? ', ' : ''}`;
				} catch { return; }
			}
		}
	}
}
