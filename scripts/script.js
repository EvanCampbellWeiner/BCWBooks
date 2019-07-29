//Page Name: script.js
//Programmer's Name: Evan Campbell-Weiner and Alan Michael-Bradshaw
//Description: Used to style many of the forms and provide validation, alerts, etc.

//Used to confirm that someone wants to change their password
$("#resetPassword").click(function(ev){
  if(confirm("Are you sure you want to change your password?")){
  }
  else{
    ev.preventDefault();
  }
});
//Used to confirm that someone wants to change their email
$("#resetEmail").click(function(ev){
  if(confirm("Are you sure you want to change your email?")){
  }
  else{
    ev.preventDefault();
  }
});

//Used on any field that is required, when it is focused out,
//highlighting red if it is empty.
$(".required").on("focusout",function(ev){
  if($(".required").val()=="")
  {
    $(".required").addClass("empty").delay(1000).queue(function(next)
    {
      $(".required").removeClass("empty");
      next();
    });
  }
});

//When submitting, if a value isn't entered that is required
//it will prevent the page from doing its default, and highlight
//places where the required wasn't chosen
$("#submit").on("click",function(ev){
  if($(".required").val()==""){
    $(".required").addClass("empty").delay(1000).queue(function(next)
    {
      $(".required").removeClass("empty");
      next();
    });
    ev.preventDefault();
  }
})

//used to check if an email has already been entered
let valid = true;
$(".registeremail").on("focusout", function(ev) {
//.get and .fail are on same line
//you call .get and then use function to actually do stuff based on what was returned from php
  $.get(
    "checkemail.php", {
      email: $("#email").val()
    },
    function(data) {
      $("#emailerror").remove();
      if (data == 'true') {
        $("form > div:first-child").after("<div id='emailerror' class='error'>Error: Email is already in use</div>")
        valid = false;
      }

    }

  )
  .fail(function(jqXHR, textStatus, errorThrown) {
    $("main").prepend("<span>" + jqXHR.responseText + "</span>");
    valid = false;
  });
});
