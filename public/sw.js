self.addEventListener('push',(e)=> {
   
         e.waitUntil(self.registration.showNotification(e.data.text()));
         
     }); 