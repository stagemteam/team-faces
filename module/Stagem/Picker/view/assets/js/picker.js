var form = $('#picker-form');

$('.answer', form).on('click', function (e) {
  event.preventDefault();
  var elm = $(this);
  var guessed = parseInt(form.find('#user').val());
  var picked = parseInt(elm.data('user'));


  if (guessed === picked) {
    elm.addClass('success');
    console.log(guessed, picked);
  } else {
    elm.addClass('fail');
    console.log(guessed, picked);
  }

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
