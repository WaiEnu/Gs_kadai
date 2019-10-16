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

  $('.multiple').slick({
    autoplay: true, //自動再生
    infinite: true, //スライドのループ有効化
    dots: true, //ドットのナビゲーションを表示
    slidesToShow: 3, //表示するスライドの数
    slidesToScroll: 4, //スクロールで切り替わるスライドの数
    responsive: [{
      breakpoint: 768, //ブレークポイントが768px
      settings: {
        slidesToShow: 3, //表示するスライドの数
        slidesToScroll: 3, //スクロールで切り替わるスライドの数
      }
    }, {
      breakpoint: 699, //ブレークポイントが480px
      settings: {
        slidesToShow: 1, //表示するスライドの数
        slidesToScroll: 2, //スクロールで切り替わるスライドの数
      }
    }]
  });
});