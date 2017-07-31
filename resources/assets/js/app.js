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

Vue.component('rating', {
  template: `<div class="ui star rating" :data-rating="value"></div>`,
  props: ['value', 'disabled'],
  watch: {
    value: function (val, oldVal) {
      if (val == null) {
        $(this.$el).rating('clear rating');
      }
    }
  },
  mounted() {
    console.log(this.disabled);
    let t = this;

    if (!t.disabled) {
      $(t.$el).rating({
        fireOnInit: true, 
        onRate(val) {
          t.$emit('input', val);
        }
      });
    }

    if (t.disabled) {
      $(t.$el).rating('disable');
    }

  }
});

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

// Register a global custom directive called v-rating
Vue.directive('accordion', {
  inserted: function (el) {
    $(el).accordion();
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