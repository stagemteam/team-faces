var form = $('#picker-form');

$('.blabla', form).on('click', function (e) {



  event.preventDefault();
  var elm = $(this);
  var hr = $('.modal-content .progresses');
  var guessed = parseInt(form.find('#user').val());
  var picked = parseInt(elm.data('user'));


  if (guessed === picked) {
    elm.addClass('success');
    hr.addClass('success');
    $('.modal-content .progresses .success').show( 2000 );
    console.log(guessed, picked);
  } else {
    elm.addClass('fail');
    hr.addClass('fail');
    $('.modal-content .progresses .fail').show( 2000 );
    console.log(guessed, picked);
  }
  $('.guess-buddy .buddy').text(elm.find('.user-name').text());
  setTimeout(function () {
    $('#popup').addClass('result');
    $('.modal-content .progresses').removeClass("fail");
    $('.modal-content .progresses .fail').remove();
    $('.modal-content .progresses .success').css('display', 'block');
  }, 2000);

  $.ajax({
    url: "/admin/picker/pick",
    method: "POST",
    data: {guessed: guessed, picked: picked},
  }).done(function (response) {
    console.log(response);
  }).fail(function (jqXHR, textStatus) {
    console.log(jqXHR);
  });
});



jQuery( document ).ready(function() {
  jQuery('#statistic_first_popup').modal('show');
});