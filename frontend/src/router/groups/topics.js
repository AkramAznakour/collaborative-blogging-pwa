export default [{
    name: "show-topics",
    path: '/topics',
    component: () => import('@/pages/topic/ShowTopics.vue'),
    meta: {
        auth: false
    },
}, {
    name: "show-topic",
    path: '/show-topic/:id',
    component: () => import('@/pages/topic/ShowTopic.vue'),
    meta: {
        auth: false
    },
}]
