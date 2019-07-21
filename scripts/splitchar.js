/**
 * Splitchar.js
 * @author emisfera - Razvan B.
 Email: balosinrazvan@yahoo.com
GitHub: https://github.com/razvanbalosin
Work: FrontEnd Developer
https://github.com/razvanbalosin/Splitchar.js
 */


$.fn.splitchar = function () {
  $('.splitchar').each(function (index) {
    var $main = $(this);
    var characters = $main.text().split('');
    $main.empty();
    $.each(characters, function (i, el) {
      var type = $main.attr('class');
      $main.append("<span class='" + type + "' data-content='" + el + "'>" + el + "</span>");
    });
  });
};
$(document).ready(function(){
    $(".splitchar").splitchar();
});
