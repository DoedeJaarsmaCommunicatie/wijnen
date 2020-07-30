if (process.env.NODE_ENV === 'development') {
    require('preact/debug');
}

import './bootstrap';
import Ready from './tools/Ready';
import Router from './tools/Router';

// Import routes
const common = async () =>
    (await import(/* webpackChunkName: "dist/scripts/routes/common" */'./routes/Common')).default;
const home = async () =>
    (await import(/* webpackChunkName: "dist/scripts/routes/home" */ './routes/Home')).default;
const product = async () =>
    (await import(/* webpackChunkName: "dist/scripts/routes/product" */ './routes/Product')).default;


const routes = new Router({
    common,
    home,
    singleProduct: product
});

Ready(() => routes.loadEvents());
