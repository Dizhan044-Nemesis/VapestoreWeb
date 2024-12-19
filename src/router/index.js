// Import Vue Router
import { createRouter, createWebHistory } from 'vue-router';

// Define routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import(/* webpackChunkName: "home" */ '../views/home.vue'),
  },
  {
    path: '/orders',
    name: 'orders.index',
    component: () => import(/* webpackChunkName: "index" */ '../views/orders/index.vue'),
  },
  {
    path: '/orders/create',
    name: 'orders.create',
    component: () => import(/* webpackChunkName: "create" */ '../views/orders/create.vue'),
  },
  {
    path: '/orders/edit/:id',
    name: 'orders.edit',
    component: () => import(/* webpackChunkName: "edit" */ '../views/orders/edit.vue'),
  },
  {
    path: '/product',
    name: 'product.index',
    component: () => import(/* webpackChunkName: "products-index" */ '../views/products/index.vue'),
  },
  {
    path: '/product/create',
    name: 'product.create',
    component: () => import(/* webpackChunkName: "products-create" */ '../views/products/create.vue'),
  },
  {
    path: '/product/edit/:id',
    name: 'product.edit',
    component: () => import(/* webpackChunkName: "products-edit" */ '../views/products/edit.vue'),
  },
];

// Create router
const router = createRouter({
  history: createWebHistory(),
  routes, // <-- routes
});

export default router;
