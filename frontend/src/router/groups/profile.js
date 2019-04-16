export default [{
        name: 'profile',
        path: '/profile',
        component: () => import('@/pages/profile/Profile.vue'),
        meta: {
            auth: true
        },
    },
    {
        path: "/profile/Account_Settings",
        children: [{
            name: "Account_Settings",
            path: '',
            component: () => import('@/pages/profile/AccountSettings/ChangePassword.vue'),
        }, {
            name: 'profile-change-password',
            path: '/change-password',
            component: () => import('@/pages/profile/AccountSettings/ChangePassword.vue'),
        }]

    }
]
