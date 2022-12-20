$(function() { 

	$('ul.nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
	});

    
});


$("#subs").click(function(){
var email = $('#email').val();
  $.post('functions.php?opt=subcription', {email: email}, function(data, textStatus, xhr) {
    setTimeout(function(){

        $("#resp").html(data);

      }, 1000);
  });
});


$(document).ready(function() {


    if ($(window).scrollTop() > 120) {
        $('#nav_bar').addClass('navbar-fixed-top');
        $('.go-top').show();
    }
    if ($(window).scrollTop() < 121) {
        $('#nav_bar').removeClass('navbar-fixed-top');
        $('.go-top').hide();
    }


  $(window).scroll(function () {
      console.log($(window).scrollTop())
    if ($(window).scrollTop() > 120) {
      $('#nav_bar').addClass('navbar-fixed-top');
      $('.go-top').show();
    }
    if ($(window).scrollTop() < 121) {
      $('#nav_bar').removeClass('navbar-fixed-top');
        $('.go-top').hide();
    }
  });
});

$('#gtop').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});

var first = true;
$(document).on('scroll', function() {
    if (first){
        if($(this).scrollTop()>=$('.go-counter').position().top-400){
            $('.counter').each(function() {
                var $this = $(this),
                    countTo = $this.attr('data-count');

                $({ countNum: $this.text()}).animate({
                        countNum: countTo
                    },

                    {
                        duration: 5000,
                        easing:'linear',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                            //alert('finished');
                        }

                    });
            });

            first = false;
        }
    }
});


