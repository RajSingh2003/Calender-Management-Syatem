<?php
date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Form</title>
  </head>
  <body>
    <section class="form-08">
      <form method="post" action="auth/validate.php">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="_form-08-main">
              <div class="_form-08-head">
                <h2>Welcome To Event Scheduler</h2>
              </div>

              <div class="form-group">
                <label>Enter Your Email</label>
                <input type="email" name="username" class="form-control" type="text" placeholder="Enter Email" required="" aria-required="true">
              </div>

              <div class="form-group">
                <label>Enter Password</label>
                <input type="password" name="password" class="form-control" type="text" placeholder="Enter Password" required="" aria-required="true">
              </div>

              <div class="checkbox mb-0 form-group">
                <!-- <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="">
                  <label class="form-check-label" for="">
                    Remember me
                  </label>
                </div> -->
                <!-- <a href="#">Forgot Password</a> -->
              </div>

              <div class="form-group">
               
                 <input type="submit" name="submit" class="_btn_04">Login
               
              </div>

              <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>