;(function($, window, document, undefined) {

  'use strict';

  var $document = $(document),
    _token = $('meta[name="_token"]').attr('content');

  /**
   * Slugger wrapper.
   *
   * @returns {Slugger}
   */
  var Slugger = (function() {

    function Slugger(element, options) {
      var _ = this,
        $element = $(element),
        defaults = {
          url: '',
          input: '',
          output: ''
        };

      _.settings = $.extend({}, defaults, options);

      var $input = $(_.settings.input),
          $output = $(_.settings.output);

      var trigger = function() {
        var str = $input.val().length != 0 ? $input.val() : $element.val();

        if (str.length != 0) {
          _.makeSlug(str, $output);
        } else {
          _.output('', $output);
        }
      };

      $element.add($input).is(trigger);
      $element.add($input).keyup(trigger);
      $element.add($input).focusin(trigger);
      $element.add($input).focusout(trigger);
    }

    /**
     * Faz a requisição que irá retornar a string na forma de slug.
     *
     * @param str
     * @param $output
     */
    Slugger.prototype.makeSlug = function(str, $output) {
      var _ = this;

      $.ajax({
        url: _.settings.url,
        type: 'POST',
        data: {
          'str': str,
          '_token': _token
        },
        dataType: 'json',

        /**
         * ...
         *
         * @param response
         */
        success: function(response) {
          if (response.success) {
            _.output(response.str, $output);
          }
        }
      });
    };

    /**
     * ....
     *
     * @param str
     * @param $output
     */
    Slugger.prototype.output = function(str, $output) {
      if ($output.is('input') || $output.is('textarea')) {
        $output.val(str);
      } else {
        $output.html(str);
      }
    };

    return Slugger;

  })();

  $.fn.slugger = function(options) {
    var _ = this,
      l = _.length,
      i;

    for (i = 0; i < l; i++) {
      _[i] = new Slugger(_[i], options);
    }

    return _;
  };

  $document.ready(function() {
    dataSearch();
  });

  /**
   * ...
   *
   * @return {undefined}
   */
  function dataSearch() {
    var $sluggers = $('[data-slugger]');

    $sluggers.each(function() {
      var $el = $(this),
        url = $el.data('slugger'),
        input = $el.data('slugger-input'),
        output = $el.data('slugger-output');

      $el.slugger({
        url: url,
        input: input,
        output: output
      });
    });
  }

})(jQuery, window, document);