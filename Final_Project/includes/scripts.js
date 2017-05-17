  window.fbAsyncInit = function() {
    FB.init({
      appId      : '422193654803673',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        // Logged into your app and Facebook.
        console.log("this is refreshing");
        var blank = {'blank':'nope'};
        $.ajax({
              url: 'includes/connect_dummy.php',
              type: 'post',
              data: blank
          })
          .done(function(data){
            console.log(data);
            if(data==1){
              console.log("reloading");
              window.location.reload();
            }
          })
      } else {
        console.log('fam u aint connected')
        var blank = {'blank':'nope'};
        $.ajax({
              url: 'includes/disconnect_dummy.php',
              type: 'post',
              data: blank
          })
          .done(function(data){
            console.log(data);
            if(data==1){
              console.log("reloading");
              window.location.reload();
            }
          })
      // The person is not logged into this app or we are unable to tell. 
      }
  }); 

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
