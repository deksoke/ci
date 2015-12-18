$(function () {
   SetMenuBarActive();
});

function SetMenuBarActive(){
   var menus = $('.navbar-nav li');
   var results = menus.filter(function () { return $(this).find('a').attr('href') == location.href });
   try {
      menus.removeClass('active');
      if (results.length > 0) {
         results.addClass('active');
      }
   } catch (e) {
      console.log('initial menubar error!');
      console.log(e);
   }
}