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
      <div id="login">
        <!-- FORM TO CREATE A NEW USER-->
        <form action="register.php" method="post" enctype="multipart/form-data">
          <br/>
          <div class="row">
              <!-- error messaging -->
              <?php
                  if ($_GET['error'] == 'old') {
                    echo "<div data-alert id='error' class='alert-box warning'>
                    Someone is already registered with that email address and/or password. <a href='new.php'>Create a new account?</a></div>";
                  }
                ?> 
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

</body>
</html>