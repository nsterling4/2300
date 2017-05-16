  window.fbAsyncInit = function() {
    FB.init({
      appId      : '422193654803673',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {
      console.log(response);
      if (response.status === 'connected') {
        // Logged into your app and Facebook.
        console.log('you been connected')
        var token = response.authResponse.accessToken;
        console.log(token);
        console.log (response.authResponse.userID);
        FB.api('/me','GET', {"fields":"name"},function(response) {
          var name = {'name':response.name};
          console.log(name);
           $.ajax({
              url: 'includes/dummy.php',
              type: 'post',
              data: name
          })
          .done(function(response){
            console.log('done')
          })
        }
        );
      } else {
        console.log('fam u aint connected')
        var blank = {'blank':'nope'};
        $.ajax({
              url: 'includes/dummy.php',
              type: 'post',
              data: blank
          })
          .done(function(response){
            console.log('executed')
          })
          .fail(function(response){
            console.log('fail')
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
