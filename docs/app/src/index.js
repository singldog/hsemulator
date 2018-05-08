// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import 'muse-ui/dist/muse-ui.css'
import 'muse-ui/dist/theme-carbon.css'

import Vue from 'vue'
import App from './App'
import MuseUI from 'muse-ui'
import VueResouce from 'vue-resource'

Vue.config.productionTip = false;
Vue.use(VueResouce);
Vue.use(MuseUI);

Vue.config.silent = true;
window.Vue = Vue;

/* eslint-disable no-new */
window.app = new Vue({
  el: '#app',
  components: { App },
  template: '<App ref="app"/>'
})
