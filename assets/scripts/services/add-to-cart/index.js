import React, { render, h } from 'preact';
import { AddToCartIconButton, PlusMinusForm } from '@elderbraum/wine-components';
import { ThemeProvider, withTheme } from 'styled-components'

const StyledAddToCartIconButton = withTheme(AddToCartIconButton.IconButtonForm);
const StyledPlusMinusForm = withTheme(PlusMinusForm.PlusMinus);

export function renderAddToCartButtons() {
	const targets = document.querySelectorAll('.pr-add-to-cart');

	for ( let i = 0; i < targets.length; i++ ) {
		const target = targets[i];
		const {
			product,
			qty,
			label,
			outline
		} = target.dataset;

		render(<ThemeProvider theme={{
			outlined: !!outline,
			background: '#c96464',
			color: '#fff',
			borderColor: '#c96464',
		}}>
			<StyledAddToCartIconButton product={Number(product)}
				  label={label}
				  qty={Number(qty)} />
		</ThemeProvider>, target);
	}
}

export function renderLargeAddToCart()  {
	const targets = document.querySelectorAll('.pr-add-to-cart-large');

	for ( let i = 0; i < targets.length; i++ ) {
		const target = targets[i];
		const {
			product,
			qty,
			label,
			outline
		} = target.dataset;

		render(<ThemeProvider theme={{
			outlined: !!outline,
			background: '#c96464',
			color: '#fff',
			borderColor: '#c96464'
		}}>
			<StyledPlusMinusForm product={Number(product)} amount={Number(qty)} />
		</ThemeProvider>, target);
	}
}
