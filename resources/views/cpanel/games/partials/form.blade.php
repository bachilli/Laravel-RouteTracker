@if ($isUpdate)
  <div class="form-group {{ input_checker('id')->has($errors)->output('has-danger') }}">
    {!! Form::label('id', __('general.id')) !!} <span class="required-input">*</span>
    {!! Form::text('id',
                    null,
                    [ 'id' => 'id',
                      'class' => 'form-control',
                      'readonly',
                      'tabindex' => 1 ]) !!}
    <div class="form-control-feedback">{!! input_checker('id')->has($errors)->show() !!}</div>
  </div>
@endif
<!--

  Informações Básicas

-->
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.basic_information') }}
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <div class="form-group {{ input_checker('name')->has($errors)->output('has-danger') }}">
        {!! Form::label('name', __('general.name'), [ 'class' => 'control-label' ]) !!} <span class="required-input">*</span>
        {!! Form::text('name',
                        null,
                        [ 'id' => 'name',
                          'class' => input_checker('name')->has($errors)->output('form-control-danger', 'form-control'),
                          'data-slugger' => action('Ajax\SlugController@index'),
                          'data-slugger-input' => '#slug',
                          'data-slugger-output' => '#slug_output',
                          'tabindex' => 2 ]) !!}
        <div class="form-control-feedback">{!! input_checker('name')->has($errors)->show() !!}</div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group {{ input_checker('slug')->has($errors)->output('has-danger') }}">
        {!! Form::label('slug', __('general.slug')) !!}
        {!! Form::text('slug',
                        null,
                        [ 'id' => 'slug',
                          'class' => input_checker('slug')->has($errors)->output('form-control-danger', 'form-control'),
                          'tabindex' => 3 ]) !!}
        <small id="slug_output" class="form-text text-muted"></small>
        <div class="form-control-feedback">{!! input_checker('slug')->has($errors)->show() !!}</div>
      </div>
    </div>
  </div>
</div>
<!--

  Informações Extras

-->
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.extra_information') }}
  </div>
  <div class="form-group {{ input_checker('excerpt')->has($errors)->output('has-danger') }}">
    {!! Form::label('excerpt', __('general.excerpt')) !!}
    {!! Form::text('excerpt',
                    null,
                    [ 'id' => 'excerpt',
                      'class' => input_checker('excerpt')->has($errors)->output('form-control-danger', 'form-control'),
                      'tabindex' => 4 ]) !!}
    <div class="form-control-feedback">{!! input_checker('excerpt')->has($errors)->show() !!}</div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <div class="form-group {{ input_checker('description')->has($errors)->output('has-danger') }}">
        {!! Form::label('description', __('general.description')) !!}
        {!! Form::textarea('description',
                            null,
                            [ 'id' => 'description',
                              'class' => input_checker('description')->has($errors)->output('form-control-danger', 'form-control'),
                              'tabindex' => 5 ]) !!}
        <div class="form-control-feedback">{!! input_checker('description')->has($errors)->show() !!}</div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group {{ input_checker('instructions')->has($errors)->output('has-danger') }}">
        {!! Form::label('instructions', __('general.instructions')) !!}
        {!! Form::textarea('instructions',
                            null,
                            [ 'id' => 'instructions',
                              'readonly' => 'readonly',
                              'class' => input_checker('instructions')->has($errors)->output('form-control-danger', 'form-control'),
                              'tabindex' => 6 ]) !!}
        <div class="form-control-feedback">{!! input_checker('instructions')->has($errors)->show() !!}</div>
      </div>
    </div>
  </div>
  <div class="form-group {{ input_checker('age_range')->has($errors)->output('has-danger') }}">
    {!! Form::label('age_range', __('general.age_range'), [ 'class' => 'control-label' ]) !!}
    {!! Form::select('age_range',
                      $ageRange,
                      null,
                      [ 'id' => 'age_range',
                        'class' => input_checker('age_range')->has($errors)->output('form-control-danger', 'form-control select2'),
                        'placeholder' => __('general.choose_a_option | UPPERCASE'),
                        'tabindex' => 7 ]) !!}
    <div class="form-control-feedback">{!! input_checker('age_range')->has($errors)->show() !!}</div>
  </div>
  <div class="form-group form-group-select2-lg {{ input_checker('tag_list')->has($errors)->output('has-error') }}">
    {!! Form::label('tag_list', __('general.tags'), [ 'class' => 'control-label' ]) !!}
    {!! Form::select('tag_list[]',
                      $tags->pluck('name', 'id')->toArray(),
                      null,
                      [ 'id' => 'tag_list',
                        'class' => 'form-control select2',
                        'multiple',
                        'tabindex' => 8 ]) !!}
    <div class="form-control-feedback">{!! input_checker('tag_list')->has($errors)->show() !!}</div>
  </div>
  <div class="form-group {{ input_checker('distributor_id')->has($errors)->output('has-danger') }}">
    {!! Form::label('distributor_id', __('general.distributor'), [ 'class' => 'control-label' ]) !!}
    {!! Form::select('distributor_id',
                      $distributors->pluck('name', 'id')->toArray(),
                      null,
                      [ 'id' => 'distributor_id',
                        'class' => input_checker('distributor_id')->has($errors)->output('form-control-danger', 'form-control select2'),
                        'placeholder' => __('general.choose_a_option | UPPERCASE'),
                        'tabindex' => 7 ]) !!}
    <div class="form-control-feedback">{!! input_checker('distributor_id')->has($errors)->show() !!}</div>
  </div>
</div>
<!--

  Dimensões

-->
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.dimensions') }}
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-3">
      <div class="form-group {{ input_checker('dimensions.is_responsive')->has($errors)->output('has-danger') }}">
        {!! Form::label('dimensions[is_responsive]', __('general.is_responsive'), [ 'class' => 'control-label' ]) !!}
        {!! Form::select('dimensions[is_responsive]',
                          $yesOrNo,
                          null,
                          [ 'id' => 'dimensions[is_responsive]',
                            'class' => input_checker('dimensions.is_responsive')->has($errors)->output('form-control-danger', 'form-control select2'),
                            'placeholder' => __('general.choose_a_option | UPPERCASE'),
                            'tabindex' => 9 ]) !!}
        <div class="form-control-feedback">{!! input_checker('dimensions.is_responsive')->has($errors)->show() !!}</div>
      </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="form-group {{ input_checker('dimensions.width')->has($errors)->output('has-danger') }}">
        {!! Form::label('dimensions[width]', __('general.width')) !!}
        {!! Form::text('dimensions[width]',
                        null,
                        [ 'id' => 'dimensions[width]',
                          'class' => input_checker('dimensions.width')->has($errors)->output('form-control-danger', 'form-control'),
                          'tabindex' => 10 ]) !!}
        <div class="form-control-feedback">{!! input_checker('dimensions.width')->has($errors)->show() !!}</div>
      </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="form-group {{ input_checker('dimensions.height')->has($errors)->output('has-danger') }}">
        {!! Form::label('dimensions[height]', __('general.height')) !!}
        {!! Form::text('dimensions[height]',
                        null,
                        [ 'id' => 'dimensions[height]',
                          'class' => input_checker('dimensions.height')->has($errors)->output('form-control-danger', 'form-control'),
                          'tabindex' => 11 ]) !!}
        <div class="form-control-feedback">{!! input_checker('dimensions.height')->has($errors)->show() !!}</div>
      </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="form-group {{ input_checker('dimensions.aspect_ratio')->has($errors)->output('has-danger') }}">
        {!! Form::label('dimensions[aspect_ratio]', __('general.aspect_ratio')) !!}
        {!! Form::text('dimensions[aspect_ratio]',
                        null,
                        [ 'id' => 'dimensions[aspect_ratio]',
                          'class' => input_checker('dimensions.aspect_ratio')->has($errors)->output('form-control-danger', 'form-control'),
                          'tabindex' => 12 ]) !!}
        <div class="form-control-feedback">{!! input_checker('dimensions.aspect_ratio')->has($errors)->show() !!}</div>
      </div>
    </div>
  </div>
</div>
<!--

  Jogo

-->
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.game') }}
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-9">
      <div class="form-group {{ input_checker('embed.url')->has($errors)->output('has-danger') }}">
        {!! Form::label('embed[url]', __('general.embed_url')) !!}
        {!! Form::text('embed[url]',
                        null,
                        [ 'id' => 'embed[url]',
                          'class' => input_checker('embed.url')->has($errors)->output('form-control-danger', 'form-control'),
                          'tabindex' => 13 ]) !!}
        <div class="form-control-feedback">{!! input_checker('embed.url')->has($errors)->show() !!}</div>
      </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="form-group {{ input_checker('embed.type')->has($errors)->output('has-danger') }}">
        {!! Form::label('embed[type]', __('general.embed_type'), [ 'class' => 'control-label' ]) !!}
        {!! Form::select('embed[type]',
                          $embedType,
                          null,
                          [ 'id' => 'embed[type]',
                            'class' => input_checker('embed.type')->has($errors)->output('form-control-danger', 'form-control select2'),
                            'placeholder' => __('general.choose_a_option | UPPERCASE'),
                            'tabindex' => 14 ]) !!}
        <div class="form-control-feedback">{!! input_checker('embed.type')->has($errors)->show() !!}</div>
      </div>
    </div>
    <!--<div class="col-xs-12">
      <div class="form-group">
        {!! Form::label('file', __('general.file')) !!}
        <div id="file"
             tabindex="15"
             data-uplab="file"
             data-uplab-trans-local="{{ __('general.local') }}"
             data-uplab-trans-remote="{{ __('general.remote') }}"
             data-uplab-trans-download="{{ __('general.download') }}"
             data-uplab-value="{{ old('file') ? old('file') : ($isUpdate && ! empty($game->file) ? storage()->url($game->file->location) : '') }}"
             data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
             data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
      </div>
    </div>-->
  </div>
</div>
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.image') }}
  </div>
  <div class="form-group">
    {!! Form::label('thumbnail', __('general.thumbnail')) !!}
    <div id="thumbnail"
         tabindex="16"
         data-uplab="thumbnail"
         data-uplab-trans-local="{{ __('general.local') }}"
         data-uplab-trans-remote="{{ __('general.remote') }}"
         data-uplab-trans-download="{{ __('general.download') }}"
         data-uplab-value="{{ old('thumbnail') ? old('thumbnail') : ($isUpdate && ! empty($game->thumbnail) ? storage()->url($game->thumbnail->location) : '') }}"
         data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
         data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
  </div>
</div>
<!--

  Publicação

-->
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.publication_information') }}
  </div>
  <div class="form-group {{ input_checker('published_at')->has($errors)->output('has-danger') }}">
    {!! Form::label('human_published_at', __('general.published_at')) !!}
    {!! Form::text('human_published_at',
                    null,
                    [ 'id' => 'human_published_at',
                      'class' => input_checker('published_at')->has($errors)->output('form-control-danger', 'form-control'),
                      'tabindex' => 17 ]) !!}
    {!! Form::hidden('published_at', null, [ 'id' => 'published_at' ]) !!}
    <div class="form-control-feedback">{!! input_checker('published_at')->has($errors)->show() !!}</div>
  </div>
  <div class="form-group {{ input_checker('is_visible')->has($errors)->output('has-danger') }}">
    {!! Form::label('is_visible', __('general.is_visible'), [ 'class' => 'control-label' ]) !!}
    {!! Form::select('is_visible',
                      $yesOrNo,
                      null,
                      [ 'id' => 'is_visible',
                        'class' => input_checker('is_visible')->has($errors)->output('form-control-danger', 'form-control select2'),
                        'placeholder' => __('general.choose_a_option | UPPERCASE'),
                        'tabindex' => 18 ]) !!}
    <div class="form-control-feedback">{!! input_checker('is_visible')->has($errors)->show() !!}</div>
  </div>
</div>
<div class="form-group">
  {!! Form::submit($submitButtonText, [ 'class' => 'btn btn-lg btn-primary pull-xs-right', 'tabindex' => 19 ]) !!}
</div>

@section('js')
  <script type="text/javascript">
    // Pega os Campos
    var $excerpt = $('#excerpt'),
        $description = $('#description'),
        $dimensions = {
          isResponsive: $('#dimensions\\[is_responsive\\]'),
          width: $('#dimensions\\[width\\]'),
          height: $('#dimensions\\[height\\]'),
          aspectRatio: $('#dimensions\\[aspect_ratio\\]')
        },
        $embed = {
          url: $('#embed\\[url\\]'),
          type: $('#embed\\[type\\]')
        },
        $file = $('#file'),
        $humanPublishedAt = $('#human_published_at');

    $(document).ready(function() {
      startFields();
    });

    /**
     * Inicializa os campos do formulário de adição do jogo.
     *
     * @return {undefined}
     */
    function startFields() {
      // Resumo
      $excerpt.textcounter({
        max: 140,
        countDown: true,
        stopInputAtMaximum: false,
        countSpaces: true,
        counterText: '{{ __('general.total_chars') }}: ',
        minimumErrorText: '{{ __('general.minimum_chars_not_met') }}',
        maximumErrorText: '{{ __('general.maximum_chars_exceeded') }}',
        countDownText: '{{ __('general.remaining_chars') }}: '
      });

      // Descrição
      $description.textcounter({
        max: 140,
        countDown: true,
        stopInputAtMaximum: false,
        countSpaces: true,
        counterText: '{{ __('general.total_chars') }}: ',
        minimumErrorText: '{{ __('general.minimum_chars_not_met') }}',
        maximumErrorText: '{{ __('general.maximum_chars_exceeded') }}',
        countDownText: '{{ __('general.remaining_chars') }}: '
      });

      // Responsivo?
      function isResponsive(bool) {
        $dimensions.width.prop('readonly', bool);
        $dimensions.height.prop('readonly', bool);
        $dimensions.aspectRatio.prop('readonly', bool);
      }

      isResponsive($dimensions.isResponsive.val() == 1 || $dimensions.isResponsive.val() == '');

      $dimensions.isResponsive.on('change', function() {
        isResponsive(this.value == 1 || this.value == '');
      });

      // Largura, Altura e Aspect Ratio
      $dimensions.width.mask('0000');
      $dimensions.height.mask('0000');
      $dimensions.aspectRatio.mask('0.00');

      // Embed URL
      $embed.url.on('keyup', function() {
        if ($embed.url.val().length > 0) {
          $file.parent('.form-group').hide();
        } else {
          $file.parent('.form-group').show();
        }
      });

      // Data de Publicação
      $humanPublishedAt.datetimepicker({
        format: 'dd/mm/yy',
        timeFormat: 'HH:mm:ss',
        stepMinute: 5,
        secondMax: 0,
        showSecond: false,
        altFieldTimeOnly: false,
        altField: '#published_at',
        altFormat: 'yy-mm-dd',
        altTimeFormat: 'HH:mm:ss'
      });
    }
  </script>
@endsection