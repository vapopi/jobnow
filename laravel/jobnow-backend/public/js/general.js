var arr = ["/images/black_logo.png", "/images/blue_logo.png","/images/pink_logo.png","/images/brown_logo.png","/images/purple_logo.png", "/images/blue_logo.png", "/images/green_logo.png"];

function getRandomImage() {
  var index = Math.floor(Math.random() * arr.length);
  return arr[index];
}

$("#logo").hover(
  function() {
    var image = getRandomImage();
    $("#img").attr("src", image);
});

$(document).ready(function () {

  $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });
  
});