


jQuery( document ).ready(function() {
  jQuery('#popup').modal('show');
  $('#myTimer').polartimer({
    timerSeconds: 10,
    opacity: 0.4,
    color: '#69D0C6'
  });
  $('#myTimer').polartimer('start');

});
