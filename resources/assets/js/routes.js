import VueRouter from 'vue-router';

import example from './components/Example.vue';

let routes = [
  {
    path: '/',
    name: 'example',
    component: example,
    props: true
  }
];

export default new VueRouter({
  mode: 'history',
  routes: routes
});

// Important To-DO
// https://forum.vuejs.org/t/pass-props-for-different-components-via-one-router-view/1489/2