export function otherwiseLoadJQuery() {
	if (document.querySelector('#updated-jquery')) { return; }
	const element = document.createElement('script');

	element.setAttribute('src', 'https://code.jquery.com/jquery-3.5.1.min.js');
	element.setAttribute('id', 'updated-jquery');
	document.body.append(element);
}
