<?php include_once('header.php'); ?>

<script>
  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
     console.log('statusChangeCallback');
     console.log(response);                  // The current login status of the person.

     if (response.status === 'connected') {   // Logged into your webpage and Facebook.
       document.querySelector('[name="fb_id"]').value = response.authResponse.userID;
       document.querySelector('#FB_Login').submit();
       testAPI();
     } else {                                 // Not logged into your webpage or we are unable to tell.

     }
   }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
   FB.getLoginStatus(function(response) {   // See the onlogin handler
     statusChangeCallback(response);
   });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '670465876814497',
      cookie     : true,
      xfbml      : true,
      version    : 'v5.0'
    });

    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));



    function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
     console.log('Welcome!  Fetching your information.... ');
     FB.api('/me', function(response) {
       console.log('Successful login for: ' , response);

     });
   }
</script>


<div class="container-fluid">

    <div class="row login__row">

    <div class="login__overlay"></div>
    <video autoplay muted controls="false" loop id="loginvideo">
      <source src="/public/assets/video/back.mp4" type="video/mp4">
    </video>
      <div class="row login__inner-row">
        <div class="col-sm-12 col-md-7 col-lg-6 login__first-column">
          <div class="nav-only-logo">
            <a target="_self" href="/">
              <img src="/public/assets/images/logo.png" >
            </a>
          
            <h1>Todas las peliculas, todos los cines, todo lo mejor.</h1>
          </div>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-6 login__container">
        <form method="POST" action="/login" class="login-form">
            <label>
                <input class="inputText" type="text" name="username" required>
                <span class="floating-label">Nombre de Usuario</span>
            </label>
            <label>
                <input class="inputText" type="password" name="password" required>
                <span class="floating-label">Contraseña</span>
            </label>
            <div class="login__button--container">
                <button class="login__button glow-on-hover" type="submit">INGRESAR</button>
            </div>
        </form>
        <form id="FB_Login" method="POST" action="/loginFB" class="login-form">

            <div class="login__button--container fb-login-container">
                <fb:login-button
                  scope="public_profile,email"
                  onlogin="checkLoginState();"
                  data-use-continue-as="true"
                  data-size="large">
                </fb:login-button>
            </div>
            <input type="hidden" name="fb_id" value="">
        </form>
        <div class="login__create--container">
            <p>No tienes usuario? <a href="/login/create">REGISTRATE</a></p>
        </div>
        </div>
    </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
