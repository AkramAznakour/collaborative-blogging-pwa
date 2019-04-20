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
        component: () => import('@/pages/profile/AccountSettings/AccountSettings.vue'),
        meta: {
            auth: true
        },
    },

]
