$(document).ready(function(){ 
  // function auto scroll
  $("html, body").animate(
    {
      scrollTop: $(document).height(),
    },
    50000
  );
  
  setTimeout(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      50000
    );
  }, 50000); 
  
  addEventListener("click", function () {
    var el = document.documentElement,
      rfs =
        el.requestFullscreen ||
        el.webkitRequestFullScreen ||
        el.mozRequestFullScreen ||
        el.msRequestFullscreen;
  
    rfs.call(el);
  });
  
 
   
  
  setTimeout(function() {
    window.location.reload()
  }, 100000)
});
