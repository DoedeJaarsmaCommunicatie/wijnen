import { events, fireEvent, listenEvent } from '../../tools/EventBus'

export function renderMiniCartEventListener()
{
    listenEvent(events.PRODUCT.ADDED_TO_CART, renderMiniCart);
}

/**
 * @param {CustomEvent} e
 */
export function renderMiniCart(e)
{
    const wrapper = document.querySelector('.widget_shopping_cart_content');
    wrapper.innerHTML = e.detail.response.mini_cart;
    wrapper.classList.add('active');

    listenEvent(events.MINI_CART.OPENED, registerMiniCartCloseListener, true);
    fireEvent(events.MINI_CART.OPENED, { wrapper });
}

export function registerMiniCartCloseListener({ detail })
{
    detail.wrapper.addEventListener('click', closeMenuEvent);
}

export function closeMenuEvent(e)
{
    const wrapper = document.querySelector('.widget_shopping_cart_content');
    if (e.target === wrapper) {
        wrapper.classList.remove('active');
        fireEvent(events.MINI_CART.CLOSED);
    }
}
