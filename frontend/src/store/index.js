import Vue from 'vue'
import Vuex from 'vuex'
import createMutationsSharer from 'vuex-shared-mutations'
import {
    vp
} from '@/tools/helpers'
import authModule from './modules/auth/'
import currentUserProfile from './modules/profile/currentUser'
import postsModule from './modules/posts/'

Vue.use(Vuex);

export default new Vuex.Store({
    plugins: [
        createMutationsSharer({
            predicate: [
                'auth/USER', 'auth/TOKEN', 'auth/REFRESH_TOKEN_EXPIRED', 'auth/USER_LOGGED_IN', 'auth/USER_LOGGED_OUT'
            ]
        })
    ],
    modules: {
        auth: authModule,
        profile: currentUserProfile,
        posts: postsModule,
    },
    state: {

    },
    mutations: {

    },
    actions: {

    }
})
