if('serviceWorker' in navigator){
    navigator.serviceWorker.register("sw.js");
    console.log('Service worker: Registered');
}