import { tns as TinySlider } from 'tiny-slider/src/tiny-slider';

export default function() {
	const target = '.header-usps';

	window['top-bar-slider'] = TinySlider({
		container: target,
		items: 1,
		autoplay: true,
		nav: false,
		controls: false,
		autoplayTimeout: 5000,
		autoplayButtonOutput: false,
		loop: true,
		mode: 'gallery'
	});
}
