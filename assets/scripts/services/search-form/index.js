import React, { render, h } from 'preact';
import { App } from './lib/App';

export function renderSearchForm() {
	const target = document.querySelector('.js-search-form');

	if (!target) {
		return;
	}

	render(<App />, target);
}
