@if ($isUpdate)
  <div class="form-group">
    {!! Form::label('id', __('general.id')) !!} <span class="required-input">*</span>
    {!! Form::text('id',
                    null,
                    [ 'id' => 'id',
                      'class' => input_checker('id')->has($errors)->output('form-control-danger', 'form-control'),
                      'readonly', 'tabindex' => 1 ]) !!}
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
    <div class="col-xs-6">
      <div class="form-group {{ input_checker('name')->has($errors)->output('has-danger') }}">
        {!! Form::label('name', __('general.name')) !!} <span class="required-input">*</span>
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
    <div class="col-xs-6">
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
<!--

  Imagem

-->
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.image') }}
  </div>
  <div class="form-group {{ input_checker('thumbnail')->has($errors)->output('has-danger') }}">
    {!! Form::label('thumbnail', __('general.thumbnail')) !!}
    <div id="thumbnail"
         tabindex="6"
         data-uplab="thumbnail"
         data-uplab-trans-local="{{ __('general.local') }}"
         data-uplab-trans-remote="{{ __('general.remote') }}"
         data-uplab-trans-download="{{ __('general.download') }}"
         data-uplab-value="{{ old('thumbnail') ? old('thumbnail') : ($isUpdate && ! empty($tag->thumbnail) ? storage()->url($tag->thumbnail->location) : '') }}"
         data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
         data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
  </div>
</div>
<!--

  Informações de Publicação

-->
<div class="form-box">
  <div class="form-box__title">
    <span class="fa fa-square"></span> {{ __('general.publication_information') }}
  </div>
  <div class="form-group {{ input_checker('is_visible')->has($errors)->output('has-danger') }}">
    {!! Form::label('is_visible', __('general.is_visible'), [ 'class' => 'control-label' ]) !!}
    {!! Form::select('is_visible',
                      $yesOrNo,
                      null,
                      [ 'id' => 'is_visible',
                        'class' => input_checker('is_visible')->has($errors)->output('form-control-danger', 'form-control select2'),
                        'placeholder' => __('general.choose_a_option | UPPERCASE'),
                        'tabindex' => 7 ]) !!}
    <div class="form-control-feedback">{!! input_checker('is_visible')->has($errors)->show() !!}</div>
  </div>
</div>
<div class="form-group">
  {!! Form::submit($submitButtonText, [ 'class' => 'btn btn-lg btn-primary pull-xs-right', 'tabindex' => 8 ]) !!}
</div>

@section('js')
  <script type="text/javascript">
    var $excerpt = $('#excerpt'),
        $description = $('#description'),
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