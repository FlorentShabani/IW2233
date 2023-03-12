jQuery(document).ready(function ($) {
  // Preload images
  var images = [];
  $('#slider ul li').each(function() {
    var img = new Image();
    img.src = $(this).find('img').attr('src');
    images.push(img);
  });
  
  setInterval(function () {
    $('#slider ul').animate({
      left: - slideWidth
    }, 700, function () {
      $('#slider ul li:first-child').appendTo('#slider ul');
      $('#slider ul').css('left', '');
    });
  }, 3000);
  
	var slideCount = $('#slider ul li').length;
	var slideWidth = $('#slider ul li').width();
	var slideHeight = $('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	
	$('#slider').css({ width: slideWidth, height: slideHeight });
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  $('#slider ul li:last-child').prependTo('#slider ul');
});