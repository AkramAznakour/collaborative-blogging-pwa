export default [{
    path: '',
    name: "home",
    component: () => import('@/pages/home/Home.vue'),
    meta: {
        auth: false
    }
}]
