import React, { render, h } from 'preact';
import { FavoritesCounter } from './lib/app';

export function renderFavoritesButton() {
	const target = document.querySelector('.pre-favorites-total');

	if (!target) {
		return;
	}

	render(<FavoritesCounter />, target);
}
