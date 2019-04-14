var form = $('#picker-form');

$('.answer', form).on('click', function (e) {
  event.preventDefault();
  var elm = $(this);
  var hr = $('.modal-content .progresses');
  var guessed = parseInt(form.find('#user').val());
  var picked = parseInt(elm.data('user'));


  if (guessed === picked) {
    elm.addClass('success');
    hr.addClass('success');
    $('.modal-content .progresses .success').show(2000);
    $('.guess-buddy .buddy').text('Correct!');
  } else {
    elm.addClass('fail');
    hr.addClass('fail');
    $('.modal-content .progresses .fail').show(2000);
    $('.guess-buddy .buddy').text('Wrong');
  }

  $('#myTimer').css('display', 'none');
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
