var table
var table_1
var item_value = ""

$(document).ready(function () {
    select_with_search_box()
    load_data_table_total_items()
    load_data_table_individual_items()
    $(".for_user").text(": "+branch)

    if (parseInt(user_type) != 0) {
        $(".for_main_admin_only").addClass("d-none") 

        if(parseInt(user_type) === 2)
        {
            $(".not_for_user_2").addClass("d-none")
        }
      }

      
})

//show data tables
function load_data_table_total_items() {
    var ajax_url = "../function/function.php";
    user_type = parseInt(user_type);
    if (!$.fn.DataTable.isDataTable('#total_items_table')) { // check if data table is already exist
        table = $('#total_items_table').DataTable({

            // "processing": true,
            "deferRender": true,
            "serverSide": true,
            "ajax": {
                url: ajax_url,
                data: {
                    total_item_list: 'set',
                    user_type: user_type,
                    branch: branch,
                },
                "dataSrc": function (json) {
                    //Make your callback here.
                    // console.log(json)
                    return json.data;
                }

            },
            "autoWidth": false,
            scrollCollapse: true,
            "dom": 'Brltip',
            "lengthMenu": [[5, 10, 20, 50], [5, 10, 20, 50]],


            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoFiltered": ""
            },

            "columns": [
                null,
                null,
                null,
                {
                    targets: 3,
                    render: function(data)
                    {
                        if(data === "Main")
                        {
                            return "<div class=''><span>MU Moto Main Branch</span></div>"
                        }
                        else
                        {
                            return "<div class=''><span>"+data+"</span></div>"
                        }
                        
                    }
                  },
                null,
                null,
            ],

            "buttons": [
                {
                    extend: 'copy',
                    text: ' COPY',

                    title: 'Total Item List',
                    messageTop: '',
                    //className: 'fa fa-solid fa-clipboard',


                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                        //columns: [0, 1] //r.broj kolone koja se stampa u PDF
                        columns: [0, 1,2,3,4,5],
                        // optional space between columns
                        columnGap: 1
                    }

                },
                {
                    extend: 'excel',
                    text: ' EXCEL',

                    title: 'Total Item List',
                    messageTop: '',
                    //className: 'fa fa-solid fa-clipboard',


                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                        //columns: [0, 1] //r.broj kolone koja se stampa u PDF
                        columns: [0, 1, 2, 3, 4, 5],
                        // optional space between columns
                        columnGap: 1
                    }

                },
                {
                    extend: 'print',
                    text: ' PDF',

                    title: 'Total Item List',
                    messageTop: '',
                    //className: 'fa fa-solid fa-clipboard',



                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                        //columns: [0, 1] //r.broj kolone koja se stampa u PDF
                        columns: [0, 1, 2, 3, 4, 5],
                        // optional space between columns
                        columnGap: 1
                    },

                    customize: function (doc) {
                        $(doc.document.body).find('h1').css('font-size', '15pt');
                        $(doc.document.body).find('h1').css('text-align', 'center');
                        $(doc.document.body).find('table').addClass("table-bordered")
                        $(doc.document.body).find('table').css('font-size', '15pt');
                        $(doc.document.body).find('table').css('width', '100%');
                        $(doc.document.body).css('text-align', 'center')
                    }
                }],
        });
        table.buttons().container().appendTo('#total_items_table_table_wrapper .col-md-6:eq(0)');

        $('#total_items_table #tf_1 td').each(function () {
            var title = this.id;

            if (title === "Quantity") {

                $(this).html('<input type="text" class="form-control  table_search rounded-1 w-100 shadow-sm py-0"  placeholder="' + title + '" aria-controls="hp_table">');
            }
            else {
                $(this).html('<input type="text" class="form-control table_search rounded-1 w-100 shadow-sm py-0"  placeholder="' + title + '" aria-controls="hp_table">');
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
    $("#total_items_table_wrapper").addClass("row");

    // Move and modify DataTables buttons for Table 1
    $("#total_items_table_wrapper .dt-buttons")
        .detach()
        .appendTo("#total_item_list_export_btn")
        .addClass("col-lg-2 col-md-12 mb-3 fw-bold text-white")
        .removeClass("flex-wrap")

    $("#total_items_table_wrapper .dataTables_length")
        .detach()
        .appendTo("#total_item_list_export_btn")
        .addClass("col-lg-10 text-lg-end text-center text-md-center text-sm-center col-md-12 mb-3");

    $("#total_items_table_wrapper .dataTables_info")
        .detach()
        .appendTo("#total_item_list_export_btn_table_page")
        .addClass("col-lg-6 col-md-12 text-lg-start text-center text-md-center text-sm-center");

    $("#total_items_table_wrapper .dataTables_paginate")
        .detach()
        .appendTo("#total_item_list_export_btn_table_page")
        .addClass("col-lg-6 d-flex justify-content-center justify-content-lg-end justify-content-md-center justify-content-sm-center");

    $("#total_items_table_wrapper .buttons-print, #total_items_table_wrapper .buttons-excel, #total_items_table_wrapper .buttons-copy").addClass("shadow-sm border-2");
    $("#total_items_table_wrapper .form-control, #total_items_table_wrapper .form-select").addClass("shadow-sm");


};

function load_data_table_individual_items() {
    var ajax_url = "../function/function.php";
    user_type = parseInt(user_type);
    if (!$.fn.DataTable.isDataTable('#individual_item_list_table')) { // check if data table is already exist
        table_1 = $('#individual_item_list_table').DataTable({

            // "processing": true,
            "deferRender": true,
            "serverSide": true,
            "ajax": {
                url: ajax_url,
                data: {
                    individual_item_list: 'set',
                    user_type: user_type,
                    branch: branch,
                },
                "dataSrc": function (json) {
                    //Make your callback here.
                    // console.log(json)
                    return json.data;
                }

            },
            "autoWidth": false,
            scrollCollapse: true,
            "dom": 'Brltip',
            "lengthMenu": [[5, 10, 20, 50], [5, 10, 20, 50]],

            //disable the sorting of colomn
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }],

            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoFiltered": ""
            },

            "columns": [
                null,
                null,
                null,
                {
                    targets: 3,
                    render: function(data)
                    {
                        if(data === "Main")
                        {
                            return "<div class=''><span>MU Moto Main Branch</span></div>"
                        }
                        else
                        {
                            return "<div class=''><span>"+data+"</span></div>"
                        }
                        
                    }
                  },
                null,
                null,
                {
                    targets: 6,
                    render: function (data) {
                    return "<div class='text-end px-3'> <i onclick = 'click_value(this.id), show_update_form()' class=' btn-success user_val btn shadow-sm align-middle show_update_form fas fa-edit'  id='update_user_btn " + data + "' role='button'></i> " +
                    "<i onclick = 'click_value(this.id), delete_item()' class='delete_resident_value user_val shadow-sm align-middle  btn btn-danger fa-solid fa-trash-can'  id='delete_user_btn " + data + "' role='button'></i>" +
                    "</div>"
                    }
                }
            ],

            "buttons": [
                {
                    extend: 'copy',
                    text: ' COPY',

                    title: 'Individual Item List',
                    messageTop: '',
                    //className: 'fa fa-solid fa-clipboard',


                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                        //columns: [0, 1] //r.broj kolone koja se stampa u PDF
                        columns: [0, 1, 2, 3, 4, 5],
                        // optional space between columns
                        columnGap: 1
                    }

                },
                {
                    extend: 'excel',
                    text: ' EXCEL',

                    title: 'Individual Item List',
                    messageTop: '',
                    //className: 'fa fa-solid fa-clipboard',


                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                        //columns: [0, 1] //r.broj kolone koja se stampa u PDF
                        columns: [0, 1, 2, 3, 4, 5],
                        // optional space between columns
                        columnGap: 1
                    }

                },
                {
                    extend: 'print',
                    text: ' PDF',

                    title: 'Individual Item List',
                    messageTop: '',
                    //className: 'fa fa-solid fa-clipboard',



                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                        //columns: [0, 1] //r.broj kolone koja se stampa u PDF
                        columns: [0, 1, 2, 3, 4, 5],
                        // optional space between columns
                        columnGap: 1
                    },

                    customize: function (doc) {
                        $(doc.document.body).find('h1').css('font-size', '15pt');
                        $(doc.document.body).find('h1').css('text-align', 'center');
                        $(doc.document.body).find('table').addClass("table-bordered")
                        $(doc.document.body).find('table').css('font-size', '15pt');
                        $(doc.document.body).find('table').css('width', '100%');
                        $(doc.document.body).css('text-align', 'center')
                    }
                }],
        });
        table_1.buttons().container().appendTo('#individual_item_list_table_wrapper .col-md-6:eq(0)');

        $('#individual_item_list_table #th_1 td').each(function () {
            var title = this.id;

            if (title === "Actions") {

                $(this).html('<div class="text-end me-2" ><span style = "color:#9eaaad; font-size:13px;" class="me-1"><span class="fa-solid me-2"></span>Actions</span></div>');
            }
            else {
                $(this).html('<input type="text" class="form-control table_search rounded-1 w-100 shadow-sm py-0"  placeholder="' + title + '" aria-controls="hp_table">');
            }

        });

        table_1.columns().every(function () {
            var table_1 = this;
            $('input', this.footer()).on('keyup change', function () {
                if (table_1.search() !== this.value) {
                    table_1.search(this.value).draw();
                }
            });
        });

    }

    //to align the data table buttons
    $("#individual_item_list_table_wrapper").addClass("row");

    // Move and modify DataTables buttons for Table 1
    $("#individual_item_list_table_wrapper .dt-buttons")
        .detach()
        .appendTo("#individual_item_list_export_btn")
        .addClass("col-lg-2 col-md-12 mb-3 fw-bold text-white")
        .removeClass("flex-wrap")

    $("#individual_item_list_table_wrapper .dataTables_length")
        .detach()
        .appendTo("#individual_item_list_export_btn")
        .addClass("col-lg-10 text-lg-end text-center text-md-center text-sm-center col-md-12 mb-3");

    $("#individual_item_list_table_wrapper .dataTables_info")
        .detach()
        .appendTo("#individual_item_list_export_btn_table_page")
        .addClass("col-lg-6 col-md-12 text-lg-start text-center text-md-center text-sm-center");

    $("#individual_item_list_table_wrapper .dataTables_paginate")
        .detach()
        .appendTo("#individual_item_list_export_btn_table_page")
        .addClass("col-lg-6 d-flex justify-content-center justify-content-lg-end justify-content-md-center justify-content-sm-center");

    $("#individual_item_list_table_wrapper .buttons-print, #individual_item_list_table_wrapper .buttons-excel, #individual_item_list_table_wrapper .buttons-copy").addClass("shadow-sm border-2");
    $("#individual_item_list_table_wrapper .form-control, #individual_item_list_table_wrapper .form-select").addClass("shadow-sm");

};

//get the id of user when table is clicked
function click_value(this_value)
{
  item_value = this_value.substr(this_value.indexOf(" ") + 1);
}

// get current date
function getCurrentDate() {
    var dateObj = new Date();
    var year = dateObj.getFullYear();
    var month = ('0' + (dateObj.getMonth() + 1)).slice(-2); // Adding 1 and padding with zero if needed
    var day = ('0' + dateObj.getDate()).slice(-2); // Padding with zero if needed
    var currentDate = year + '-' + month + '-' + day;
    return currentDate;
}

// submit new items
function insert_item()
{
    var date_today =  getCurrentDate();
    var create_item_name = $("#item_name").val()
    var create_item_model = $("#item_model").val()
    var create_add_brand = $("#add_brand").val()
    var create_item_price = $("#item_price").val()
    var create_branch_name = $("#branch").val()
    validator = true

    if (parseInt(user_type) != 0) {
        create_branch_name = branch
      }
    else
    {
        if (create_branch_name.trim().length === 0) {
            $("#branch").addClass("is-invalid")
            $(".branch").addClass("is-invalid")
            validator = false
          }
    }
    
    if (create_item_name.trim().length === 0) {
    $("#item_name").addClass("is-invalid")
    validator = false
    }

    if (create_item_model.trim().length === 0) {
    $("#item_model").addClass("is-invalid")
    validator = false
    }

    if (create_add_brand.trim().length === 0) {
        $("#add_brand").addClass("is-invalid")
        $(".add_brand").addClass("is-invalid")
    validator = false
    }

    if(create_add_brand === "Others")
    {
        create_add_brand = $("#alternative_brand").val()

        if (create_add_brand.trim().length === 0) {
            $("#alternative_brand").addClass("is-invalid")
        validator = false
        }
    }

    if (create_item_price.trim().length === 0) {
    $("#item_price").addClass("is-invalid")
    validator = false
    }


    if (validator === true) {

        $.post("../function/function.php", {
        submit_insert_user: 'set',
        date_today:date_today,
        create_item_name:create_item_name,
        create_item_model:create_item_model,
        create_add_brand:create_add_brand,
        create_item_price:create_item_price,
        create_branch_name:create_branch_name
        },
        function (data, status) {
            notice(data)
        });
    }
}

//submit update item
function update_item()
{
    var update_item_name = $("#update_item_name").val()
    var update_item_model = $("#update_item_model").val()
    var update_add_brand = $("#update_brand").val()
    var update_item_price = $("#update_item_price").val()
    var update_branch_name = $("#update_branch").val()
    validator = true
    var item_id = item_value

    if (parseInt(user_type) != 0) {
        update_branch_name = branch
      }
    else
    {
        if (update_branch_name.trim().length === 0) {
            $("#branch").addClass("is-invalid")
            $(".branch").addClass("is-invalid")
            validator = false
          }
    }
    
    if (update_item_name.trim().length === 0) {
    $("#update_item_name").addClass("is-invalid")
    validator = false
    }

    if (update_item_model.trim().length === 0) {
    $("#update_item_model").addClass("is-invalid")
    validator = false
    }

    if (update_add_brand.trim().length === 0) {
        $("#update_brand").addClass("is-invalid")
        $(".update_brand").addClass("is-invalid")
    validator = false
    }

    if(update_add_brand === "Others")
    {
        update_add_brand = $("#update_alternative_brand_container").val()

        if (update_add_brand.trim().length === 0) {
            $("#update_alternative_brand_container").addClass("is-invalid")
        validator = false
        }
    }

    if (update_item_price.trim().length === 0) {
    $("#update_item_price").addClass("is-invalid")
    validator = false
    }


    if (validator === true) {

        $.post("../function/function.php", {
        update_insert_item: 'set',
        update_item_name:update_item_name,
        update_item_model:update_item_model,
        update_add_brand:update_add_brand,
        update_item_price:update_item_price,
        update_branch_name:update_branch_name,
        item_id
        },
        function (data, status) {
            notice(data)
        });
    }
}

// for error and success message
function notice(data)
{
    var confirmation = parseInt(data);
    $("#confirmation_text").removeClass("bg-success")
    $("#confirmation_text").removeClass("bg-danger")
    if(confirmation === 1)
    {

        table.ajax.reload( null, false);
        table_1.ajax.reload( null, false);
        $("#new_item_form").addClass("d-none")
        $("#show_new_item_form").removeClass("d-none")
        $("#item_name").val("")
        $("#item_model").val("")
        $("#alternative_brand_container").val("")
        $("#item_price").val("")
        $("#add_brand").data('selectize').setValue("")
        $("#branch").data('selectize').setValue("")

        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-success")
        $("#confirmation_text").text("Item Added Successfully!")
        setTimeout(function(){
    
        $("#confirmation_container").addClass("d-none")
    
        },3000)
    }
    else if(confirmation === 2)
    {
        table.ajax.reload( null, false);
        table_1.ajax.reload( null, false);
        $("#update_item_form").addClass("d-none")
        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-success")
        $("#confirmation_text").text("Item Successfully Updated!")
        setTimeout(function(){
        $("#confirmation_container").addClass("d-none")
        },3000)
    }
    else if(confirmation === 3)
    {
        table.ajax.reload( null, false);
        table_1.ajax.reload( null, false);
        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-success")
        $("#confirmation_text").text("Item Deleted Successfully!")
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

//show update user form
function show_update_form()
{
    $("#update_item_form").removeClass("d-none")
}

//delete user
function delete_item()
{
    var item_id = item_value;
    $.post("../function/function.php", {
    delete_item: 'set',
    item_id: item_id,
    },
    function (data, status) {
      notice(parseInt(data))

    });
}


//close update new user
$("#cancel_update_item").click(function () {
$("#update_item_form").addClass("d-none")
})

//create new brand
$("#add_brand").change(function()
{
    if($(this).val()==="Others")
    {
        $("#alternative_brand_container").removeClass("d-none")
    }
    else
    {
        $("#alternative_brand_container").addClass("d-none")
    }
})

$("#update_brand").change(function()
{
    if($(this).val()==="Others")
    {
        $("#update_alternative_brand_container").removeClass("d-none")
    }
    else
    {
        $("#update_alternative_brand_container").addClass("d-none")
    }
})

//submit new item
$("#submit_new_item").click(function()
{
    insert_item()
})

//close adding new user
$("#cancel_add_new_item").click(function () {
    $("#new_item_form").addClass("d-none")
    $("#show_new_item_form").removeClass("d-none")
    $("#item_name").val("")
    $("#item_model").val("")
    $("#alternative_brand_container").val("")
    $("#item_price").val("")
    $("#add_brand").data('selectize').setValue("")
    $("#branch").data('selectize').setValue("")
})

//show  add new item form
$("#show_new_item_form").click(function()
{
    $("#new_item_form").removeClass("d-none")
    $("#show_new_item_form").addClass("d-none")
})

// get table index element
$("#individual_item_list_table").on('click', '.user_val', function () {
    // get the current row
    var currentRow = $(this).closest("tr");
    var col0 = currentRow.find("td:eq(0)").text().trim($(this).text()); // get current row 1st TD value
    var col1 = currentRow.find("td:eq(1)").text().trim($(this).text()); // get current row 1st TD value
    var col2 = currentRow.find("td:eq(2)").text().trim($(this).text()); // get current row 1st TD value
    var col3 = currentRow.find("td:eq(3)").text().trim($(this).text()); // get current row 1st TD value
    var col4 = currentRow.find("td:eq(4)").text().trim($(this).text()); // get current row 1st TD value
    var col5 = currentRow.find("td:eq(5)").text().trim($(this).text()); // get current row 1st TD value
  
  
    if (col3 === "MU Moto Main Branch") {
      col3 = "Main"
    }

    $('#update_branch').data('selectize').setValue(col3);
    $('#update_item_name').val(col0);
    $('#update_item_model').val(col2);
    $('#update_brand').data('selectize').setValue(col1);
    $('#update_item_price').val(col4);;

  
  
  });

//submit update item
$("#submit_update_item").click(function()
{
    update_item()
})


