export function fireEvent(
	name,
	detail = null,
) {
	document.body.dispatchEvent(new CustomEvent(name, { detail }))
}

/**
 *
 * @param {string} name
 * @param {Function|EventListener|EventListenerObject} listener
 * @param once
 */
export function listenEvent(name, listener, once = false) {
	document.body.addEventListener(name, listener, { once });
}

export const events = {
	MINI_CART: {
		OPENED: 'mini-cart-opened',
		CLOSED: 'mini-cart-closed',
	},
	PRODUCT: {
		ADDED_TO_CART: 'product-added-to-cart',
		NOT_ADDED_TO_CART: 'product-not-added-to-cart'
	},
	FAVORITES: {
		UPDATED_SINGLE: 'favorites-updated-single',
		ADDED_SINGLE: 'favorites-added-single',
		REMOVED_SINGLE: 'favorites-removed-single',
		LOADED: 'favorites-user-loaded',
	}
}
