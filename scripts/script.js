$("#resetPassword").click(function(ev){
  if(confirm("Are you sure you want to change your password?")){
  }
  else{
    ev.preventDefault();
  }
});

$("#resetEmail").click(function(ev){
  if(confirm("Are you sure you want to change your password?")){
  }
  else{
    ev.preventDefault();
  }
});

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
