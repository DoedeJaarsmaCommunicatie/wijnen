import { events, fireEvent, listenEvent } from '../../tools/EventBus'

export function renderMiniCartEventListener()
{
    listenEvent(events.PRODUCT.ADDED_TO_CART, renderMiniCart);
    listenEvent(events.MINI_CART.OPENED, registerMiniCartCloseListener, true);
}

/**
 * @param {CustomEvent} e
 */
export function renderMiniCart(e)
{
    const wrapper = document.querySelector('.widget_shopping_cart_content');
    wrapper.innerHTML = e.detail.response.mini_cart;
    wrapper.classList.add('active');

    fireEvent(events.MINI_CART.OPENED, { wrapper });
}

export function registerMiniCartCloseListener({ detail })
{
    detail.wrapper.addEventListener('click', closeMenuEvent);
    detail.wrapper.querySelector('.js-close-cart')
        ?.addEventListener('click', closeMenuEvent);
}

export function closeMenuEvent(e)
{
    const wrapper = document.querySelector('.widget_shopping_cart_content'),
        closeBtn = wrapper.querySelector('.js-close-cart');

    if ([wrapper, closeBtn].includes(e.target)) {
        wrapper.classList.remove('active');
        fireEvent(events.MINI_CART.CLOSED);
    }
}
