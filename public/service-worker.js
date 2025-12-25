/* eslint-disable no-restricted-globals */
const CACHE_VERSION = 'ablelink-v1';
const OFFLINE_URL = '/offline.html';

// Only cache public, non-sensitive routes here.
const PRECACHE_URLS = [
  '/',
  '/upload',
  '/aid-directory',
  '/manifest.webmanifest',
  '/favicon.ico',
  '/icons/icon.svg',
  OFFLINE_URL,
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_VERSION).then((cache) => cache.addAll(PRECACHE_URLS)).then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(keys.map((key) => (key === CACHE_VERSION ? Promise.resolve() : caches.delete(key))))
    ).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  const req = event.request;
  if (req.method !== 'GET') return;

  const url = new URL(req.url);

  // Do not cache admin pages (sensitive) or cross-origin requests.
  if (url.origin !== self.location.origin) return;
  if (url.pathname.startsWith('/admin')) {
    event.respondWith(fetch(req));
    return;
  }

  // Navigations: network-first, then offline fallback.
  if (req.mode === 'navigate') {
    event.respondWith(
      fetch(req)
        .then((res) => {
          const copy = res.clone();
          caches.open(CACHE_VERSION).then((cache) => cache.put(req, copy));
          return res;
        })
        .catch(() => caches.match(req).then((cached) => cached || caches.match(OFFLINE_URL)))
    );
    return;
  }

  // Static assets: stale-while-revalidate.
  event.respondWith(
    caches.match(req).then((cached) => {
      const fetchPromise = fetch(req)
        .then((res) => {
          const copy = res.clone();
          caches.open(CACHE_VERSION).then((cache) => cache.put(req, copy));
          return res;
        })
        .catch(() => cached);
      return cached || fetchPromise;
    })
  );
});

