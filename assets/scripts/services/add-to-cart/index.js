import React, { render } from 'preact';
import { Form } from './lib/Form.jsx';

export function renderAddToCartButtons() {
	const targets = document.querySelectorAll('.pr-add-to-cart');

	for ( let i = 0; i < targets.length; i++ ) {
		const target = targets[i];
		const {
			product,
			qty,
			label,
			secondary,
			outline
		} = target.dataset;
		const icon = qty > 1 ? 'box' : 'wine-bottle'

		render(<Form product={product}
					 icon={icon}
					 label={label}
					 secondary={secondary}
					 outline={outline}
					 amount={qty} />, target);
	}
}
