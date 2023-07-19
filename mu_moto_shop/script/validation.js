if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );} // stop resubmission
var validator = true

$(document).ready(function()
{
    notice()

    if ($('title').text() === "Sign-up Page")
    {
        selectize_func()
    }
   
})

// validate the login inputs
function login()
{
    var username = $("#username").val()
    var password = $("#password").val()
    validator = true

    if(username.trim().length === 0)
    {
        $("#username").addClass("is-invalid")
        validator = false
    }

    if(password.trim().length === 0)
    {
        $("#password").addClass("is-invalid")
        validator = false
    }

    if(validator === true)
    {
        $("#sign_in").prop("type", "submit");
    }
}

// validate registration
function register()
{
    var username = $("#create_username").val()
    var branch = $("#branch").val()
    var password = $("#create_password").val()
    var confirm_password = $("#confirm_password").val()
    validator = true;

    console.log(branch)


    if(username.trim().length === 0)
    {
        $("#create_username").addClass("is-invalid")
        validator = false
    }

    if(password.trim().length === 0)
    {
        $("#create_password").addClass("is-invalid")
        validator = false
    }

    if(confirm_password.trim().length === 0)
    {
        $("#confirm_password").addClass("is-invalid")
        $(".for_confirm_password").text("Invalid password confirmation!")
        validator = false
    }

    if(confirm_password != password)
    {
        $("#confirm_password").addClass("is-invalid")
        $(".for_confirm_password").text("Password and password confirmation doesn't match!")
        validator = false
    }

    if(branch.trim().length === 0)
    {
        $("#branch").addClass("is-invalid")
        $(".selectize-control").addClass("is-invalid")
        validator = false
    }

    if(validator === true)
    {
        $("#crea_account").prop("type", "submit");
    }
}

// for select dropdown list
function selectize_func()
{
$('select').selectize({
sortField: 'text'
});
}

// for error and success message
function notice()
{

    
    if(confirmation === 1)
    {
        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-success")
        $("#confirmation_text").text("Registered Successfully!")
        setTimeout(function(){
    
        $("#confirmation_container").addClass("d-none")
    
        },3000)
    }
    else if(confirmation === 2)
    {
        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-danger")
        $("#confirmation_text").text("Username Already Exist!")
        setTimeout(function(){
        
        $("#confirmation_container").addClass("d-none")
    
        },3000)
    }
    else if(confirmation === 3)
    {
        $("#confirmation_container").removeClass("d-none")
        $("#confirmation_text").addClass("bg-danger")
        $("#confirmation_text").text("Invalid username or password!")
        setTimeout(function(){
        
        $("#confirmation_container").addClass("d-none")
    
        },3000)
    }
}

// sign in submit trigger
$("#sign_in").click(function(){
    login()
 })

// create account submit trigger
$("#crea_account").click(function(){
    register()
})

//remove the invalid label message of inputs
$("#username").keyup(function()
{
    if ($("#username").val().trim().length != 0) {
        $("#username").removeClass("is-invalid")
    }
})
$("#password").keyup(function () {

    if ($("#password").val().trim().length != 0) {
        $("#password").removeClass("is-invalid")
    }
})
$("#create_username").keyup(function () {

    if ($("#create_username").val().trim().length != 0) {
        $("#create_username").removeClass("is-invalid")
    }
})
$("#create_password").keyup(function () {

    if ($("#create_password").val().trim().length != 0) {
        $("#create_password").removeClass("is-invalid")
    }
})
$("#confirm_password").keyup(function () {

    if ($("#confirm_password").val().trim().length != 0) {
        $("#confirm_password").removeClass("is-invalid")
    }
})
$("#branch").change(function () {

    if ($("#branch").val().trim().length != 0) {
        $("#branch").removeClass("is-invalid")
        $(".selectize-control").removeClass("is-invalid")
    }
})


