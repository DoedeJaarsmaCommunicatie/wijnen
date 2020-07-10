import { filterOpener } from '../lib/navigation/filterOpener';
import { navOpener } from '../lib/navigation/opener';
import { renderSearchForm } from '../services/search-form';
import { removeAllNotificationsOnBodyClick } from '../lib/WooCommerce/notifications'
import { renderAddToCartButtons } from '../services/add-to-cart'
import { renderMiniCartEventListener } from '../lib/cart/mini-cart-opener'
import { renderShoppingCartButton } from '../services/cart/CartButton'

export default {
  init() {
    navOpener();
    removeAllNotificationsOnBodyClick();
    renderMiniCartEventListener();
    renderAddToCartButtons();
  },

  finalize() {
    filterOpener();
    openShortList();
    openMobileSubmenu();
    renderSearchForm();
    renderShoppingCartButton();
  },
};

const openShortList = () => {
  const lists = document.querySelectorAll('.shortened-list');
  if (!lists || lists.length === 0) {
    return;
  }

  for ( let i = 0; i < lists.length; i++ ) {
    lists[i].addEventListener('click', () => lists[i].classList.toggle('active'));
  }
};



const openMobileSubmenu = () => {
  if (window.innerWidth > 767) {
    return;
  }

  const openers = document.querySelectorAll('.menu-w-submenu');
  if (!openers) {
    return;
  }

  for ( let i = 0; i < openers.length; i++ ) {
    const button = openers[i];

    button.addEventListener('click', (ev) => {
      if (button.parentElement.classList.contains('clicked')) {
        return;
      }
      ev.preventDefault();
      button.parentElement.classList.add('clicked');

      const target = ev.target;
      const submenu = target.closest('.menu-item-submenu')?.querySelector('.submenu');

      if (submenu) {
        submenu.classList.toggle('active');
      }
    });
  }
};
