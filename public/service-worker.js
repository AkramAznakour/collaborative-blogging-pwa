importScripts("/precache-manifest.ea2e8aa5658af45255f750a2fc5cda48.js", "https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");

self.addEventListener('install', event => {
    event.waitUntil(
        caches
        .open('localhost')
        .then(cache =>
            cache.addAll([
                'app.js',
                'service-worker.js',
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

