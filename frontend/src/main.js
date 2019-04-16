import Vue from 'vue'
import App from '@/App.vue'
import router from '@/router'
import store from '@/store'

import mavonEditor from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'


import "highlight.js/styles/default.css";
import Highlight from "vue-markdown-highlight";
Vue.use(Highlight);

Vue.use(mavonEditor)

// style
import 'jquery'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

// Plugins
import './plugins/vue-plugin-axios'
import './plugins/notifications'
import './plugins/validator'
import './registerServiceWorker'

Vue.config.productionTip = false

Vue.prototype.$auth = {
    get user() {
        return store.state.auth.user
    },
    get loggedIn() {
        return store.getters['auth/loggedIn']
    }
}

// It makes it easy to launch an action in a component that is bound to the loading
Vue.prototype.$actionWithLoading = async function (action, loadingVariable = 'loading', ...arg) {
    this[loadingVariable] = true
    try {
        await action(...arg)
    } catch (e) {
        throw e // so that the error can be caught above
    } finally {
        this[loadingVariable] = false
    }
}

// export async function actionWithLoading (action, loadingVariable, ...arg) {
//   loadingVariable = true
//   try {
//     await action(arg)
//   } finally {
//     loadingVariable = false
//   }
// }

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')

// init auth module
store.dispatch('auth/init')
