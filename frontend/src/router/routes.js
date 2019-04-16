import MainLayout from '@/layouts/Main.vue'
import Home from '@/pages/Home.vue'

import auth from './groups/auth'
import profile from './groups/profile'
import article from './groups/article'
import others from './groups/others';

export default [{
    path: '/',
    component: MainLayout,
    children: [{
            name: 'home',
            path: '',
            component: Home
        },
        ...auth,
        ...profile,
        ...article,
        ...others
    ]
}]
