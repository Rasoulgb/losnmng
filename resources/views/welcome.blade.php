<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demo Application</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap-notifications.min.css">
  <script src="https://js.pusher.com/beams/service-worker.js"></script>
  <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <script>
    // const beamsClient = new PusherPushNotifications.Client({
    //     instanceId: '546b1fe4-6050-43d0-97f6-c3d10090527c',
    //   });
    
    //   beamsClient.start()
    //     .then(() => beamsClient.addDeviceInterest('hello'))
    //     .then(() => console.log('Successfully registered and subscribed!'))
    //     .catch(console.error);

        const beamsClient = new PusherPushNotifications.Client({
  instanceId: '546b1fe4-6050-43d0-97f6-c3d10090527c',
});
beamsClient
  .start()
  .then((beamsClient) => beamsClient.getDeviceId())
  .then((deviceId) =>
    console.log("Successfully registered with Beams. Device ID:", deviceId)
  )
  .then(() => beamsClient.addDeviceInterest("hello"))
  .then(() => beamsClient.getDeviceInterests())
  .then((interests) => console.log("Current interests:", interests))
  .catch(console.error);


  </script>


</body>

</html>