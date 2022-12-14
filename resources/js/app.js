import './bootstrap';

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

// BFCACHE, disabled for PWA installable purposes
// window.addEventListener('pageshow', (event) => {

//     if (event.persisted && !document.cookie.match('XSRF-TOKEN')) {
//         // Force a reload if the user has logged out.
//         location.reload();
//     }
//     if (event.persisted) {
//         console.log('This page was restored from the bfcache.');
//     } else {
//         console.log('This page was loaded normally.');
//     }
// });
// window.addEventListener('pagehide', (event) => {
//     if (event.persisted) {
//         console.log('This page *might* be entering the bfcache.');
//     } else {
//         console.log('This page will unload normally and be discarded.');
//     }
// });

// function beforeUnloadListener(event) {
//     event.preventDefault();
//     return event.returnValue = 'Are you sure you want to exit?';
// };

// // A function that invokes a callback when the page has unsaved changes.
// onPageHasUnsavedChanges(() => {
//     window.addEventListener('beforeunload', beforeUnloadListener);
// });

// // A function that invokes a callback when the page's unsaved changes are resolved.
// onAllChangesSaved(() => {
//     window.removeEventListener('beforeunload', beforeUnloadListener);
// });
console.log('All scripts loaded!')
