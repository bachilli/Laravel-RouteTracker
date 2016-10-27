@if ($isUpdate)
  <!--

    ID

  -->
  <div class="form-group {{ input_checker('id')->has($errors)->output('has-danger') }}">
    {!! Form::label('id', trans('general.id')) !!} <span class="required-input">*</span>
    {!! Form::text('id',
                    null,
                    [ 'id' => 'id',
                      'class' => 'form-control',
                      'readonly',
                      'tabindex' => 1 ]) !!}
  </div>
@endif
<div class="row">
  <div class="col-xs-12 col-md-6">
    <!--

      Nome

    -->
    <div class="form-group {{ input_checker('name')->has($errors)->output('has-danger') }}">
      {!! Form::label('name', trans('general.name'), [ 'class' => 'control-label' ]) !!} <span class="required-input">*</span>
      {!! Form::text('name',
                      null,
                      [ 'id' => 'name',
                        'class' => input_checker('name')->has($errors)->output('form-control-danger', 'form-control'),
                        'tabindex' => 3 ]) !!}
      <div class="form-control-feedback">{!! input_checker('name')->has($errors)->show() !!}</div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <!--

      Slug

    -->
    <div class="form-group {{ input_checker('slug')->has($errors)->output('has-danger') }}">
      {!! Form::label('slug', trans('general.slug')) !!} <span class="required-input">*</span>
      {!! Form::text('slug',
                      null,
                      [ 'id' => 'slug',
                        'class' => input_checker('slug')->has($errors)->output('form-control-danger', 'form-control'),
                        'readonly',
                        'tabindex' => 4 ]) !!}
    </div>
  </div>
</div>
<!--

  Resumo

-->
<div class="form-group {{ input_checker('excerpt')->has($errors)->output('has-danger') }}">
  {!! Form::label('excerpt', trans('general.excerpt')) !!}
  {!! Form::text('excerpt',
                  null,
                  [ 'id' => 'excerpt',
                    'class' => input_checker('excerpt')->has($errors)->output('form-control-danger', 'form-control'),
                    'tabindex' => 5 ]) !!}
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <!--

      Descrição

    -->
    <div class="form-group {{ input_checker('description')->has($errors)->output('has-danger') }}">
      {!! Form::label('description', trans('general.description')) !!}
      {!! Form::textarea('description',
                          null,
                          [ 'id' => 'description',
                            'class' => input_checker('description')->has($errors)->output('form-control-danger', 'form-control'),
                            'tabindex' => 6 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <!--

      Instruções

    -->
    <div class="form-group {{ input_checker('instructions')->has($errors)->output('has-danger') }}">
      {!! Form::label('instructions', trans('general.instructions')) !!}
      {!! Form::textarea('instructions',
                          null,
                          [ 'id' => 'instructions',
                            'class' => input_checker('instructions')->has($errors)->output('form-control-danger', 'form-control'),
                            'tabindex' => 7 ]) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-4">
    <!--

      Largura

    -->
    <div class="form-group {{ input_checker('width')->has($errors)->output('has-danger') }}">
      {!! Form::label('width', trans('general.width')) !!}
      {!! Form::text('width',
                      null,
                      [ 'id' => 'width',
                        'class' => input_checker('width')->has($errors)->output('form-control-danger', 'form-control'),
                        'tabindex' => 8 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <!--

      Altura

    -->
    <div class="form-group {{ input_checker('height')->has($errors)->output('has-danger') }}">
      {!! Form::label('height', trans('general.height')) !!}
      {!! Form::text('height',
                      null,
                      [ 'id' => 'height',
                        'class' => input_checker('height')->has($errors)->output('form-control-danger', 'form-control'),
                        'tabindex' => 9 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <!--

      Aspect Ratio

    -->
    <div class="form-group {{ input_checker('aspect_ratio')->has($errors)->output('has-danger') }}">
      {!! Form::label('aspect_ratio', trans('general.aspect_ratio')) !!}
      {!! Form::text('aspect_ratio',
                      null,
                      [ 'id' => 'aspect_ratio',
                        'class' => input_checker('aspect_ratio')->has($errors)->output('form-control-danger', 'form-control'),
                        'tabindex' => 10 ]) !!}
    </div>
  </div>
</div>
<!--

  Faixa Etária

-->
<div class="form-group {{ input_checker('age_range')->has($errors)->output('has-danger') }}">
  {!! Form::label('age_range', trans('general.age_range'), [ 'class' => 'control-label' ]) !!}
  {!! Form::select('age_range',
                    $ageRange,
                    null,
                    [ 'id' => 'age_range',
                      'class' => input_checker('age_range')->has($errors)->output('form-control-danger', 'form-control select2'),
                      'placeholder' => 'Selecionar...',
                      'tabindex' => 11 ]) !!}
</div>
<div class="row">
  <div class="col-xs-12 col-md-9">
    <!--

      SRC Embed

    -->
    <div class="form-group {{ input_checker('embed_src')->has($errors)->output('has-danger') }}">
      {!! Form::label('embed_src', trans('general.embed_src')) !!}
      {!! Form::text('embed_src',
                      null,
                      [ 'id' => 'embed_src',
                        'class' => input_checker('embed_src')->has($errors)->output('form-control-danger', 'form-control'),
                        'tabindex' => 13 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-3">
    <!--

      Tipo Embed

    -->
    <div class="form-group {{ input_checker('embed_type')->has($errors)->output('has-danger') }}">
      {!! Form::label('embed_type', trans('general.embed_type'), [ 'class' => 'control-label' ]) !!}
      {!! Form::select('embed_type',
                        $embedType,
                        null,
                        [ 'id' => 'embed_type',
                          'class' => input_checker('embed_type')->has($errors)->output('form-control-danger', 'form-control select2'),
                          'placeholder' => 'Selecionar...',
                          'tabindex' => 14 ]) !!}
    </div>
  </div>
</div>
<!--

  Tags

-->
<div class="form-group form-group-select2-lg {{ input_checker('tag_list')->has($errors)->output('has-error') }}">
  {!! Form::label('tag_list', trans('general.tags'), [ 'class' => 'control-label' ]) !!} <span class="form-control-required">*</span>
  {!! Form::select('tag_list[]',
                    $tags->pluck('name', 'id')->toArray(),
                    null,
                    [ 'class' => 'form-control select2', 'multiple' ]) !!}
  <div class="form-control-feedback">{!! input_checker('tag_list')->has($errors)->show() !!}</div>
</div>
<!--

  Arquivo

-->
<div class="form-group">
  {!! Form::label('file', trans('general.file')) !!}
  <div class="form-group">
    <div data-uplab="file"
         data-uplab-trans-local="{{ trans('general.local') }}"
         data-uplab-trans-remote="{{ trans('general.remote') }}"
         data-uplab-trans-download="{{ trans('general.download') }}"
         data-uplab-value="{{ old('file') ? old('file') : ($isUpdate && ! empty($game->file) ? storage()->url($game->file->location) : '') }}"
         data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
         data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
  </div>
</div>
<!--

  Miniatura

-->
<div class="form-group">
  {!! Form::label('thumbnail', trans('general.thumbnail')) !!}
  <div class="form-group">
    <div data-uplab="thumbnail"
         data-uplab-trans-local="{{ trans('general.local') }}"
         data-uplab-trans-remote="{{ trans('general.remote') }}"
         data-uplab-trans-download="{{ trans('general.download') }}"
         data-uplab-value="{{ old('thumbnail') ? old('thumbnail') : ($isUpdate && ! empty($game->thumbnail) ? storage()->url($game->thumbnail->location) : '') }}"
         data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
         data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
  </div>
</div>
<!--

  Data de Publicação

-->
<div class="form-group {{ input_checker('human_published_at')->has($errors)->output('has-danger') }}">
  {!! Form::label('human_published_at', trans('general.published_at')) !!}
  {!! Form::text('human_published_at',
                  null,
                  [ 'id' => 'human_published_at',
                    'class' => input_checker('human_published_at')->has($errors)->output('form-control-danger', 'form-control'),
                    'tabindex' => 2 ]) !!}
  {!! Form::hidden('published_at', null, [ 'id' => 'published_at' ]) !!}
</div>
<!--

  Visível?

-->
<div class="form-group {{ input_checker('is_visible')->has($errors)->output('has-danger') }}">
  {!! Form::label('is_visible', trans('general.is_visible'), [ 'class' => 'control-label' ]) !!}
  {!! Form::select('is_visible',
                    $yesOrNo,
                    null,
                    [ 'id' => 'is_visible',
                      'class' => input_checker('is_visible')->has($errors)->output('form-control-danger', 'form-control select2'),
                      'placeholder' => 'Selecionar...',
                      'tabindex' => 15 ]) !!}
</div>
<div class="form-group">
  {!! Form::submit($submitButtonText, [ 'class' => 'btn btn-lg btn-primary pull-xs-right', 'tabindex' => 16 ]) !!}
</div>

@section('js')
  <script type="text/javascript">
    $(document).ready(function () {
      startFields();
    });

    /**
     * Inicializa os campos do formulário de adição do jogo.
     *
     * @return {undefined}
     */
    function startFields() {
      // Resumo
      $('#excerpt').textcounter({
        max: 140,
        countDown: true,
        stopInputAtMaximum: false,
        countSpaces: true,
        counterText: '{{ trans('general.total_chars') }}: ',
        minimumErrorText: '{{ trans('general.minimum_chars_not_met') }}',
        maximumErrorText: '{{ trans('general.maximum_chars_exceeded') }}',
        countDownText: '{{ trans('general.remaining_chars') }}: '
      });

      // Descrição
      $('#description').textcounter({
        max: 140,
        countDown: true,
        stopInputAtMaximum: false,
        countSpaces: true,
        counterText: '{{ trans('general.total_chars') }}: ',
        minimumErrorText: '{{ trans('general.minimum_chars_not_met') }}',
        maximumErrorText: '{{ trans('general.maximum_chars_exceeded') }}',
        countDownText: '{{ trans('general.remaining_chars') }}: '
      });

      // Dimensões
      $('#aspect_ratio').mask('0.00');
      $('#width').mask('0000');
      $('#height').mask('0000');

      // Data de Publicação
      $('#human_published_at').datetimepicker({
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