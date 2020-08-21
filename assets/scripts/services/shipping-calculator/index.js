import React, { render, h } from 'preact';
import { ShippingDateCalculator } from '@elderbraum/wine-components';

export function renderShippingDate() {
	const target = document.querySelectorAll('.pre-shipping-date-calc');

	if (target.length === 0) {
		return;
	}

	target.forEach(el => {
		const { days } = el.dataset;
		render(<ShippingDateCalculator shippingDays={days? Number(days) : 0} />, el);
	})
}
