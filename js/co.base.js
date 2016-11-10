co_base = (function() {
  function onClick_navLink(event) {
    $(".navbar-collapse").collapse("hide");
  }
  function onReady(event) {
    $(".nav > li > a").on("click", onClick_navLink);
  }
  $(document).ready(onReady);
  return {};
})();
