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
        console.log(response.authResponse.accessToken);
        console.log (response.authResponse.userID);
	    } else {
	    	console.log('fam u aint connected')
	    // The person is not logged into this app or we are unable to tell. 
	    }
	});	

	function fbLogout() {
        FB.logout(function (response) {
            window.location.reload();
        });
    }

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
