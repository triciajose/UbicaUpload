<!doctype html> 
<html>
<head>
  <meta charset="utf-8" />
      <title>UbiCA Docshare</title>
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

        <br/>
    <br />
    <br />
    <br />
    <div class="row">
    <!-- FORM -->
      <div id="login">
        <form action="home.php" method="post" enctype="multipart/form-data">
          <br/>
            <a href="index.html"><img src="newlogo.gif" />  </a>  
            <br />
            <br />
<!--           <div class="row">
                <input type="text" name="username" placeholder="Email address" />
          </div> -->
          <div class="row">
          <!-- ERROR MESSAGE -->
            <?php
              if ($_GET['error'] == 'yes') {
                echo "<div data-alert id='error' class='alert-box warning'>
                Your passkey is incorrect. <a href='new.php'>Create a new account?</a></div>";
              }
            ?> 
            <input type="password" name="password" placeholder="Passkey" />
          </div>
          <br />
          <div class="row">
          <br />
            <input type="submit" class="choose" name="submit" value="Go!">
            or <a href="new.php">      Register a new account</a>

          </div>
        </form>
        </div>

    </div>
</body>
</html>