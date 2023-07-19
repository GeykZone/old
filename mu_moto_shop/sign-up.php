<?php include "function/function.php" ;
register()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up Page</title>

    <script src="resources/jQuery/main.js"></script>
    <link href="resources/bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="resources/bootstrap-5.0.2-dist/js/bootstrap.js"></script>

    <!-- Select2 4.1.0 -->
    <script src="resources/selectized/selectize.min.js" ></script>
    <link rel="stylesheet" href="resources/selectized/selectize.bootstrap5.css"  />
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
              <form action="sign-up.php" method="post" >

              <!--confirmation message-->
              <div class="mb-4 text-center d-none" id="confirmation_container">
                <div class="border-0 shadow-sm  py-2 text-white rounded-3 px-3" id="confirmation_text"></div>
              </div>

                <!-- usename input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="create_username">Username</label>
                  <input type="text" id="create_username" name="create_username" placeholder="Create new username" class="form-control" />
                    <div class=" invalid-feedback for_create_username">
                    Invalid username!
                    </div>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="create_password">Password</label>
                  <input type="password" id="create_password" name="create_password" placeholder="Create new password" class="form-control " />
                    <div class=" invalid-feedback for_create_password">
                        Invalid password!
                    </div>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="confirm_password">Confirm Password</label>
                  <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" class="form-control " />
                    <div class=" invalid-feedback for_confirm_password">
                        Invalid! Password not Confirmed.
                    </div>
                </div>

                <!-- select branch -->
                <div class="form-outline mb-4">
                <label for="branch" class="form-label">Branch:</label>
                <select id="branch" id = "branch"  name="branch" class="form-control select_list"> 
                <option value="">Select Branch</option>
                <option value="MU-Oroq Moto Services">MU-Oroq Moto Services</option>
                <option value="MU-Tang Moto Services">MU-Tang Moto Services</option>
                <option value="MU-Oz Moto Services">MU-Oz Moto Services</option>
                </select>
                <div class="invalid-feedback">
                Invalid Selection.
                </div>
                </div>

                <!-- Submit button -->
                <div class="row">
                <div class="col-6">
                <button type="button" id = "crea_account" name="submit" class="btn  btn-warning btn-block mb-4">
                  Create Account
                </button>
                </div>
                
                <div class="col-6 text-lg-end">
                <a type="button" href="sign-in.php" class="btn  btn-warning btn-block mb-4">
                  Sign-in
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