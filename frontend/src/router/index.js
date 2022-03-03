import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import NovoUsuarioView from '../views/NovoUsuarioView.vue'
import EditeUsuarioView from '../views/EditeUsuarioView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/novo',
    name: 'novoUsuario',
    component: NovoUsuarioView
  },
  {
    path: '/edit/:id',
    name: 'editUsuario',
    component: EditeUsuarioView,
    props: true,
  },
  //{
  //  path: '/about',
  //  name: 'about',
  //  // route level code-splitting
  //  // this generates a separate chunk (about.[hash].js) for this route
  //  // which is lazy-loaded when the route is visited.
  //  component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  //}
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
