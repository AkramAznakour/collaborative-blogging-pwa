/* eslint-disable no-console */

import {
    register
} from 'register-service-worker'

let CACHE_NAME = 'sw-v1'

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(cache => cache.addAll('../public/index.html'))
    )
})
self.addEventListener('fetch', (event) => {
    if (event.request.method === 'GET') {
        event.respondWith(
            caches.match(event.request)
            .then((cached) => {
                var networked = fetch(event.request)
                    .then((response) => {
                        let cacheCopy = response.clone()
                        caches.open(CACHE_NAME)
                            .then(cache => cache.put(event.request, cacheCopy))
                        return response;
                    })
                    .catch(() => caches.match(offlinePage));
                return cached || networked;
            })
        )
    }
    return;
});


//if (process.env.NODE_ENV === 'production') {
if (true) {
    register(`${process.env.BASE_URL}service-worker.js`, {
        ready() {
            console.log(
                'App is being served from cache by a service worker.\n' +
                'For more details, visit https://goo.gl/AFskqB'
            )
        },
        registered() {
            console.log('Service worker has been registered.')
        },
        cached() {
            console.log('Content has been cached for offline use.')
        },
        updatefound() {
            console.log('New content is downloading.')
        },
        updated() {
            console.log('New content is available; please refresh.')
        },
        offline() {
            console.log('No internet connection found. App is running in offline mode.')
        },
        error(error) {
            console.error('Error during service worker registration:', error)
        }
    })
}
