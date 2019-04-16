import MainLayout from '@/layouts/Main.vue'

import auth from './groups/auth'
import home from './groups/home';
import profile from './groups/profile'
import posts from './groups/posts'
import others from './groups/others';

export default [{
    path: '/',
    component: MainLayout,
    children: [
        ...auth,
        ...home,
        ...profile,
        ...posts,
        ...others,
    ]
}]
