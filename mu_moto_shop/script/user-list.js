if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); }
var user_value = "";
var prev_branch_val = "";
var prev_usertype_val = "";
var table
var admin = user_id
$(document).ready(function () {
    select_with_search_box()
    load_data_tables()

  if (parseInt(user_type) != 0) {

    var hide_update_user_type = $('#update_user_type').selectize();
    var hide_update_user_type_instance = hide_update_user_type[0].selectize;
    var hide_update_user_type_value_to_hide = "0";
    hide_update_user_type_instance.removeOption(hide_update_user_type_value_to_hide);


    var hide_add_user_type = $('#add_user_type').selectize();
    var hide_add_user_type_instance = hide_add_user_type[0].selectize;
    var hide_add_user_type_value_to_hide = "0";
    hide_add_user_type_instance.removeOption(hide_add_user_type_value_to_hide);
    $(".for_main_admin_only").addClass("d-none")
  }
})

//show data tables
function load_data_tables() {
    var ajax_url = "../function/function.php";
    user_type = parseInt(user_type);
  if ( ! $.fn.DataTable.isDataTable( '#user_list_table' ) ) { // check if data table is already exist
  table = $('#user_list_table').DataTable({
  
    // "processing": true,
    "deferRender": true,
    "serverSide": true,
    "ajax": {
      url: ajax_url,
      data: {
        user_list:'set',
        user_type: user_type,
        branch: branch,
        user_id:user_id
      },
      "dataSrc": function ( json ) {
        //Make your callback here.
       // console.log(json)
        return json.data;
    }      
    
  },
    "autoWidth": false,
    scrollCollapse: true,
    "dom": 'Brltip',     
    "lengthMenu": [[5,10,20,50], [5,10,20,50]],
  
    //disable the sorting of colomn
    "columnDefs": [ {
      "targets": 3,
      "orderable": false
      } ],
  
      "language": {
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "infoFiltered":""
      },
  
    "columns": [
      null,
      {
        targets: 1,
        render: function(data)
        {
            if(parseInt(data) === 0)
            {
                return "<div class='text-center'><span>Main Admin</span></div>"
            }
            else if (parseInt(data) === 1)
            {
                return "<div class='text-center'><span>Branch Admin</span></div>"
            }
            else
            {
                return "<div class='text-center'><span>User</span></div>"
            }
            
        }
      },
      {
        targets: 2,
        render: function(data)
        {
            if(data === "Main")
            {
                return "<div class='text-center'><span>MU Moto Main Branch</span></div>"
            }
            else
            {
                return "<div class='text-center'><span>"+data+"</span></div>"
            }
            
        }
      },
      {
        targets: 3,
        render: function(data)
        {
          return "<div class='text-end px-3'> <i onclick = 'click_value(this.id), show_update_form()' class=' btn-success user_val btn shadow-sm align-middle show_update_form fas fa-edit'  id='update_user_btn "+data+"' role='button'></i> "+
          "<i onclick = 'click_value(this.id), delete_user()' class='delete_resident_value user_val shadow-sm align-middle  btn btn-danger fa-solid fa-trash-can'  id='delete_user_btn "+data+"' role='button'></i>"+
          "</div>"
        }
  
      }
    ],
  
  "buttons": [
    {
        extend: 'copy',
        text: ' COPY',
  
        title: 'User List',
        messageTop: '',
        //className: 'fa fa-solid fa-clipboard',
        
  
        exportOptions: {
        modifier: {
            page: 'current'
        },
          //columns: [0, 1] //r.broj kolone koja se stampa u PDF
          columns: [0,1],
          // optional space between columns
          columnGap: 1
        }
  
    },
    { 
        extend: 'excel',
        text: ' EXCEL',
  
        title: 'User List',
        messageTop: '',
        //className: 'fa fa-solid fa-clipboard',
        
  
        exportOptions: {
        modifier: {
            page: 'current'
        },
          //columns: [0, 1] //r.broj kolone koja se stampa u PDF
          columns: [0,1],
          // optional space between columns
          columnGap: 1
        }
  
    },
    {
        extend: 'print',
        text: ' PDF',
  
        title: 'User List',
        messageTop: '',
        //className: 'fa fa-solid fa-clipboard',

        
  
        exportOptions: {
        modifier: {
            page: 'current'
        },
          //columns: [0, 1] //r.broj kolone koja se stampa u PDF
          columns: [0,1],
          // optional space between columns
          columnGap: 1
        },
  
        customize: function ( doc ) {
          $(doc.document.body).find('h1').css('font-size', '15pt');
          $(doc.document.body).find('h1').css('text-align', 'center'); 
          $(doc.document.body).find('table').addClass("table-bordered")
          $(doc.document.body).find('table').css('font-size', '15pt');
          $(doc.document.body).find('table').css('width', '100%');
          $(doc.document.body).css('text-align', 'center')
        }
    }],
  });
  table.buttons().container().appendTo('#user_list_table_wrapper .col-md-6:eq(0)');
  
  $('#user_list_table #th_1 td').each(function () {
    var title = this.id;
  
    if(title === "Actions" )
    {
    
      $(this).html('<div class="text-end me-2" ><span style = "color:#9eaaad; font-size:13px;" class="me-1"><span class="fa-solid me-2"></span>Actions</span></div>');
    }
    else if (title === "Branch" )
    {
        $(this).html('<input type="text" class="form-control text-center table_search rounded-1 w-100 shadow-sm py-0"  placeholder="'+title+'" aria-controls="hp_table">');
    }
    else if (title === "User Type") {
      $(this).html('<input type="text" class="form-control text-center table_search rounded-1 w-100 shadow-sm py-0"  placeholder="' + title + '" aria-controls="hp_table">');
    }
    else
    {
      $(this).html('<input type="text" class="form-control table_search rounded-1 w-100 shadow-sm py-0"  placeholder="'+title+'" aria-controls="hp_table">');
    }
  
  });
  
  table.columns().every(function () {
    var table = this;
    $('input', this.footer()).on('keyup change', function () {
        if (table.search() !== this.value) {
            table.search(this.value).draw();
        }
    });
  });
    
  }
  //to align the data table buttons
  $("#user_list_table_wrapper").addClass("row");
  
  $(".dt-buttons").detach().appendTo('#buttons') 
    $(".dt-buttons").addClass("col-lg-2 col-md-12 mb-3 fw-bold text-white"); 
    $(".dt-buttons").removeClass("flex-wrap");
  
    $(".dataTables_length").detach().appendTo('#buttons')
    $(".dataTables_length").addClass("col-lg-10 text-lg-end text-center text-md-center text-sm-center col-md-12 mb-3");
    
    $(".dataTables_info").detach().appendTo('#table_page')
    $(".dataTables_info").addClass("col-lg-6 col-md-12 text-lg-start text-center text-md-center text-sm-center")
  
    $(".dataTables_paginate ").detach().appendTo('#table_page')
    $(".dataTables_paginate ").addClass("col-lg-6 d-flex justify-content-center justify-content-lg-end justify-content-md-center justify-content-sm-center ")
  
    $(".buttons-print").addClass("shadow-sm border-2 "); 
    $(".buttons-excel").addClass("shadow-sm border-2 "); 
    $(".buttons-copy").addClass("shadow-sm border-2 "); 
  
    $(".form-control").addClass("shadow-sm");
    $(".form-select").addClass("shadow-sm");
  
  
  };

//get the id of user when table is clicked
function click_value(this_value)
{
  user_value = this_value.substr(this_value.indexOf(" ") + 1);
}

//show update user form
function show_update_form()
{
    $("#update_this_user_form").removeClass("d-none")
}

// for select
function select_with_search_box()
{
$('select').selectize({
// maxItems: '1',
sortField: 'text'
});
$(".selectize-control").removeClass("form-control barangay-form")
}

// validate update form
function update()
{
    var updated_branch = $("#update_branch").val()
    var updated_user_type = $("#update_user_type").val()
    var user_id = user_value
    validator = true;

    if(updated_branch.trim().length === 0)
    {
        $("#update_branch").addClass("is-invalid")
        $(".update_branch").addClass("is-invalid")
        validator = false
    }

    if(updated_user_type.trim().length === 0)
    {
        $("#update_user_type").addClass("is-invalid")
        $(".update_user_type").addClass("is-invalid")
        validator = false
    }

    if(parseInt(user_value) === parseInt(admin))
    {
      validator = false
      notice(6)
    }

    if(validator === true)
    {
      $.post("../function/function.php", {
      submit_updated_user: 'set',
      user_id: user_id,
      updated_user_type: updated_user_type,
      updated_branch: updated_branch,
      },
      function (data, status) {
        notice(parseInt(data))
        
      });
    }
}

//validate created user detail
function create()
{
  var create_branch
  var create_username = $("#create_user_name").val()
  var create_password = $("#create_user_password").val()
  var create_user_type = $("#add_user_type").val()
  validator = true;

  if (create_username.trim().length === 0) {
    $("#create_user_name").addClass("is-invalid")
    validator = false
  }

  if (create_password.trim().length === 0) {
    $("#create_user_password").addClass("is-invalid")
    validator = false
  }

  if (create_user_type.trim().length === 0) {
    $("#add_user_type").addClass("is-invalid")
    $(".add_user_type").addClass("is-invalid")
    validator = false
  }

  if (parseInt(user_type) === 0)
  {
    create_branch = $("#branch").val()
    if (create_branch.trim().length === 0) {
      $("#branch").addClass("is-invalid")
      $(".branch").addClass("is-invalid")
      validator = false
    }

  }
  else
  {
    create_branch = branch;
  }

  if (validator === true) {
    $.post("../function/function.php", {
      submit_create_user: 'set',
      create_branch: create_branch,
      create_username: create_username,
      create_password: create_password,
      create_user_type: create_user_type,
    },
      function (data, status) {
        notice(parseInt(data))
      });
  }


 
}

//delete user
function delete_user()
{
   validator = true
  if(parseInt(user_value) === parseInt(admin))
  {
    validator = false
    notice(6)
  }
  

  if(validator === true)
  {

    var user_id = user_value;
    $.post("../function/function.php", {
    delete_user: 'set',
    user_id: user_id,
    },
    function (data, status) {
      notice(parseInt(data))

    });

  }

   
}

// for error and success message
function notice(data)
{
    confirmation = data
    $("#confirmation_text").removeClass("bg-success")
    $("#confirmation_text").removeClass("bg-danger")
    if(confirmation === 1)
    {

        table.ajax.reload(null, false);
        $("#new_user_form").addClass("d-none")
        $("#show_new_user_form").removeClass("d-none")
        $("#create_user_name").val("")
        $("#create_user_password").val("")
        $("#add_user_type").data('selectize').setValue("")
        $("#branch").data('selectize').setValue("")

        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-success")
        $("#confirmation_text").text("User Added Successfully!")
        setTimeout(function(){
    
        $("#confirmation_container").addClass("d-none")
    
        },3000)
    }
    else if(confirmation === 2)
    {
        $("#confirmation_container").removeClass("d-none")
        table.ajax.reload( null, false);
        $("#update_this_user_form").addClass("d-none")
        $("#confirmation_text").addClass("bg-success")
        $("#confirmation_text").text("User Successfully Updated!")
        setTimeout(function(){
        $("#confirmation_container").addClass("d-none")
        },3000)
    }
    else if(confirmation === 3)
    {
        table.ajax.reload(null, false);
        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-success")
        $("#confirmation_text").text("User Deleted Successfully!")
        setTimeout(function(){
        
        $("#confirmation_container").addClass("d-none")
    
        },3000)
    }
    else if(confirmation === 4)
    {
        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-danger")
        $("#confirmation_text").text("Something Went Wrong, Try again!")
        setTimeout(function(){
        
        $("#confirmation_container").addClass("d-none")
    
        },3000)
    }
    else if (confirmation === 5) {
      $("#confirmation_container").removeClass("d-none")
      $("#confirmation_text").addClass("bg-danger")
      $("#confirmation_text").text("Username already exist!")
      setTimeout(function () {

        $("#confirmation_container").addClass("d-none")

      }, 3000)
    }

    else if (confirmation === 6) {
      $("#confirmation_container").removeClass("d-none")
      $("#confirmation_text").addClass("bg-danger")
      $("#confirmation_text").text("You can't modify or delete your own account!")
      setTimeout(function () {

        $("#confirmation_container").addClass("d-none")

      }, 3000)
    }
}

//function for adding new user
$("#show_new_user_form").click(function () {

  $("#new_user_form").removeClass("d-none")
  $("#show_new_user_form").addClass("d-none")

})

//close adding new user
$("#cancel_add_new_user").click(function () {
  $("#new_user_form").addClass("d-none")
  $("#show_new_user_form").removeClass("d-none")
  $("#create_user_name").val("")
  $("#create_user_password").val("")
  $("#add_user_type").data('selectize').setValue("")
  $("#branch").data('selectize').setValue("")
})

//close update new user
$("#cancel_update_user").click(function () {
  $("#update_this_user_form").addClass("d-none")
})

// get table index element
$("#user_list_table").on('click', '.user_val', function () {
  // get the current row
  var currentRow = $(this).closest("tr");
  var col0 = currentRow.find("td:eq(0)").text().trim($(this).text()); // get current row 1st TD value
  var col1 = currentRow.find("td:eq(1)").text().trim($(this).text()); // get current row 1st TD value
  var col2 = currentRow.find("td:eq(2)").text().trim($(this).text()); // get current row 1st TD value
  var col3 = currentRow.find("td:eq(3)").text().trim($(this).text()); // get current row 1st TD value


  if (col2 === "MU Moto Main Branch") {
    col2 = "Main"
  }
  prev_branch_val = col2
  $('#update_branch').data('selectize').setValue(col2);
  if (col1 === "Main Admin") {
    col1 = 0
  }
  else if (col1 === "Branch Admin") {
    col1 = 1
  }
  else if (col1 === "User") {
    col1 = 2
  }
  prev_usertype_val = col1
  $('#update_user_type').data('selectize').setValue(col1);


});

//submit update user details
$("#submit_update_user").click(function () {
  update()
})

//submit newly created user
$("#submit_new_user").click(function()
{
  create()
})

// to set the user type as a main admin if branch is main
$("#update_user_type").change(function () {

  var user_type_value = parseInt($(this).val())

  if ($("#update_user_type").val().trim().length != 0) {
    $("#update_user_type").removeClass("is-invalid")
    $(".update_user_type").removeClass("is-invalid")
  }

  if (user_type_value === 0)
  {
    if ($("#update_branch").val() != "Main")
    {
      $("#update_branch").data('selectize').setValue("Main");
    }
    
  }
  else
  {
    if ($("#update_branch").val() === "Main" && $("#update_branch").val() != prev_branch_val )
    {
      $("#update_branch").data('selectize').setValue(prev_branch_val);
    }
    else if(prev_branch_val === "Main") {

      if ($("#update_branch").val() === "Main")
      {
        $("#update_branch").data('selectize').setValue("");
      }
      
    }
    
  }
  
});

// to set the main branch as a main  if the user type is main admin
$("#update_branch").change(function () {
  var update_branch_value = $("#update_branch").val()

  if ($("#update_branch").val().trim().length != 0) {
    $("#update_branch").removeClass("is-invalid")
    $(".update_branch").removeClass("is-invalid")
  }

  if (update_branch_value === "Main") {
    if ($("#update_user_type").val()!="0")
    {
      $("#update_user_type").data('selectize').setValue("0");
    }
  }
  else {
    if ($("#update_user_type").val() === "0" && $("#update_user_type").val() != prev_usertype_val)
    {
      $("#update_user_type").data('selectize').setValue(prev_usertype_val);
    }
    else if (prev_usertype_val === 0) {

      if ($("#update_user_type").val() === "0")
      {
        $("#update_user_type").data('selectize').setValue("");
      }
      
    }
    
  }

});

//remove the invalid label message of inputs
$("#create_user_name").keyup(function()
{
  if ($("#create_user_name").val().trim().length != 0) {
    $("#create_user_name").removeClass("is-invalid")

  }
})
$("#create_user_password").keyup(function () {
  if ($("#create_user_password").val().trim().length != 0) {
    $("#create_user_password").removeClass("is-invalid")

  }
})
$("#add_user_type").change(function () {
  if ($("#add_user_type").val().trim().length != 0) {
    $("#add_user_type").removeClass("is-invalid")
    $(".add_user_type").removeClass("is-invalid")
  }

  var add_user_type = parseInt($(this).val())

  if (add_user_type === 0 && $("#branch").val() != "Main")
  {
    $("#branch").data('selectize').setValue("Main");
  }
  else if (add_user_type != 0 && $("#branch").val() === "Main")
  {
    $("#branch").data('selectize').setValue("");
  }
})
$("#branch").change(function () {

  if ($("#branch").val().trim().length != 0) {
    $("#branch").removeClass("is-invalid")
    $(".branch").removeClass("is-invalid")
  }

  var add_branch = $(this).val()

  if (add_branch === "Main" && $("#add_user_type").val() != "0") {
    $("#add_user_type").data('selectize').setValue("0");
  }
  else if (add_branch != "Main" && $("#add_user_type").val() === "0") {
    $("#add_user_type").data('selectize').setValue("");
  }
})
