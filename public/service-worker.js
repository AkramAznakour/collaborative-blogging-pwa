importScripts("/precache-manifest.42a9fd45aae1794c0a5b567746762bb9.js", "https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");

const cacheName = "collab"

self.addEventListener('install', event => {
    event.waitUntil(
        caches
        .open(cacheName)
        .then(cache =>
            cache.addAll([
                'app.js',
                'service-worker.js',
                '*.js',
                'img/*.*'
            ])
        )
    )
})

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            if (response) {
                //we found an entry in the cache!
                return response
            }
            return fetch(event.request)
        })
    )
})

