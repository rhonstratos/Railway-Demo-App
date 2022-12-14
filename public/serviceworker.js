async function getManifest() {
	return await
		fetch('mix-manifest.json')
			.then((response) => response.json())
			.then((responseJson) => {
				const staticCacheName = "pwa-v" + new Date().getTime();
				const filesToCache = responseJson;
				console.log(filesToCache)
				self.addEventListener("install", event => {
					// console.log("WORKER: install event in progress.");
					this.skipWaiting();
					event.waitUntil(
						caches
							.open(staticCacheName)
							.then(cache => {
								return cache.addAll(filesToCache);
							})
					)
				});

				// Clear cache on activate
				self.addEventListener('activate', event => {
					// console.log("WORKER: activate event in progress.");
					event.waitUntil(
						caches
							.keys()
							.then(cacheNames => {
								return Promise.all(
									cacheNames
										.filter(cacheName => (cacheName.startsWith("pwa-")))
										.filter(cacheName => (cacheName !== staticCacheName))
										.map(cacheName => caches.delete(cacheName))
								);
							})
					);
				});

				// Serve from Cache
				self.addEventListener("fetch", event => {
					// console.log('WORKER: Fetching', event.request);
					event.respondWith(
						caches.match(event.request)
							.then(response => {
								return response || fetch(event.request);
							})
							.catch(() => {
								return caches.match('offline');
							})
					)
				});
			})
}

getManifest()
// const staticCacheName = "pwa-v" + new Date().getTime();
// var filesToCache = getManifest();
// console.log(filesToCache)
// // Cache on install
// self.addEventListener("install", event => {
// 	// console.log("WORKER: install event in progress.");
// 	this.skipWaiting();
// 	event.waitUntil(
// 		caches
// 			.open(staticCacheName)
// 			.then(cache => {
// 				return cache.addAll(filesToCache);
// 			})
// 	)
// });

// // Clear cache on activate
// self.addEventListener('activate', event => {
// 	// console.log("WORKER: activate event in progress.");
// 	event.waitUntil(
// 		caches
// 			.keys()
// 			.then(cacheNames => {
// 				return Promise.all(
// 					cacheNames
// 						.filter(cacheName => (cacheName.startsWith("pwa-")))
// 						.filter(cacheName => (cacheName !== staticCacheName))
// 						.map(cacheName => caches.delete(cacheName))
// 				);
// 			})
// 	);
// });

// // Serve from Cache
// self.addEventListener("fetch", event => {
// 	// console.log('WORKER: Fetching', event.request);
// 	event.respondWith(
// 		caches.match(event.request)
// 			.then(response => {
// 				return response || fetch(event.request);
// 			})
// 			.catch(() => {
// 				return caches.match('offline');
// 			})
// 	)
// });
