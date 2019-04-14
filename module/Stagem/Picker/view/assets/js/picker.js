StagemPicker = {
  body: $('body'),
  timer: $('#myTimer'),

  attachEvents: function () {
    this.attachOnClickAnswer();
    this.attachOnClosePopup();

    this.waitTimer();
  },

  attachOnClickAnswer: function () {
    // Remove handler from existing elements
    this.body.off('click', '#picker-form .answer', this.clickAnswer);

    // Re-add event handler for all matching elements
    this.body.on('click', '#picker-form .answer', this.clickAnswer);
  },

  attachOnClosePopup: function () {
    // Remove handler from existing elements
    this.body.off('hidden.bs.modal', '#popup', this.closePopup);

    // Re-add event handler for all matching elements
    this.body.on('hidden.bs.modal', '#popup', this.closePopup);
  },

  clickAnswer: function (e) {
    e.preventDefault();

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

    StagemPicker.timer.css('display', 'none');

    setTimeout(function () {
      $('#popup').addClass('result');
      $('.modal-content .progresses').removeClass('fail');
      $('.modal-content .progresses .fail').remove();
      $('.modal-content .progresses .success').css('display', 'block');
    }, 2000);

    StagemPicker.sendAnswer(guessed, picked);
  },

  closePopup: function(e) {
    e.preventDefault();

    StagemPicker.sendAnswer(null, null);
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
    $('#popup').modal('show');
    StagemPicker.timer.polartimer({
      timerSeconds: 10,
      opacity: 0.4,
      color: '#69D0C6',
      callback: function () {
        $('.answer').addClass('fail');
        $('.modal-content .progresses .fail').show(2000);
        StagemPicker.timer.css('display', 'none');
        $('.guess-buddy .buddy').text('Time is up!');

        setTimeout(function () {
          $('#popup').addClass('result');
          $('.modal-content .progresses').removeClass('fail');
          $('.modal-content .progresses .fail').remove();
          $('.modal-content .progresses .success').css('display', 'block');

          //StagemPicker.sendAnswer(0, 0);

        }, 2000);
      }
    });
    StagemPicker.timer.polartimer('start');
  }
};

jQuery(document).ready(function ($) {
  StagemPicker.attachEvents();
});