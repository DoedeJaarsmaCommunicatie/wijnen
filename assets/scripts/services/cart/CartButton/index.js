import React, { render, h } from 'preact';
import { CartButton } from './lib/App'

export function renderShoppingCartButton() {
	const target = document.querySelector('.pr-shopping-cart-button');

	if (!target) {return;}
	const { initialCount } = target.dataset;

	render(<CartButton initialCount={initialCount} />, target);
}
