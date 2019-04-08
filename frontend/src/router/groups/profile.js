export default [{
  path: '/profile',
  meta: {
    auth: true
  },
  component: () => import('@/pages/profile/currentUser/Profile.vue'),
  children: [{
      name: 'profile',
      path: '',
      component: () => import('@/pages/profile/currentUser/pages/MainInfo.vue'),

    },
    {
      name: 'profile-change-password',
      path: '/change-password',
      component: () => import('@/pages/profile/currentUser/pages/ChangePassword.vue'),

    }
  ]
}]
