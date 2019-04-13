$('.picked').on('click', function (e) {
  event.preventDefault();
  var form = $('#picker-form');
  var guessed = parseInt(form.find('#user').val());
  var picked = parseInt($(e.target).data('id'));


  if (guessed === picked) {
    // @todo add success class
    console.log(guessed, picked);
  } else {
    // @todo add fail class
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
