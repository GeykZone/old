<?php include "../function/function.php" ;
dashboard();
is_not_admin();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>User List</title>

     <script src="../resources/jQuery/main.js"></script>
    <!-- Vendors styles-->
    <link rel="stylesheet" href="../resources/core_ui/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="../resources/core_ui/css/vendors/simplebar.css">
    <link href="../resources/core_ui/css/style.css" rel="stylesheet">
    <link href="../resources/core_ui/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">

    <!--jquery data tables-->
    <link rel="stylesheet" type="text/css" href="../resources/DataTables/datatables.min.css"/>
    <script type="text/javascript" src="../resources//DataTables/datatables.js"></script>

    <!--icons-->
    <script src="../resources/fontawesome-free/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../resources/fontawesome-free/css/all.css">

    <!-- Select2 4.1.0 -->
    <script src="../resources/selectized/selectize.min.js" ></script>
    <link rel="stylesheet" href="../resources/selectized/selectize.bootstrap5.css"  />
  </head>
  <body>

    <div class="wrapper d-flex flex-column min-vh-100">
      <header class="header header-sticky mb-4 border-0 shadow-sm">

        <!--nav head-->
        <div class="container-fluid bg-c-orange p-2 fw-semibold px-5 rounded-3 mb-1 shadow-sm">
          <ul class="header-nav d-md-flex ">
            <li class="nav-item "><a class="nav-link  fw-bold"  href="dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="../item/item-list.php">Items</a></li>
            <li class="nav-item"><a class="nav-link active fw-bold" href="user-list.php">Users</a></li>
          </ul>
          
          <form action="dashboard.php" method="post">
           <ul class="header-nav ">
            <li class="nav-item">
            <button class="nav-link py-0  fw-bold border-0 bg-transparent" type="submit" name ="logout" id = "logout">
              logout
            </button>
            </li>
          </ul>
          </form>
        </div>
        
        <div class="header-divider "></div>

        <!--bread crumbs-->
        <div class="container-fluid bg-white m-0 mb-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Home</span>
              </li>
              <li class="breadcrumb-item active"><span>User List</span></li>
            </ol>
          </nav>
        </div>

      </header>

      <!--body-->
      <div class="body flex-grow-1 px-5">
      <div class="container-fluid">

        <!--table-->
        <div class="col-lg card-group col-sm-12 rounded-3 shadow-sm">
        <div class="card border-0 rounded-3 shadow-sm order-card" >
        <div class=" card-header rounded-top-3 bg-c-orange  p-0  border-0 shadow-sm ">
          
        <h6 class="float-lg-start mt-2 mb-2 ms-3 text-white float-md-start adjust_font_size  order-card"><i class="fa-solid fa-table-list me-2"></i>Users</h6>
        </div>
        <div class="card-body row">

            <div class=" container-fluid">
             
            <!--confirmation message-->
            <div class="mb-4 text-center d-none" id="confirmation_container" >
                <div class="border-0 shadow-sm bg-success py-2 text-white rounded-3 px-3" id="confirmation_text"></div>
              </div>

            <!--add_new_user--form-->
            <form class = "mb-3 d-none" id="new_user_form">
              <div class="row">
              <div class="col for_main_admin_only">
              <select name="branch" id = "branch" class="form-control select_list branch"> 
              <option value="">Select Branch</option>
              <option value="Main">MU Moto Main Branch</option>
              <option value="MU-Oroq Moto Services">MU-Oroq Moto Services</option>
              <option value="MU-Tang Moto Services">MU-Tang Moto Services</option>
              <option value="MU-Oz Moto Services">MU-Oz Moto Services</option>
              </select>
              <div class=" invalid-feedback for_branch">
              Invalid selection!
              </div>
              </div>
              <div class="col">
              <select name="add_user_type" id = "add_user_type"  class="form-control select_list add_user_type" > 
                  <option value="">Select User Type</option>
                  <option value="0" class = "for_main_admin_only">Main Admin</option>
                  <option value="1">Branch Admin</option>
                  <option value="2">User</option>
              </select>
              <div class=" invalid-feedback for_add_user_type">
                  Invalid selection!
                  </div>
              </div>
              <div class="col">
              <input type="text" id="create_user_name" class="form-control" placeholder="Create username">
              <div class=" invalid-feedback for_create_user_name">
              Invalid username!
              </div>
              </div>
              <div class="col">
              <input type="text" id="create_user_password" class="form-control" placeholder="Create user password">
              <div class=" invalid-feedback for_create_user_password">
              Invalid password!
              </div>
              </div>
              </div>
              <div class="col-lg-6 mt-3">
              <a style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 me-2 shadow-sm btn btn-warning text-white add-brgy px-3 fw-bolder" id="submit_new_user"  role="button" >CREATE <span class="fa-solid ms-1 fa-paper-plane"></a>
              <a style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 shadow-sm btn btn-warning add-brgy text-white px-3 fw-bolder" id="cancel_add_new_user"  role="button" >CANCEL <span class="fa-solid ms-1 fa-circle-xmark"></a>
              </div>
            </form>

            <!--update_new_user--form-->
            <form class = "mb-3 d-none" id="update_this_user_form">
              <div class="row">
              <div class="col for_main_admin_only">
                  <select name="update_branch" id="update_branch" class="form-control  update_branch shadow-sm" >
                  <option value="" >Select Branch</option>
                  <option value="Main">MU Moto Main Branch</option>
                  <option value="MU-Oroq Moto Services">MU-Oroq Moto Services</option>
                  <option value="MU-Tang Moto Services">MU-Tang Moto Services</option>
                  <option value="MU-Oz Moto Services">MU-Oz Moto Services</option>
                  </select>
                  <div class=" invalid-feedback for_update_branch">
                  Invalid selection!
                  </div>
              </div>
              <div class="col">
                  <select  id = "update_user_type"  name="update_user_type" class="form-control update_user_type select_list"> 
                  <option value="">Update User Type</option>
                  <option value="0">Main Admin</option>
                  <option value="1">Branch Admin</option>
                  <option value="2">User</option>
                  </select>
                  <div class=" invalid-feedback for_update_user_type">
                  Invalid selection!
                  </div>
              </div>
              </div>
              <div class="col-lg-6 mt-3">
              <button style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 me-2 shadow-sm  text-white btn btn-warning add-brgy px-3 fw-bolder" id="submit_update_user"  type = "button" >UPDATE <span class="fa-solid ms-1 fa-paper-plane"></button>
              <button style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 me-2 shadow-sm text-white btn btn-warning add-brgy px-3 fw-bolder" id="cancel_update_user" type ="button" >CANCEL <span class="fa-solid ms-1 fa-circle-xmark"></button>
              </div>
            </form>

            <div class=" dataTables_wrapper dt-bootstrap5 row" id="buttons">
            <div class="col-lg-12">
            <a style="padding-top: 7px; padding-bottom: 7px;" id="show_new_user_form" class="mb-3 border-0 shadow-sm btn btn-warning text-white add-brgy px-3 fw-bolder"  role="button" >NEW <span class="fa-solid ms-1 fa-circle-plus"></a>
            </div>
            </div>
            </div>

          <div class="table-responsive  container-fluid">
          <table class="table table-condensed table-borderless table-striped" id="user_list_table">
          <thead class=" bg-c-orange text-white">
          <tr>
          <th style="min-width:100px;" class="text-start" >
             Username
          </th>
          <th  style="min-width: 100px;" class="text-center">
             User Type
          </th>
          <th  style="min-width: 100px;" class="text-center">
             Branch
          </th>
          <th style="min-width: 100px;" class="text-end pe-5">
             Actions
          </th>
          </tr>
          </thead>
          <tbody id="user_list">
          </tbody>

            <tfoot class=" table-secondary fw-semibold shadow-sm" id="th_1">
            <tr class="align-middle" >
            <td id="Username" style="min-width: 100px;" class="text-start"></td>
            <td id="User Type" style="min-width: 100px;" class="text-start"></td>
            <td id="Branch" style="min-width: 100px;" class="text-center"></td>
            <td id="Actions" style="min-width: 100px;" class="text-end pe-4"></td>
            </tr>
            </tfoot>

          </table>
          </div>

        <div class="table-responsive container-fluid" >
        <div class="dataTables_wrapper dt-bootstrap5 row" id="table_page">
        </div>
        </div>

        </div>
        </div>
        </div>
        <!--table-->
      </div>
      </div>
    
    <footer class="footer">
    <div><a >MU Moto Shop</a> <a>Powered by</a> © <span id="footer_date">2023</span> MU</div>
    </footer>
    </div>

    <script> 
     var user_name = <?php echo json_encode($_SESSION['username']); ?>;
     var user_type = <?php echo json_encode($_SESSION['user_type']);  ?>;
     var branch = <?php echo json_encode($_SESSION['branch']); ?>;
     var user_id = <?php echo json_encode($_SESSION['logged_in']); ?>;
    </script>

    <script src="../script/user-list.js"></script>
  </body>
</html>