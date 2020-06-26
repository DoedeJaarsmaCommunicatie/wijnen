import { addToCart } from '../lib/cart/add-to-cart';
import { filterOpener } from '../lib/navigation/filterOpener';
import { navOpener } from '../lib/navigation/opener';
import { renderSearchForm } from '../services/search-form';

export default {
  init() {
    // Javascript that fires on all pages.
    addToCart();
    navOpener();
    filterOpener();
    renderSearchForm();
  },

  finalize() {
    // Javascript that fires on all pages. after page specific JS is fires.
    openShortList();
    openMobileSubmenu();
    focusSearchFix();
  },
};

const openShortList = () => {
  const lists = document.querySelectorAll('.shortened-list');
  if (!lists || lists.length === 0) {
    return;
  }

  for ( let i = 0; i < lists.length; i++ ) {
    lists[i].addEventListener('click', () => lists[i].classList.add('active'));
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

const focusSearchFix = () => {
  const form = document.querySelector('.js-search-form');
  if (!form) {
    return;
  }

  form.addEventListener('click', () => {
    form.querySelector('#s')?.focus();
  });
};
