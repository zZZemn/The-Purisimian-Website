$(document).ready(function () {
  let isNavOpen = false;

  $("#navButton").click(function (e) {
    e.preventDefault();
    console.log("clicked");
    if (isNavOpen) {
      $(".nav-ul").css("transform", "translateX(-100%)");
      $("#navButtonIcon").removeClass("fa-x");
      $("#navButtonIcon").addClass("fa-bars");
    } else {
      $(".nav-ul").css("transform", "translateX(0)");
      $("#navButtonIcon").removeClass("fa-bars");
      $("#navButtonIcon").addClass("fa-x");
    }
    isNavOpen = !isNavOpen;
  });
});
