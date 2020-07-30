import { tns as TinySlider } from 'tiny-slider/src/tiny-slider';

export default function() {
	const target = '.product-usp-carousel';

	window['product-usp-slider'] = TinySlider({
		container: target,
		items: 1,
		autoplay: true,
		nav: false,
		controls: false,
		autoplayTimeout: 3000,
		autoplayButtonOutput: false,
		loop: true,
	});
}
