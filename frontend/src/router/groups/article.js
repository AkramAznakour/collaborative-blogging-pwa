export default [{
    path: '/article/:id',
    name: "article",
    component: () => import('@/pages/Article.vue'),
    meta: {
        auth: false
    }
}]
