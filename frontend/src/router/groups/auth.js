export default [{
        name: 'signup',
        path: '/signup',
        component: () => import('@/pages/auth/Signup.vue'),
        meta: {
            guest: true
        }
    },
    {
        name: 'signin',
        path: '/signin',
        component: () => import('@/pages/auth/Signin.vue'),
        meta: {
            guest: true
        }
    },
    {
        name: 'forgot-password',
        path: '/forgot-password',
        component: () => import('@/pages/auth/ForgotPassword.vue'),
        meta: {
            guest: true
        }
    },
    {
        name: 'reset-password',
        path: '/reset-password/:token/:email',
        component: () => import('@/pages/auth/ResetPassword.vue'),
        meta: {
            guest: true
        }
    },
    {
        name: 'verify-email',
        path: '/verify-email',
        component: () => import('@/pages/auth/VerifyEmail.vue')
        // meta: { guest: true }
    }
]
