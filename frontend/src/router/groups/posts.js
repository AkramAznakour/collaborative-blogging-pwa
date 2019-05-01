export default [{
        name: "create-post",
        path: '/create-post',
        component: () => import('@/pages/post/CreatePost.vue'),
        meta: {
            auth: true
        },
    }, {
        name: "show-post",
        path: '/show-post/:id',
        component: () => import('@/pages/post/ShowPost.vue'),
        meta: {
            auth: false
        },
}];
