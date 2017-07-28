require('./vendor');
require('./app/semantic-ui-tablesort');
require('./app/custom');

// Making NProgress available globally.
window.NProgress = require('nprogress');
NProgress.configure({ showSpinner: false, trickleSpeed: 1000, easing: 'ease', speed: 500, minimum: 0.3 });

// Vue Router - https://github.com/vuejs/vue-router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Vue Sweet alert - https://github.com/lishengzxc/vue-sweetalert
import VueSweetAlert from 'vue-sweetalert';
Vue.use(VueSweetAlert);

// Toast Notification - https://github.com/shakee93/vue-toasted
import Toasted from 'vue-toasted';
Vue.use(Toasted, {position: 'bottom-right', duration: 3000});

// Register a global custom directive called v-tablesort
Vue.directive('tablesort', {
  inserted: function (el) {
    $(el).tablesort();
  }
});

// Register a global custom directive called v-dropdown
Vue.directive('dropdown', {
  inserted: function (el) {
    $(el).dropdown();
  }
});

import router from './routes';

// Load the component where id = 'app'
window.onload = () => {
  if (document.getElementById("app")) {
  	var app = new Vue({
  	    el: '#app',
        router
  	});
  }
}