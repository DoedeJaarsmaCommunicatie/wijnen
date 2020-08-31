import { ProductUspSlider } from '../lib/Sliders'
import { Linker } from '../lib/WooCommerce';
import { renderShippingDate } from '../services/shipping-calculator'
import { renderLargeAddToCart } from '../services/add-to-cart';

export default {
	init() {
		new Linker('streek').init();
		new Linker('domein', 'producent').init();
		new Linker('druif' ).init();
		new Linker('regio', 'streek').init();
	},

	finalize() {
		ProductUspSlider();
		renderShippingDate();
		renderLargeAddToCart();
	}
}

