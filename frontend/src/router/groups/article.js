export default [{
  path: '/article',
  component: () => import('@/pages/Article.vue'),
  children: [{
    name: 'article',
    path: '',
    component: () => import('@/pages/Article.vue'),
    meta: {
      auth: false
    }
  }]
}]
