


jQuery( document ).ready(function() {
  jQuery('#popup').modal('show');
  $('#myTimer').polartimer({
    timerSeconds: 10,
    opacity: 0.4,
    color: '#69D0C6',
    callback: function () {
      $('.answer').addClass('fail');
      $('.modal-content .progresses .fail').show( 2000 );
      $('#myTimer').css('display','none');
      $('.guess-buddy .buddy').text('Time is out!');
      setTimeout(function () {
        $('#popup').addClass('result');
        $('.modal-content .progresses').removeClass("fail");
        $('.modal-content .progresses .fail').remove();
        $('.modal-content .progresses .success').css('display', 'block');
      }, 2000);
    }
  });
  $('#myTimer').polartimer('start');

});
