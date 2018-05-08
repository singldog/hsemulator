// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css'
import 'muse-ui/dist/theme-carbon.css'
import './assets/css/custom.css'
import './assets/css/muse-ui-override.css'

Vue.config.productionTip = false;
Vue.use(MuseUI);

/* eslint-disable no-new */
window.app = new Vue({
  el: '#app',
  components: { App },
  template: '<App ref="app"/>'
})
