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
    <title>Dashboard</title>

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
  </head>
  <body>

    <div class="wrapper d-flex flex-column min-vh-100">
      <header class="header header-sticky mb-4 border-0 shadow-sm">

        <!--nav head-->
        <div class="container-fluid bg-c-orange p-2 fw-semibold px-5 rounded-3 mb-1 shadow-sm">
          <ul class="header-nav d-md-flex ">
            <li class="nav-item "><a class="nav-link active fw-bold"  href="dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="../item/item-list.php">Items</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="user-list.php">Users</a></li>
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
              <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
          </nav>
        </div>

      </header>

      <!--body-->
      <div class="body flex-grow-1 px-5">
      <div class="container-fluid">


        <div  class="col-12  mb-4 ">
        <div class="card bg-light  border-0 rounded-4 shadow-sm order-card"  >
        <div class="card-body adjust_font_size row ">
        <div  class="col-12 px-4" id="hp_chart_row_brgy" >

        <h1 class="display-3 fw-bold">WELCOME ADMIN <span id = "user_name"></span></h1>

        <div class="mt-2 mb-2 row">
          <span class=" text-start col-6 fw-bold"><span class="shortCut_btn" id = "branch_name"></span> <span id="admin_user_of"></span></span><span class=" text-end col-6 pe-4" ><li class="fa-solid display-1"></li></span></div>
        </div>
        </div>
        </div>
        </div>

        <!--chart-->
        <div class="row" >
        <div  class="col-lg-6 card-group mb-4 col-sm-12 ">
        <div class="card  bg-light shadow   border-0 rounded-4 shadow-sm order-card"  >
        <div class="card-body adjust_font_size row ">
        <div  class="col-12 px-4" id="hp_chart_row_brgy" >

        <h1 class="display-3 fw-bold" id="item_count"></h1>

        <div class="mt-2 row"><span class=" text-start col-6"><span class="shortCut_btn fw-medium" id = "barangay_health_statistic_shorcut">Total Number of Items</span></span><span class=" text-end col-6 pe-4" ><li class="fa-solid display-1"></li></span></div>
        <div class="mt-1 fw-semibold opacity-75">One month ( <span class="one_month_from mt-0">Jun 19, 2023</span> - <span class="one_month_to mt-0">Jun 19, 2023</span> )</div>
        </div>
        </div>
        </div>
        </div>

        <div  class="col-lg-6 card-group mb-4 col-sm-12 ">
        <div class="card bg-light   border-0 rounded-4 shadow-sm order-card"  >
        <div class="card-body adjust_font_size row">
        <div  class="col-12  px-4" id="hp_chart_row_disease" >

        <h1 class="display-3 fw-bold" id="user_count"></h1>

        <div class="mt-2 row"><span class=" text-start col-6"><span class="shortCut_btn fw-medium"  id = "disease_statistic_shorcut" >Total Number of Users</span></span><span class=" text-end col-6 pe-4" ><li class="fa-solid display-1"></li></span></div>
        <div class="mt-1 fw-semibold opacity-75" id = "all_user_label"></div>
        </div>
        </div>
        </div>
        </div>
        </div>

        <!--shorcuts-->
        <div class="col-lg card-group col-sm-12 rounded-3 mb-4 shadow-sm">
        <div class="card border-0 rounded-3 shadow-sm order-card" >
        <div class=" card-header rounded-top-3 bg-c-orange  p-0  border-0 shadow-sm ">
          
        <h6 class="float-lg-start mt-2 mb-2 ms-3 text-white float-md-start adjust_font_size  order-card"><i class="fa-solid fa-table-list me-2"></i> Newly Added Items</h6>
        </div>
        <div class="card-body row">

        <div class="px-3">
        <p class="adjust_font_size text-dark fw-semibold opacity-75" >One month ( <span class="one_month_from"></span> - <span class="one_month_to"></span> )</p>
        </div>

          <div class="table-responsive ">
          <table class="table table-condensed" id="item_list_table_in_dashboard">
          <thead>
          <tr>
          <th style="min-width:100px;" >
          Item Name
          </th>
          <th  style="min-width: 100px;">
          Brand Name
          </th>
          <th style="min-width: 100px;"  >
          Model Name
          </th>
          <th style="min-width: 160px;"  >
          Branch
          </th>
          <th style="min-width: 100px;" >
          Price
          </th>
          <th style="min-width: 100px;"  >
          Date Added
          </th>
          </tr>
          </thead>
          <tbody id="New_items">
          </tbody>
          </table>
          </div>

        </div>
        </div>
        </div>
        <!--shorcuts-->
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
    </script>
    <script src="../script/admin-dashboard.js"></script>

  </body>
</html>