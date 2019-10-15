// jsを記述する際はここに記載していく

$(function() {
  $(".matchHeight").matchHeight();

	var loader = $('.loader-wrap');

	$(window).on('load',function(){
		loader.fadeOut();
	});

	setTimeout(function(){
		loader.fadeOut();
	},3000);

  $("#spMenu").on("click", function() {
    $(this)
      .next()
      .slideToggle();
  });

  $(".js-modal-open").on("click", function() {
    $(".js-modal").fadeIn();
    return false;
  });
  $(".js-modal-close").on("click", function() {
    $(".js-modal").fadeOut();
    return false;
  });
  $('input[type="submit"]').on("click", function() {
    $(".question").html('<p style="font-size: 0.65rem;">ググレ</p>');
    location.href = "https://www.google.com/";
    return false;
  });

});