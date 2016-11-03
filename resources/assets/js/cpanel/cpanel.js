//
// Scripts Requeridos ---------------------------
//

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.Tether = require('tether');

require('../../../../node_modules/bootstrap/dist/js/bootstrap');
require('sweetalert2');
require('jquery-ui/ui/widgets/datepicker');
require('jquery-ui/ui/widgets/slider');

//
// Inicializações -------------------------------
//

$(document).ready(function() {
  initializations();
});

/**
 * Realiza as inicializações necessárias.
 *
 * @return {undefined}
 */
function initializations() {
  // Fancybox
  $(".fancybox").fancybox();

  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Popover
  $('[data-toggle="popover"]').popover();

  // Select2
  var $select2 = {
    options: {
      width: '100%',
      minimumResultsForSearch: 10
    }
  };

  $('.select2').select2($select2.options);
}