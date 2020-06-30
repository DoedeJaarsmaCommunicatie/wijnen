export function removeAllNotificationsOnBodyClick() {
	document.body.addEventListener('click', function (evt) {
		const { errors, messages } = getElements();

		if (errors.length > 0) {
			if (errors.filter(error => error.contains(evt.target)).length > 0) {
				return;
			}

			errors.map(error => error.parentElement.removeChild(error));
		}


		if (messages.length > 0) {
			if (messages.filter(message => message.contains(evt.target)).length > 0) {
				return;
			}

			messages.map(message => message.parentElement.removeChild(message));
		}
	})
}


function getElements() {
	return {
		errors: Array.from(document.querySelectorAll('.woocommerce-error')),
		messages: Array.from(document.querySelectorAll('.woocommerce-message')),
	}
}
