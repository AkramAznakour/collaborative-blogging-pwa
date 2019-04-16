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
