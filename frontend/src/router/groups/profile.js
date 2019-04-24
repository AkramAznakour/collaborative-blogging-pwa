export default [{
        path: '/profile/:id',
        name: 'profile',
        component: () => import('@/pages/profile/Profile.vue'),
        meta: {
            auth: true
        },
    },
    {
        path: "/account-settings",
        name: "account-settings",
        component: () => import('@/pages/profile/Settings.vue'),
        meta: {
            auth: true
        },
    },
    {
        path: '/search/:name',
        name: 'search',
        component: () => import('@/pages/profile/Search.vue'),
        meta: {
            auth: false
        },
    },

]
