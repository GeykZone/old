<?php include "../function/function.php" ;
dashboard()
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
        <div class="container-fluid bg-c-orange  p-2 fw-semibold px-5 rounded-3 mb-1 shadow-sm">
          <ul class="header-nav d-md-flex ">
            <li class="nav-item  "><a class="nav-link not_for_user_2  fw-bold"  href="../user/dashboard.php">Dashboard</a></li>
            <li class="nav-item "><a class="nav-link  not_for_user_2 active fw-bold" href="item-list.php">Items</a></li>
            <li class="nav-item "><a class="nav-link not_for_user_2  fw-bold" href="../user/user-list.php">Users</a></li>
          </ul>
          
          <form action="item-list.php" method="post">
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
              <li class="breadcrumb-item active"><span>Item List</span></li>
            </ol>
          </nav>
        </div>

      </header>

      <!--body-->
      <div class="body flex-grow-1 px-5">
      <div class="container-fluid">

        <!--total items-->
        <div class="col-lg card-group col-sm-12 rounded-3 shadow-sm">
            <div class="card border-0 rounded-3 shadow-sm order-card" >
            <div class=" card-header rounded-top-3 bg-c-orange  p-0  border-0 shadow-sm ">
            
            <h6 class="float-lg-start mt-2 mb-2 ms-3 text-white float-md-start adjust_font_size  order-card"><i class="fa-solid fa-table-list me-2"></i>Total Item List<span class="for_user"></span></h6>
            </div>
            <div class="card-body row">

            <div class=" dataTables_wrapper dt-bootstrap5 row" id="total_item_list_export_btn">
            <div class="col-lg-12">
            </div>
            </div>

            <div class="table-responsive total_item_table_container  container-fluid">
            <table class="table table-condensed table-borderless table-striped" id="total_items_table">
            <thead class=" bg-c-orange text-white">
            <tr>
            <th style="min-width:100px;"  >
                Item Name
            </th>
            <th  style="min-width: 100px;" >
                Brand Name
            </th>
            <th  style="min-width: 100px;" >
                Model Name
            </th>
            <th style="min-width: 100px;" >
                Branch
            </th>
            <th style="min-width: 100px;" >
                Price
            </th>
            <th style="min-width: 100px;" >
                Quantity
            </th>
            </tr>
            </thead>
            <tbody id="total_item_list">
            </tbody>
                <tfoot class=" table-secondary fw-semibold shadow-sm" id="tf_1">
                <tr class="align-middle" >
                <td id="Item Name" style="min-width: 100px;" ></td>
                <td id="Brand Name" style="min-width: 100px;" ></td>
                <td id="Model Name" style="min-width: 100px;" ></td>
                <td id="Branch" style="min-width: 100px;" ></td>
                <td id="Price" style="min-width: 100px;" ></td>
                <td id="Quantity" style="min-width: 100px;"></td>
                </tr>
                </tfoot>

            </table>
            </div>

            <div class="table-responsive container-fluid mt-3" >
            <div class="dataTables_wrapper dt-bootstrap5 row" id="total_item_list_export_btn_table_page">
            </div>
            </div>

            </div>
            </div>
        </div>
       

        <!--individual items-->
        <div class="col-lg not_for_user_2 card-group col-sm-12 mb-4 mt-4 rounded-3 shadow-sm">
        <div class="card border-0 rounded-3 shadow-sm order-card" >
        <div class=" card-header rounded-top-3 bg-c-orange  p-0  border-0 shadow-sm ">
          
        <h6 class="float-lg-start mt-2 mb-2 ms-3 text-white float-md-start adjust_font_size  order-card"><i class="fa-solid fa-table-list me-2"></i>Individual Item List<span class="for_user"></span></h6>
        </div>
        <div class="card-body row">

            <div class=" container-fluid">
             
            <!--confirmation message-->
            <div class="mb-4 text-center d-none" id="confirmation_container" >
                <div class="border-0 shadow-sm py-2 text-white rounded-3 px-3" id="confirmation_text"></div>
              </div>

            <!--add_items--form-->
            <form class = "mb-3 d-none" id="new_item_form">
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
              <input type="text" id="item_name" class="form-control" placeholder="New item name">
              <div class=" invalid-feedback for_create_user_name">
              Invalid item name!
              </div>
              </div>
              <div class="col">
              <input type="text" id="item_model" class="form-control" placeholder="New model name">
              <div class=" invalid-feedback for_create_user_name">
              Invalid item model!
              </div>
              </div>
              <div class="col">
              <select name="add_brand" id = "add_brand"  class="form-control select_list add_brand" > 
                  <option value="">Select brand</option>
                  <option value="Others">Others</option>
                  <option value="Unknown">Unknown</option>
                  <?php select_brand() ?>
              </select>
              <div class=" invalid-feedback for_add_user_type">
                  Invalid selection!
              </div>
              </div>
              <div class="col d-none" id="alternative_brand_container">
              <input type="text" id="alternative_brand" class="form-control" placeholder="New brand name">
              <div class=" invalid-feedback for_create_user_name">
              Invalid brand name!
              </div>
              </div>
              <div class="col">
              <input type="number" id="item_price" name = "item_price" class="form-control" placeholder="Add item price">
              <div class=" invalid-feedback for_create_user_name">
              Invalid price!
              </div>
              </div>
              </div>
              <div class="col-lg-6 mt-3">
              <a style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 me-2 shadow-sm btn btn-warning text-white add-brgy px-3 fw-bolder" id="submit_new_item"  role="button" >CREATE <span class="fa-solid ms-1 fa-paper-plane"></a>
              <a style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 shadow-sm btn btn-warning add-brgy text-white px-3 fw-bolder" id="cancel_add_new_item"  role="button" >CANCEL <span class="fa-solid ms-1 fa-circle-xmark"></a>
              </div>
            </form>

            <!--update_items--form-->
            <form class = "mb-3 d-none" id="update_item_form">
              <div class="row">
              <div class="col for_main_admin_only">
              <select name="update_branch" id = "update_branch" class="form-control select_list update_branch"> 
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
              <input type="text" id="update_item_name" class="form-control" placeholder="Update item name">
              <div class=" invalid-feedback for_create_user_name">
              Invalid item name!
              </div>
              </div>
              <div class="col">
              <input type="text" id="update_item_model" class="form-control" placeholder="Update model name">
              <div class=" invalid-feedback for_create_user_name">
              Invalid item model!
              </div>
              </div>
              <div class="col">
              <select name="update_brand" id = "update_brand"  class="form-control select_list update_brand" > 
                  <option value="">Select brand</option>
                  <option value="Others">Others</option>
                  <option value="Unknown">Unknown</option>
                  <?php select_brand() ?>
              </select>
              <div class=" invalid-feedback for_add_user_type">
                  Invalid selection!
              </div>
              </div>
              <div class="col d-none" id="update_alternative_brand_container">
              <input type="text" id="alternative_brand" class="form-control" placeholder="New brand name">
              <div class=" invalid-feedback for_create_user_name">
              Invalid brand name!
              </div>
              </div>
              <div class="col">
              <input type="number" id="update_item_price" name = "update_item_price" class="form-control" placeholder="Add item price">
              <div class=" invalid-feedback for_create_user_name">
              Invalid price!
              </div>
              </div>
              </div>
              <div class="col-lg-6 mt-3">
              <a style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 me-2 shadow-sm btn btn-warning text-white add-brgy px-3 fw-bolder" id="submit_update_item"  role="button" >UPDATE <span class="fa-solid ms-1 fa-paper-plane"></a>
              <a style="padding-top: 7px; padding-bottom: 7px;" class="mb-4 border-0 shadow-sm btn btn-warning add-brgy text-white px-3 fw-bolder" id="cancel_update_item"  role="button" >CANCEL <span class="fa-solid ms-1 fa-circle-xmark"></a>
              </div>
            </form>

            <div class=" dataTables_wrapper dt-bootstrap5 row" id="individual_item_list_export_btn">
            <div class="col-lg-12">
            <a style="padding-top: 7px; padding-bottom: 7px;" id="show_new_item_form" class="mb-3 border-0 shadow-sm btn btn-warning text-white add-brgy px-3 fw-bolder"  role="button" >NEW <span class="fa-solid ms-1 fa-circle-plus"></a>
            </div>
            </div>
            </div>

          <div class="table-responsive  container-fluid">
          <table class="table table-condensed table-borderless table-striped" id="individual_item_list_table">
          <thead class=" bg-c-orange text-white">
          <tr>
            <th style="min-width:100px;"  >
            Item Name
            </th>
            <th  style="min-width: 100px;" >
            Brand Name
            </th>
            <th  style="min-width: 100px;" >
            Model Name
            </th>
            <th style="min-width: 100px;" >
            Branch
            </th>
            <th style="min-width: 100px;" >
            Price
            </th>
            <th style="min-width: 100px;" >
            Date Addded
            </th>
            <th style="min-width: 100px;" class="text-end pe-5" >
            Actions
            </th>
          </tr>
          </thead>
          <tbody id="individual_item_list">
          </tbody>

            <tfoot class=" table-secondary fw-semibold shadow-sm" id="th_1">
            <tr class="align-middle" >
                <td id="Item Name" style="min-width: 100px;" ></td>
                <td id="Brand Name" style="min-width: 100px;" ></td>
                <td id="Model Name" style="min-width: 100px;" ></td>
                <td id="Branch" style="min-width: 100px;" ></td>
                <td id="Price" style="min-width: 100px;" ></td>
                <td id="Date added" style="min-width: 100px;" ></td>
                <td id="Actions" style="min-width: 100px;" class="pe-4"></td>
            </tr>
            </tfoot>

          </table>
          </div>

        <div class="table-responsive container-fluid" >
        <div class="dataTables_wrapper dt-bootstrap5 row" id="individual_item_list_export_btn_table_page">
        </div>
        </div>

        </div>
        </div>
        </div>
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

    <script src="../script/item-list.js"></script>
  </body>
</html>