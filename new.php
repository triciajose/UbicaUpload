<!doctype html> 
<html>
<head>
  <meta charset="utf-8" />
      <title>Ubica One-Way Dropbox</title>
      <link rel="stylesheet" type="css" href="upload.css">
      <link rel="stylesheet" type="css" href="foundation-5.2.1/css/foundation.css">
      <link rel="stylesheet" type="css" href="foundation-5.2.1/css/normalize.css">
</head>
<body>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="upload.js"></script>
  <script src="foundation-5.2.1/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.1/js/foundation.min.js"></script>
  <script src="foundation-5.2.1/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.1/js/foundation/foundation.reveal.js"></script>

    <script>
      $(document).foundation();

    </script>
     <div class="topbar">
     <br/>
    <img src="newlogo.gif" />
    </div>
    
   
        <br/>
    <br />
    <br />
    <br />
    <h2> Register </h2>
    <div class="row">
    <div data-alert id="error"class="alert-box warning" style="display:none">
      Either your email or password is incorrect 
    </div>
      <div id="login">
        <!-- <h3> Register </h3> -->
        <form action="register.php" method="post" enctype="multipart/form-data">
          <br/>
          <div class="row">
                <input type="text" name="username" placeholder="Email address" />
          </div>
          <div class="row">
                <input type="password" name="password" placeholder="Passkey" />
          </div>
          <div class="row">
            <input type="submit" class="choose" name="register" value="Sign up!">
          </div>
        </form>
        
      </div>

    </div>

    <div id="create_user" class="reveal-modal" data-reveal>
      <h2>Awesome. I have it.</h2>
      <p class="lead">Your couch.  It is mine.</p>
      <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p>
      <a class="close-reveal-modal">&#215;</a>
    </div>
</body>
</html>