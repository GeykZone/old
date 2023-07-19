<?php include "function/function.php" ;
login()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in Page</title>

    <script src="resources/jQuery/main.js"></script>
    <link href="resources/bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="resources/bootstrap-5.0.2-dist/js/bootstrap.js"></script>

    <!-- Select2 4.1.0 -->
    <script src="../resourcess/selectized/selectize.min.js" ></script>
    <link rel="stylesheet" href="../resourcess/selectized/selectize.bootstrap5.css"  />
</head>
<body>
    <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            MU Moto Service <br />
            <span class= "text-warning">The Best Moto Service</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
          Looking for a reliable and trustworthy moto shop? Look no further! Our shop offers a wide range of services and products to meet all your moto needs. From repairs and maintenance to accessories and gear, we've got you covered. Come visit us today and experience the best moto shop in town.
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="sign-in.php" method="post">
                
                <!--confirmation message-->
                <div class="mb-4 text-center d-none" id="confirmation_container">
                    <div class="border-0 shadow-sm py-2  text-white rounded-3 px-3" id="confirmation_text"></div>
                </div>

                 <!-- usename input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="username">Username</label>
                  <input type="text" id="username" name="username" placeholder="Login username" class="form-control" />
                    <div class=" invalid-feedback for_username">
                    Invalid username!
                    </div>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" name="password" placeholder="Login password"  class="form-control " />
                    <div class=" invalid-feedback for_username">
                        Invalid password!
                    </div>
                </div>

                <!-- Submit button -->
                <div class="row">
                <div class="col-6">
                <button type="button" name = "sign_in" id="sign_in" class="btn  btn-warning btn-block mb-4">
                  Login
                </button>
                </div>
                
                <div class="col-6 text-lg-end">
                <a type="button" id="sign_up"  href="sign-up.php" class="btn btn-warning btn-block mb-4">
                  Sign-up
                </a>
                </div>

                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<script src="script/validation.js"></script>
</body>
</html>