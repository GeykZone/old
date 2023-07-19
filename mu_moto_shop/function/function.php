<?php 
//function call for ajax
total_item_count_for_this_month();
total_number_of_users();
item_list();
user_list();
updated_users();
create_new_user();
delete_user();
total_item_list();
individual_item_list();
insert_items();
update_items();
delete_item();

// initialize database connection
function connection()
{

    $conn = new mysqli('sql307.infinityfree.com', 'if0_34500593', '3EwpKoufhq9', 'if0_34500593_mu_moto_shop');

    if($conn->connect_error)
    {
        echo "Connection Error: ".$conn->connect_error;
    }
    else
    {
        return $conn;
    }

}

// function for hashing 
function encrypt_decrypt($action, $string) {
  $output = false;

  $encrypt_method = "AES-256-CBC";
  $secret_key = 'GeykZone2366';
  $secret_iv = 'mara114136';

  $key = hash('sha256', $secret_key);

  $iv = substr(hash('sha256', $secret_iv), 0, 16);

  if ( $action == 'encrypt' ) {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = base64_encode($output);
  } else if( $action == 'decrypt' ) {
      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  }

  return $output;
}

// validate registration detatils
function register()
{
  session_start();
  ?><script> var confirmation = 0; </script><?php
  if(isset($_POST['submit']))
  {
    $conn = connection();
    $username = $_POST['create_username'];
    $password = $_POST['create_password'];
    $password = encrypt_decrypt('encrypt', $password);
    $branch = $_POST['branch'];

    $sql = "INSERT INTO `user` (`username`, `password`, `branch`) VALUES ('$username','$password','$branch')";
    if($conn->query($sql) === true)
    {
        ?><script> var confirmation = 1; </script><?php
    }
    else
    {
        ?><script> var confirmation = 2; </script><?php
    }
  }

  if(isset($_SESSION['logged_in']))
  {
      header("Location: sign-in.php");
  }

}

// validate logi details
function login()
{
    session_start();
    ?><script> var confirmation = 0; </script><?php
    if(isset($_POST['sign_in']))
    {
        $conn = connection();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = encrypt_decrypt('encrypt', $password);

        $sql = "SELECT * FROM `user` WHERE username = '$username'";
        if($conn->query($sql)->num_rows > 0)
        {
            $row = $conn->query($sql)->fetch_assoc();
            $compare_db_password = $row['password'];
            $id = $row['user_id'];

            if($password == $compare_db_password)
            {
                $_SESSION['logged_in'] =  $id;
                $user_id = $_SESSION['logged_in'];

                $sql = "SELECT * FROM `user`  WHERE `user_id` = '$user_id'";
                if($conn->query($sql)->num_rows > 0)
                {
                    $row = $conn->query($sql)->fetch_assoc();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['branch'] = $row['branch'];
                }
            }
            else
            {
                ?><script> var confirmation = 3; </script><?php
            }

        }
        else
        {
            ?><script> var confirmation = 3; </script><?php
        }
    }

    if(isset($_SESSION['logged_in']))
    {
        if($_SESSION['user_type'] === 2 || $_SESSION['user_type'] === '2')
        {
            header("Location: item/item-list.php");
        }
        else
        {
            header("Location: user/dashboard.php");
        }
    }
}

// some functions you can do inside dashboard like logout
function dashboard()
{
    session_start();
    if(isset($_POST['logout']))
    {
        session_destroy();
        header("Location: ../sign-in.php");
    }

    if(!isset($_SESSION['logged_in']))
    {
        header("Location: ../sign-in.php");
    }

}

//query item count for current month from database
function total_item_count_for_this_month()
{
    if(isset($_GET['total_item_for_this_month']))
    {
        $conn = connection();
        $user_type = $_GET['user_type'];
        $branch = $_GET['branch'];
        $start = $_GET['start'];
        $end = $_GET['end'];

        $where = "WHERE i.date_added BETWEEN '$start' AND '$end'";

        if($user_type != 0)
        {
            if($branch === "MU-Oroq Moto Services")
            {
                $where = "WHERE i.branch = 'MU-Oroq Moto Services' AND i.date_added BETWEEN '$start' AND '$end'";
            }
            else if($branch === "MU-Tang Moto Services")
            {
                $where = "WHERE i.branch = 'MU-Tang Moto Services' AND i.date_added BETWEEN '$start' AND '$end'";
            }
            else if($branch === "MU-Oz Moto Services")
            {
                $where = "WHERE i.branch = 'MU-Oz Moto Services' AND i.date_added BETWEEN '$start' AND '$end'";
            }
        }

        $sql = "SELECT b.brand_id, b.brand_name, i.item_id, i.item_name, i.model_name, i.price, i.date_added, i.branch, COUNT(*) AS item_count
                FROM items AS i 
                LEFT JOIN brand AS b ON i.brand_id = b.brand_id " . $where;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) {
            $total_items_in_this_month[] = $row['item_count'];
            }
        }
        else
        {
            $total_items_in_this_month = 0;
        }
            print json_encode($total_items_in_this_month);
    }

}

//query total number of registered users from database
function total_number_of_users()
{

     if(isset($_GET['total_number_of_users']))
     {
        $conn = connection();
        $user_type = $_GET['user_type'];
        $branch = $_GET['branch'];
        $where = "";

        if($user_type != 0)
        {
            if($branch === "MU-Oroq Moto Services")
            {
                $where = "WHERE branch ='MU-Oroq Moto Services'";
            }
            else if($branch === "MU-Tang Moto Services")
            {
                $where = "WHERE branch = 'MU-Tang Moto Services'";
            }
            else if($branch === "MU-Oz Moto Services")
            {
                $where = "WHERE branch = 'MU-Oz Moto Services'";
            }
        }

        $sql = "SELECT branch, COUNT(*) AS user_count FROM user " . $where;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) {
            $total_registered_user[] = $row['user_count'];
            }
        }
        else
        {
            $total_registered_user = 0;
        }
            print json_encode($total_registered_user);

     }

}

//show newly added items base on one month in the dashboard
function item_list()
{
      if(isset($_GET['item_lists']))
      {
          
            $dbDetails = array( 
            'host' => 'sql307.infinityfree.com', 
            'user' => 'if0_34500593' , 
            'pass' => '3EwpKoufhq9', 
            'db'   => 'if0_34500593_mu_moto_shop'
            ); 

            $last_month = $_GET['last_month'];
            $current_month = $_GET['current_month'];
            $user_type = $_GET['user_type'];
            $branch = $_GET['branch'];

            $table = 'items'; 
            $primaryKey = 'item_id'; 
            $columns = array( 
            array( 'db' => 'item_name',  'dt' => 0, 'field' => 'item_name'),
            array( 'db' => 'brand_name', 'dt' => 1, 'field' => 'brand_name' ), 
            array( 'db' => 'model_name',  'dt' => 2, 'field' => 'model_name' ), 
            array( 'db' => 'branch',  'dt' => 3, 'field' => 'branch' ), 
            array( 'db' => 'price',  'dt' => 4, 'field' => 'price' ), 
            array( 'db' => 'date_added',  'dt' => 5, 'field' => 'date_added' ), 
            ); 
            require '../resources/ssp.class.php'; 

            $joinQuery = ", b.brand_id, b.brand_name, i.item_id, i.item_name, i.model_name, i.price, i.date_added, i.branch FROM items AS i LEFT JOIN
            brand AS b ON i.brand_id = b.brand_id";
            $where=" `date_added` BETWEEN '$last_month' AND '$current_month'";

            if($user_type != 0)
            {
            if($branch === "MU-Oroq Moto Services")
            {
                 $where = " `branch` = 'MU-Oroq Moto Services' AND i.date_added BETWEEN '$last_month' AND '$current_month'";
            }
            else if($branch === "MU-Tang Moto Services")
            {
                 $where = " `branch` = 'MU-Tang Moto Services' AND i.date_added BETWEEN '$last_month' AND '$current_month'";
            }
            else if($branch === "MU-Oz Moto Services")
            {
                 $where = " `branch` = 'MU-Oz Moto Services' AND i.date_added BETWEEN '$last_month' AND '$current_month'";
            }
            }

            echo json_encode( 
            SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns, $joinQuery,$where )  
            );
      }
    
}

//show list of registered users from the system
function user_list()
{
    if(isset($_GET['user_list']))
    {
        $dbDetails = array( 
            'host' => 'sql307.infinityfree.com', 
            'user' => 'if0_34500593' , 
            'pass' => '3EwpKoufhq9', 
            'db'   => 'if0_34500593_mu_moto_shop'
            );

        $user_type = $_GET['user_type'];
        $branch = $_GET['branch'];
        $user_id = $_GET['user_id'];

        $table = 'user'; 
        $primaryKey = 'user_id'; 
        $columns = array( 
        array( 'db' => 'username',  'dt' => 0, 'field' => 'username'),
        array( 'db' => 'user_type',  'dt' => 1, 'field' => 'user_type'),
        array( 'db' => 'branch', 'dt' => 2, 'field' => 'branch' ), 
        array( 'db' => 'user_id', 'dt' => 3, 'field' => 'user_id' ), 
        ); 
        require '../resources/ssp.class.php';
    
        $joinQuery = ", branch, username FROM user";
        $where="";

        if($user_type != 0)
        {
            if($branch === "MU-Oroq Moto Services")
            {
                    $where = " `branch` = 'MU-Oroq Moto Services' AND ";
            }
            else if($branch === "MU-Tang Moto Services")
            {
                    $where = " `branch` = 'MU-Tang Moto Services' AND ";
            }
            else if($branch === "MU-Oz Moto Services")
            {
                    $where = " `branch` = 'MU-Oz Moto Services' AND ";
            }
        }

        echo json_encode( 
        SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns, $joinQuery,$where )  
        );

    }
}

//update the user details in database
function updated_users()
{
    if(isset($_POST['submit_updated_user']))
    {
        $conn = connection();
        $user_id = $_POST["user_id"];
        $updated_user_type = $_POST["updated_user_type"];
        $updated_branch = $_POST["updated_branch"];
        $confirmation = 0; 

        $sql = "UPDATE `user` SET `user_type`='$updated_user_type', `branch` = '$updated_branch' 
        WHERE `user_id`='$user_id' ";
        if ($conn->query($sql) === TRUE)
        {
          $confirmation = 2;
        }
        else {
          $confirmation = 4;
        }

        echo $confirmation;
    }
}

//function for adding user in database
function create_new_user()
{

    if(isset($_POST['submit_create_user']))
    {
        $conn = connection();
        $create_branch = $_POST['create_branch'];
        $create_username = $_POST['create_username'];
        $create_password = $_POST['create_password'];
        $create_password = $password = encrypt_decrypt('encrypt', $create_password);
        $create_user_type = $_POST['create_user_type'];

        $sql = "INSERT INTO `user` (`username`, `password`, `user_type`,`branch`) VALUES ('$create_username','$create_password','$create_user_type','$create_branch')";
        if($conn->query($sql) === true)
        {
           $confirmation = 1;
        }
        else
        {
            $confirmation = 5;
        }

        echo $confirmation;
    }

}

//delete user
function delete_user()
{
    if (isset($_POST['delete_user']))
    {
        $conn = connection();
        $user_id = $_POST['user_id'];

        $sql = "DELETE FROM `user` WHERE `user_id` = '$user_id'";
        $result = $conn->query($sql);

        if ($result === TRUE)
        {
            $confirmation = 3;
        }
        else
        {
            $confirmation = 4;
        }

        echo $confirmation;
    }
}

//show total Item list in item page
function total_item_list()
{
    if(isset($_GET['total_item_list']))
    {
        $dbDetails = array( 
        'host' => 'sql307.infinityfree.com', 
        'user' => 'if0_34500593' , 
        'pass' => '3EwpKoufhq9', 
        'db'   => 'if0_34500593_mu_moto_shop'
        ); 

        $user_type = $_GET['user_type'];
        $branch = $_GET['branch'];

        $table = 'items'; 
        $primaryKey = 'item_id'; 
        $columns = array( 
        array( 'db' => 'item_name',  'dt' => 0, 'field' => 'item_name'),
        array( 'db' => 'brand_name', 'dt' => 1, 'field' => 'brand_name' ), 
        array( 'db' => 'model_name',  'dt' => 2, 'field' => 'model_name' ), 
        array( 'db' => 'branch',  'dt' => 3, 'field' => 'branch' ), 
        array( 'db' => 'price',  'dt' => 4, 'field' => 'price' ), 
        array( 'db' => 'COUNT(*)',  'dt' => 5, 'field' => 'COUNT(*)' ), 
        ); 
        require '../resources/ssp.class.php'; 

        $joinQuery = ", b.brand_id, b.brand_name, i.item_id, i.item_name, i.model_name, i.price, i.date_added, i.branch FROM items AS i LEFT JOIN
        brand AS b ON i.brand_id = b.brand_id";
        $where="";

        if($user_type != 0)
        {
        if($branch === "MU-Oroq Moto Services")
        {
                $where = " `branch` = 'MU-Oroq Moto Services' ";
        }
        else if($branch === "MU-Tang Moto Services")
        {
                $where = " `branch` = 'MU-Tang Moto Services' ";
        }
        else if($branch === "MU-Oz Moto Services")
        {
                $where = " `branch` = 'MU-Oz Moto Services' ";
        }
        }

         $group = " b.brand_name, i.item_name, i.model_name, i.price, i.branch ";

        echo json_encode( 
        SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns, $joinQuery,$where, $group  )  
        );
    }
    
}

//show individual item list in item page
function individual_item_list()
{
     if(isset($_GET['individual_item_list']))
    {
        $dbDetails = array( 
        'host' => 'sql307.infinityfree.com', 
        'user' => 'if0_34500593' , 
        'pass' => '3EwpKoufhq9', 
        'db'   => 'if0_34500593_mu_moto_shop'
        ); 

        $user_type = $_GET['user_type'];
        $branch = $_GET['branch'];

        $table = 'items'; 
        $primaryKey = 'item_id'; 
        $columns = array( 
        array( 'db' => 'item_name',  'dt' => 0, 'field' => 'item_name'),
        array( 'db' => 'brand_name', 'dt' => 1, 'field' => 'brand_name' ), 
        array( 'db' => 'model_name',  'dt' => 2, 'field' => 'model_name' ), 
        array( 'db' => 'branch',  'dt' => 3, 'field' => 'branch' ), 
        array( 'db' => 'price',  'dt' => 4, 'field' => 'price' ), 
        array( 'db' => 'date_added',  'dt' => 5, 'field' => 'date_added' ), 
        array( 'db' => 'item_id',  'dt' => 6, 'field' => 'item_id' ), 
        ); 
        require '../resources/ssp.class.php'; 

        $joinQuery = ", b.brand_id, b.brand_name, i.item_id, i.item_name, i.model_name, i.price, i.date_added, i.branch FROM items AS i LEFT JOIN
        brand AS b ON i.brand_id = b.brand_id";
        $where="";

        if($user_type != 0)
        {
        if($branch === "MU-Oroq Moto Services")
        {
                $where = " `branch` = 'MU-Oroq Moto Services' ";
        }
        else if($branch === "MU-Tang Moto Services")
        {
                $where = " `branch` = 'MU-Tang Moto Services' ";
        }
        else if($branch === "MU-Oz Moto Services")
        {
                $where = " `branch` = 'MU-Oz Moto Services' ";
        }
        }

        echo json_encode( 
        SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns, $joinQuery,$where  )  
        );
    }
}

//select existing brand
function select_brand()
{
    $conn = connection();
    $sql = "SELECT * FROM `brand`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?><option value="<?php echo $row["brand_name"];?>"><?php echo $row["brand_name"];?></option><?php
    }
    }
}

//insert item into the database
function insert_items()
{
    if(isset($_POST['submit_insert_user']))
    {
        $conn = connection();
        $date_today = $_POST['date_today'];
        $create_item_name = $_POST['create_item_name'];
        $create_item_model = $_POST['create_item_model'];
        $create_add_brand = $_POST['create_add_brand'];
        $create_add_brand = ucwords($create_add_brand);
        $create_item_price = $_POST['create_item_price'];
        $create_branch_name = $_POST['create_branch_name'];
        $brand_id = 0;

        $sql = "INSERT INTO `brand` (`brand_name`) VALUES ('$create_add_brand')";
        $conn->query($sql);

        $sql = "SELECT * FROM `brand` WHERE `brand_name` = '$create_add_brand'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {   
          
            while($row = $result->fetch_assoc()) 
            {
                $brand_id = $row['brand_id'];
            }

            $sql = "INSERT INTO `items` (`item_name`,`model_name`,`brand_id`,`branch`,`price`,`date_added`) 
            VALUES ('$create_item_name','$create_item_model','$brand_id','$create_branch_name','$create_item_price'
            ,'$date_today')";
            if($conn->query($sql) === true)
            {
                echo 1;
            }
            else
            {
                echo 4;
            }   
        }

        
        
    }
}

//update items in databse
function update_items()
{
    if(isset($_POST['update_insert_item']))
    {
        $conn = connection();
        $update_item_name = $_POST['update_item_name'];
        $update_item_model = $_POST['update_item_model'];
        $update_add_brand = $_POST['update_add_brand'];
        $update_add_brand = ucwords($update_add_brand);
        $update_item_price = $_POST['update_item_price'];
        $update_branch_name = $_POST['update_branch_name'];
        $item_id = $_POST['item_id'];
        $brand_id = 0;

        $sql = "INSERT INTO `brand` (`brand_name`) VALUES ('$update_add_brand')";
        $conn->query($sql);

        $sql = "SELECT * FROM `brand` WHERE `brand_name` = '$update_add_brand'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {   
            
            while($row = $result->fetch_assoc()) 
            {
                $brand_id = $row['brand_id'];
            }

           $sql = "UPDATE `items` SET `brand_id`='$brand_id',`item_name`='$update_item_name',
           `model_name`='$update_item_model',`price`='$update_item_price',`branch`='$update_branch_name'
           WHERE `item_id` = '$item_id'";
            if($conn->query($sql) === true)
            {
                echo 2;
            }
            else
            {
                echo 4;
            }   
        } 
        
    }
}

//delete item
function delete_item()
{
    if (isset($_POST['delete_item']))
    {
        $conn = connection();
        $item_id = $_POST['item_id'];

        $sql = "DELETE FROM `items` WHERE `item_id` = '$item_id'";
        $result = $conn->query($sql);

        if ($result === TRUE)
        {
            $confirmation = 3;
        }
        else
        {
            $confirmation = 4;
        }

        echo $confirmation;
    }
}

//function that if user is not main or branch admin page will be item-list only
function is_not_admin()
{
    if($_SESSION['user_type'] === 2 || $_SESSION['user_type'] === '2')
    {
        header("Location: ../item/item-list.php");
    }
}










?>