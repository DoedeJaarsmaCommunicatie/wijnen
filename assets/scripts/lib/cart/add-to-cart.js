import axios from 'axios';

export function addToCart()
{
    scanProducts();
}

function scanProducts()
{
    const { action } = queryStrings(),
        els = document.querySelectorAll(action),
        products = [];

    for ( let i = 0; i < els.length; i++ ) {
        const element = els[i];
        products.push(element);
        element.addEventListener('submit', e => e.preventDefault());
        createAddToCartEvent(element);
    }

    return {
        products,
        els,
    };
}

function createAddToCartEvent(element)
{
    element.addEventListener('submit', async e => {
        const data = new FormData(),
            productID = element.dataset['product'],
            quantity = getQuantity(element);

        if (!productID) {
            throw Error('Product ID not found');
        }

        data.set('product_id', productID);
        data.set('quantity', quantity);

        const res = await axios.post('?wc-ajax=add_to_cart', data);

        if (res.data.fragments) {
            refreshCartTotals(res.data.fragments['cart_contents_count']);
            injectMiniCart(res.data.fragments['div.widget_shopping_cart_content']);

            const cart = document.querySelector('div.widget_shopping_cart_content'),
                close_btn = document.querySelector('.js-close-cart');

            cart.classList.add('active');
            document.body.dispatchEvent(new Event('mini-cart-opened'));

            cart.addEventListener('click', function (e) {
                if (e.target !== this) {
                    return;}

                cart.classList.remove('active');
                document.body.dispatchEvent(new Event('mini-cart-closed'));
            });

            close_btn.addEventListener('click', function (e) {
                cart.classList.remove('active');

                document.body.dispatchEvent(new Event('mini-cart-closed'));
            });
        }
    });
}

function getQuantity(el)
{
    const { quantity } = queryStrings();
    const qty_el = el.querySelector(quantity);

    if (qty_el) {
        return qty_el.value;
    }

    return '1';
}

function refreshCartTotals(count)
{
    const badge = document.querySelector('.js-cart-amount');

    badge.dataset['amount'] = count.toString();
    badge.innerHTML = count.toString();
}

function injectMiniCart(cart)
{
    const el = document.querySelector('div.widget_shopping_cart_content');
    if (!el) {
        return; }

    el.outerHTML = cart;
}

function queryStrings()
{
    return {
        action: '[data-action="add-to-cart"]',
        product: '[data-product]',
        quantity: '[name="quantity"]',
    };
}
