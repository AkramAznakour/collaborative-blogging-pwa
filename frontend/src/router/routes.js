import DefaultLayout from '@/layouts/Default.vue'

import auth from './groups/auth'
import home from './groups/home';
import profile from './groups/profile'
import posts from './groups/posts'
import topics from './groups/topics'
import others from './groups/others';

export default [{
    path: '/',
    component: DefaultLayout,
    children: [
        ...auth,
        ...home,
        ...profile,
        ...posts,
        ...topics,
        ...others,
    ]
}]
