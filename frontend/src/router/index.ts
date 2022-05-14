import { createRouter, createWebHistory } from "vue-router";

const main = () => import('../pages/main.vue')
const board = () => import('../components/board.vue')

const routes = [
    {
        path: '/',
        name: 'main',
        component: main,
    },
    {
        path: '/board/:id',
        name: 'board',
        component: board,
    },
]

const router = createRouter({
    routes,
    history: createWebHistory(),
    linkExactActiveClass: "active" // active class for *exact* links.
})

export default router;