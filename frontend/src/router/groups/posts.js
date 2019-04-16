export default [{
    path: '/post/:id',
    name: "showPost",
    component: () => import('@/pages/post/ShowPost.vue'),
    meta: {
        auth: false
    },
}, {
    path: '/post/:id/edit',
    name: "editPost",
    component: () => import('@/pages/post/EditPost.vue'),
    meta: {
        auth: true
    }
}, {
    path: '/createPost',
    name: "createPost",
    component: () => import('@/pages/post/CreatePost.vue'),
    meta: {
        auth: true
    }
}]
