export default [{
        path: '/profile',
        meta: {
            auth: true
        },
        children: [{
                name: 'profile',
                path: '/',
                component: () => import('@/pages/profile/currentUser/pages/MainInfo.vue'),
            },
            {
                name: 'profile-change-password',
                path: '/change-password',
                component: () => import('@/pages/profile/currentUser/pages/ChangePassword.vue'),

            }
        ]
    },
    {
        name: 'author',
        path: 'author/:id',
        component: () => import('@/pages/profile/author/Author.vue'),
    },
]
