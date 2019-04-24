import {
    vp
} from '@/tools/helpers'
// import { } from './mutation-types'

let actions = {

    async setPassword({
        dispatch,
        commit
    }, form) {
        const {
            message,
            user
        } = await vp.$post('profile/current/set-password', form)

        dispatch('auth/setUser', user, {
            root: true
        });

        vp.$notify.success(message)
    },

    async setUserData({
        dispatch,
        commit
    }, form) {
        console.log("form in setAvatar :", form);

        const {
            message,
            user
        } = await vp.$post('profile/current/set-user-data', form)

        dispatch('auth/setUser', user, {
            root: true
        });

        vp.$notify.success(message)
    },


    async setAvatar({
        dispatch,
        commit
    }, form) {

        const {
            message,
            user
        } = await vp.$post('profile/current/set-avatar', form);

        dispatch('auth/setUser', user, {
            root: true
        });

        vp.$notify.success(message)
    },
};

export default {
    namespaced: true,
    state: {},
    mutations: {},
    actions: actions
}
