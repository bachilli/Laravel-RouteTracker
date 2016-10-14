$(document).ready(function() {
  $(".fancybox").fancybox();

  $('[data-toggle="tooltip"]').tooltip();

  $('.select2').select2({
    width: '100%',
    minimumResultsForSearch: 10
  });
});