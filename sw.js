const cacheName = "v1";

const cacheAssets = [
    '/offline.html',
    '/style/offline.css',
    '/style/global.css',
    '/style/fa/all.css',
    '/script/main.js',
    '/script/login.js',
    '/script/jquery.min.js',
    '/style/webfonts/fa-solid-900.woff2',
    '/style/webfonts/fa-solid-900.woff',
    '/style/webfonts/fa-solid-900.eot',
    '/style/webfonts/fa-solid-900.svg',
    '/style/webfonts/fa-solid-900.ttf',
    '/style/webfonts/fa-brands-400.woff2',
    '/style/webfonts/fa-brands-400.woff',
    '/style/webfonts/fa-brands-400.eot',
    '/style/webfonts/fa-brands-400.svg',
    '/style/webfonts/fa-brands-400.ttf',
    '/style/webfonts/fa-regular-400.woff2',
    '/style/webfonts/fa-regular-400.woff',
    '/style/webfonts/fa-regular-400.eot',
    '/style/webfonts/fa-regular-400.svg',
    '/style/webfonts/fa-regular-400.ttf'
];
const alwaysLoadFromCache = [
    '/offline.html',
    '/style/offline.css',
    '/style/fa/all.css',
    '/script/jquery.min.js',
    '/style/webfonts/fa-solid-900.woff2',
    '/style/webfonts/fa-solid-900.woff',
    '/style/webfonts/fa-solid-900.eot',
    '/style/webfonts/fa-solid-900.svg',
    '/style/webfonts/fa-solid-900.ttf',
    '/style/webfonts/fa-brands-400.woff2',
    '/style/webfonts/fa-brands-400.woff',
    '/style/webfonts/fa-brands-400.eot',
    '/style/webfonts/fa-brands-400.svg',
    '/style/webfonts/fa-brands-400.ttf',
    '/style/webfonts/fa-regular-400.woff2',
    '/style/webfonts/fa-regular-400.woff',
    '/style/webfonts/fa-regular-400.eot',
    '/style/webfonts/fa-regular-400.svg',
    '/style/webfonts/fa-regular-400.ttf'
]

// Install Service Worker:
self.addEventListener('install', e => {
    console.log(`Service Worker: Installed: `);

    e.waitUntil(
        caches
            .open(cacheName)
            .then(cache => {
                console.log("Service Worker: Caching Files");
                cache.addAll(cacheAssets);
            })
            .then(() => self.skipWaiting())
            .catch(err => {
                console.log({err});
            })
    );
});
// Activate Service Worker:
self.addEventListener('activate', e => {
    console.log("Service Worker: Activated");
    // Remove old Cache
    e.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if(cache !== cacheName){
                        console.log("Service Worker: Deleting Old Cache");
                        return caches.delete(cache);
                    }
                })
            )
        })
    );
});

// On Fetch
self.addEventListener('fetch', e => {
    var urlstr = e.request.url;
    var loadFromCache = false;
    loadFromCache = alwaysLoadFromCache.some(str => {
        if(urlstr.includes(str)){
            return true;
        }
    });

    if(loadFromCache){
        console.log("Using Cache");
        e.respondWith(
            caches.match(e.request)
        );
    }
    else {
        if(navigator.onLine !== true){
            e.respondWith(caches.match("offline.html"));
        }
        console.log("Using Fetch Request");
        e.respondWith(
            fetch(e.request).catch(() => caches.match(e.request))
        );
    }
});