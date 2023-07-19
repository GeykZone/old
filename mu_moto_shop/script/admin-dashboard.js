if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } // stop resubmission

var current_month = getCurrentDate()
var past_month = getPastMonth(new Date(current_month))
var total_items_for_this_month = parseInt(total_item_count_for_this_month())
var users_total = parseInt(total_number_of_registered_users())

$(document).ready(function () {
    $(".one_month_from").text(date_into_words(past_month))
    $(".one_month_to").text(date_into_words(current_month))
    $("#item_count").text(total_items_for_this_month)
    $("#user_count").text(users_total)
    admin_type()
    load_data_tables()
})

// get current date
function getCurrentDate() {
    var dateObj = new Date();
    var year = dateObj.getFullYear();
    var month = ('0' + (dateObj.getMonth() + 1)).slice(-2); // Adding 1 and padding with zero if needed
    var day = ('0' + dateObj.getDate()).slice(-2); // Padding with zero if needed
    var currentDate = year + '-' + month + '-' + day;
    return currentDate;
}

// the last month date
function getPastMonth(date) {
    // Get the current date
    var currentDate = date;

    // Subtract one month from the current date
    currentDate.setMonth(currentDate.getMonth() - 1);

    // Get the components of the new date
    var pastMonth = currentDate.getMonth() + 1; // Month is zero-based, so add 1
    var pastYear = currentDate.getFullYear();
    var pastDay = currentDate.getDate();

    // Format the date as desired
    var formattedDate = pastYear + "-" + (pastMonth < 10 ? "0" : "") + pastMonth + "-" + (pastDay < 10 ? "0" : "") + pastDay;

    return formattedDate
}

// convert date format into words format
function date_into_words(data) {
    var dateObj = new Date(data);
    var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var month = monthNames[dateObj.getMonth()];
    var day = dateObj.getDate();
    var year = dateObj.getFullYear();
    var currentDate = month + ' ' + day + ', ' + year;
    return currentDate;
}

// turn small letters into captal for display
function capitalize_small_letter(word)
{
    var inputText = word;
    var capitalizedText = inputText.charAt(0).toUpperCase() + inputText.slice(1);

    return capitalizedText

}

//validate what type of admin a user is
function admin_type()
{

    $("#user_name").text(user_name.toUpperCase())

    if(branch === "Main")
    {
        $("#branch_name").text("MU MOTO SERVICES")
        $("#all_user_label").text("All Registered Users")
    }
    else if (branch === "MU-Oroq Moto Services")
    {
        $("#branch_name").text("MU-OROQ MOTO SERVICES")
        $("#all_user_label").text("MU-Oroq Moto Services Users.")
    }
    else if (branch === "MU-Tang Moto Services") {

        $("#branch_name").text("MU-TANG MOTO SERVICES")
        $("#all_user_label").text("MU-Tang Moto Services Users.")
    }
    else if (branch === "MU-Oz Moto Services") {
        $("#branch_name").text("MU-OZ MOTO SERVICES")
        $("#all_user_label").text("MU-Oz Moto Services Users.")
    }

    if(parseInt(user_type) === 0)
    {
        $("#admin_user_of").text("MAIN ADMIN")
    }
    else if (parseInt(user_type) === 1) {   
        $("#admin_user_of").text("BRANCH ADMIN")
    }

}

//get the total number of item in one month span
function total_item_count_for_this_month() {
    var total_item_count_for_this_month;
    user_type = parseInt(user_type);
    $.ajaxSetup({ async: false });
    $.getJSON('../function/function.php',
        {
            total_item_for_this_month: 'set',
            start: past_month,
            end: current_month,
            user_type: user_type,
            branch: branch
        },
        function (data, textStatus, jqXHR) {
            total_item_count_for_this_month = data;
        });
        

    return total_item_count_for_this_month
}

//get the total number of registered users
function total_number_of_registered_users()
{
    var total_number_of_users;
    user_type = parseInt(user_type);
    $.ajaxSetup({ async: false });
    $.getJSON('../function/function.php',
        {
            total_number_of_users: 'set',
            user_type: user_type,
            branch: branch
        },
        function (data, textStatus, jqXHR) {
            total_number_of_users = data;
        });


    return total_number_of_users
}

//show data tables
function load_data_tables() {
    var ajax_url = "../function/function.php";
    user_type = parseInt(user_type);

    if (!$.fn.DataTable.isDataTable('#item_list_table_in_dashboard')) { // check if data table is already exist

        table = $('#item_list_table_in_dashboard').DataTable({

            // "processing": true,
            "deferRender": true,
            "serverSide": true,
            "ajax": {
                url: ajax_url,
                data: {

                    item_lists:'set',
                    last_month: past_month,
                    current_month: current_month,
                    user_type: user_type,
                    branch: branch
                   
                },
                "dataSrc": function (json) {
                    
                    return json.data;       
                }

            },
            "autoWidth": false,
            scrollCollapse: true,
            "dom": 'tip',
            "lengthMenu": [[4, 10, 50], [4, 10, 50]],

            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoFiltered": ""
            },

            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
            ],
        });
        table.buttons().container().appendTo('#item_table_wrapper .col-md-6:eq(0)');

    }
    //to align the data table buttons
};
//show data tables end


// trigger logout
$("#logout").click(function () {

    $("#logout").prop("type", "submit");

})