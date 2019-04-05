export default [{
  name: 'about',
  path: '/about',
  component: () => import(/* webpackChunkName: "about" */ '@/pages/About.vue')
}, {
  name: 'article',
  path: '/article',
  component: () => import(/* webpackChunkName: "about" */ '@/pages/Article.vue')
}]
