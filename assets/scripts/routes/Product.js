import { ProductUspSlider } from '../lib/Sliders'
import { Linker } from '../lib/WooCommerce';

export default {
	init() {
		new Linker('streek').init();
		new Linker('domein', 'producent').init();
		new Linker('druif' ).init();
		new Linker('regio', 'streek').init();
	},

	finalize() {
		ProductUspSlider();
	}
}

