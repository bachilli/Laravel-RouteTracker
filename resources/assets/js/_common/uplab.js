;(function ($, window, document, undefined) {

  'use strict';

  var $document = $(document),
      instances = [],
      _token = $('meta[name="_token"]').attr('content');

  /**
   * Uplab wrapper.
   *
   * @returns {Uplab}
   */
  var Uplab = (function () {

    function Uplab(element, options) {
      var _ = this,
        $element = $(element),
        defaults = {
          name: '',
          value: '',
          url: '',
          trans: {
            local: 'Local',
            remote: 'Remote',
            download: 'Download'
          }
        };

      _.settings = $.extend({}, defaults, options);

      if (! _.settings.name || ! _.settings.url || $.inArray(_.settings.name, instances) !== -1) {
        throw 'Ocorreu um erro ao inicializar o Uplab "' + _.settings.name + '"';
      }

      instances.push(_.settings.name);

      $element.html(
        _.buildComponent()
      );

      var $uplab = $('#uplab-' + _.settings.name);

      var $elements = {
        result: $uplab.find('#uplab-' + _.settings.name + '-result'),
        tabs: $uplab.find('ul.uplab__options li'),
        options: $uplab.find('.uplab__option'),
        local: {
          input: $uplab.find('#uplab-' + _.settings.name + '-local-input')
        },
        remote: {
          input: $uplab.find('#uplab-' + _.settings.name + '-remote-input'),
          button: $uplab.find('#uplab-' + _.settings.name + '-remote-button')
        }
      };

      $elements.tabs.on('click', function () {
        _.changeOption($elements.tabs, $elements.options, $(this));
      });

      $elements.local.input.on('change', function (e) {
        _.localFile(e, $elements.result);
      }).on('click', function () {
        this.value = null;
      });

      $elements.remote.button.on('click', function () {
        _.remoteFile($elements.result, $elements.remote);
      });
    }

    /**
     * Método que realiza a construção do componente.
     *
     * @returns {string}
     */
    Uplab.prototype.buildComponent = function () {
      var _ = this,
        html = '';

        html += '<div id="uplab-' + _.settings.name + '" class="uplab">';
          html += '<ul class="uplab__options">';
            html += '<li class="active" data-tab="local">' + _.settings.trans.local + '</li>';
            html += '<li data-tab="remote">' + _.settings.trans.remote + '</li>';
          html += '</ul>';
          html += '<div id="uplab-local-tab" class="uplab__option uplab__option--local uplab__option--active">';
            html += '<input id="uplab-' + _.settings.name + '-local-input" type="file">';
          html += '</div>';
          html += '<div id="uplab-remote-tab" class="uplab__option uplab__option--remote">';
            html += '<input id="uplab-' + _.settings.name + '-remote-input" type="text">';
            html += '<button id="uplab-' + _.settings.name + '-remote-button" type="button">' + _.settings.trans.download + '</button>';
          html += '</div>';
          html += '<div id="uplab-' + _.settings.name + '-result" class="uplab__result"></div>';
        html += '</div>';

        return html;
    };

    /**
     * Altera a aba.
     *
     * @param $tabs
     * @param $options
     * @param $tab
     */
    Uplab.prototype.changeOption = function ($tabs, $options, $tab) {
      var _ = this;

      $tabs.removeClass('active');
      $options.removeClass('uplab__option--active');

      $tab.addClass('active');
      $('#uplab-' + $tab.data('tab') + '-tab').addClass('uplab__option--active');
    };

    /**
     * Faz o envio do arquivo local.
     *
     * @param e
     * @param $result
     */
    Uplab.prototype.localFile = function (e, $result) {
      var _ = this,
        params = new FormData();

      params.append('_token', _token);

      $.each(e.target.files, function (key, file) {
        params.append('upload', file);
      });

      $.ajax({
        url: _.settings.url.local,
        type: 'POST',
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function (xhr) {},
        success: function (response) {
          if (response.success) {
            $result.html(
              _.showResult(response)
            );

            window.TopAlert('Sucesso!', { type: 'success', delay: 5000 });
          }
        },
        error: function (xhr, status, error) {
          var response = xhr.responseJSON ? xhr.responseJSON : error;

          window.TopAlert(response, { type: 'error', delay: 5000 });
        }
      });
    };

    /**
     * Faz o download do arquivo remoto.
     *
     * @param $result
     * @param $remote
     */
    Uplab.prototype.remoteFile = function ($result, $remote) {
      var _ = this;

      $.ajax({
        url: _.settings.url.remote,
        type: 'POST',
        data: {
          _token: _token,
          url: $remote.input.val()
        },
        dataType: 'json',
        beforeSend: function (xhr) {},
        success: function (response) {
          if (response.success) {
            $result.html(
              _.showResult(response)
            );

            window.TopAlert('Sucesso!', { type: 'success', delay: 5000 });
          }
        },
        error: function (xhr, status, error) {
          var response = xhr.responseJSON ? xhr.responseJSON : error;

          window.TopAlert(response, { type: 'error', delay: 5000 });
        }
      });
    };

    /**
     * Mostra o resultado após a tentativa de upload/download do arquivo.
     *
     * @param response
     * @returns {string}
     */
    Uplab.prototype.showResult = function (response) {
      var html = '';

      html += '<input type="hidden" name="thumbnail" value="' + response.upload.location + '">';
      html += '<hr>';
      html += '<img src="' + response.upload.url + '" style="max-width: 255px;">';

      return html;
    };

    return Uplab;

  })();

  $.fn.uplab = function (options) {
    var _ = this,
      l = _.length,
      i;

    for (i = 0; i < l; i++) {
      _[i] = new Uplab(_[i], options);
    }

    return _;
  };

  $document.ready(function () {
    var $uplabs = $('[data-uplab]');

    $uplabs.each(function () {
      var $el = $(this),
        name = $el.data('uplab'),
        value = $el.data('uplab-value'),
        url = {
          local: $el.data('uplab-local-url'),
          remote: $el.data('uplab-remote-url')
        },
        trans = {
          local: $el.data('uplab-trans-local'),
          remote: $el.data('uplab-trans-remote'),
          download: $el.data('uplab-trans-download')
        };

      $el.uplab({
        name: name,
        value: value,
        url: url,
        trans: trans
      });
    });
  });

})(jQuery, window, document);