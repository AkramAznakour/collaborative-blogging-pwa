export default [{
    path: '/article/:id',
    name: "showArticle",
    component: () => import('@/pages/article/ShowArticle.vue'),
    meta: {
        auth: false
    }
}, {
    path: '/CreateArticle',
    name: "CreateArticle",
    component: () => import('@/pages/article/CreateArticle.vue'),
    meta: {
        auth: true
    }
}]
