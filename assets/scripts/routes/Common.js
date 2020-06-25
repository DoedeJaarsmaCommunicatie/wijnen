import { addToCart } from '../lib/cart/add-to-cart';

export default {
  init() {
    // Javascript that fires on all pages.
    addToCart();
  },

  finalize() {
    // Javascript that fires on all pages. after page specific JS is fires.
  },
};
