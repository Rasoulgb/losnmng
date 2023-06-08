importScripts("https://js.pusher.com/beams/service-worker.js");

const beamsTokenProvider = new PusherPushNotifications.TokenProvider({
    url: "YOUR_BEAMS_AUTH_URL_HERE",
  });
  
  beamsClient
    .start()
    .then(() => beamsClient.setUserId("USER_ID_HERE", beamsTokenProvider))
    .catch(console.error);




