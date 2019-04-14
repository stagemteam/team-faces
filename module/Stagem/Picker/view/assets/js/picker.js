StagemPicker = {
  body: $('body'),

  attachEvents: function () {
    this.attachOnClickAnswer();

    this.waitTimer();
  },

  // Show Print dialog
  attachOnClickAnswer: function () {
    // Remove handler from existing elements
    this.body.off('click', '#picker-form .answer', this.clickAnswer);

    // Re-add event handler for all matching elements
    this.body.on('click', '#picker-form .answer', this.clickAnswer);
  },

  clickAnswer: function () {
    event.preventDefault();

    var elm = $(this);
    var form = $('#picker-form');
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

    StagemPicker.sendAnswer(guessed, picked);
  },

  sendAnswer: function (guessed, picked) {
    $.ajax({
      url: "/admin/picker/pick",
      method: "POST",
      data: {guessed: guessed, picked: picked},
    }).done(function (response) {
      console.log(response);
    }).fail(function (jqXHR, textStatus) {
      console.log(jqXHR);
    });
  },

  waitTimer: function () {
    var timer = $('#myTimer');
    $('#popup').modal('show');
    timer.polartimer({
      timerSeconds: 10,
      opacity: 0.4,
      color: '#69D0C6',
      callback: function () {
        $('.answer').addClass('fail');
        $('.modal-content .progresses .fail').show(2000);
        timer.css('display', 'none');
        $('.guess-buddy .buddy').text('Time is out!');
        setTimeout(function () {
          $('#popup').addClass('result');
          $('.modal-content .progresses').removeClass('fail');
          $('.modal-content .progresses .fail').remove();
          $('.modal-content .progresses .success').css('display', 'block');
        }, 2000);

        StagemPicker.sendAnswer(0, 0);
      }
    });
    timer.polartimer('start');
  }
};

jQuery(document).ready(function ($) {
  StagemPicker.attachEvents();
});