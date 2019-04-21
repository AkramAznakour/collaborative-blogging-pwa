import {
    vp
} from '@/tools/helpers'

let actions = {

    async addPost({
        dispatch,
        commit
    }, form) {

        const {
            message,
            user
        } = await vp.$post('posts', form)

        vp.$notify.success(message)
    },


};

export default {
    namespaced: true,
    state: {},
    mutations: {},
    actions: actions
}
