@if ($isUpdate)
  <!--

    ID

  -->
  <div class="form-group">
    {!! Form::label('id', trans('general.id')) !!} <span class="required-input">*</span>
    {!! Form::text('id',
                    null,
                    [ 'id' => 'id',
                      'class' => 'form-control',
                      'readonly', 'tabindex' => 1 ]) !!}
  </div>
@endif
<div class="row">
  <div class="col-xs-6">
    <!--

      Nome

    -->
    <div class="form-group">
      {!! Form::label('name', trans('general.name')) !!} <span class="required-input">*</span>
      {!! Form::text('name',
                      null,
                      [ 'id' => 'name',
                        'class' => 'form-control',
                        'tabindex' => 2 ]) !!}
    </div>
  </div>
  <div class="col-xs-6">
    <!--

      Slug

    -->
    <div class="form-group">
      {!! Form::label('slug', trans('general.slug')) !!} <span class="required-input">*</span>
      {!! Form::text('slug',
                      null,
                      [ 'id' => 'slug',
                        'class' => 'form-control',
                        'readonly',
                        'tabindex' => 3 ]) !!}
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
                    'tabindex' => 4 ]) !!}
</div>
<!--

  Descrição

-->
<div class="form-group">
  {!! Form::label('description', trans('general.description')) !!}
  {!! Form::textarea('description',
                      null,
                      [ 'id' => 'description',
                        'class' => 'form-control',
                        'tabindex' => 5 ]) !!}
</div>
<!--

  Miniatura

-->
<div class="form-group">
  {!! Form::label('thumbnail', 'Thumbnail') !!}
  <div class="form-group">
    <div data-uplab="thumbnail"
         data-uplab-trans-local="{{ trans('general.local') }}"
         data-uplab-trans-remote="{{ trans('general.remote') }}"
         data-uplab-trans-download="{{ trans('general.download') }}"
         data-uplab-value="{{ old('thumbnail') ? old('thumbnail') : ($isUpdate && ! empty($tag->thumbnail) ? storage()->url($tag->thumbnail->location) : '') }}"
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
                    'tabindex' => 6 ]) !!}
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
                      'tabindex' => 7 ]) !!}
</div>
<div class="form-group">
  {!! Form::submit($submitButtonText, [ 'class' => 'btn btn-lg btn-primary pull-xs-right', 'tabindex' => 8 ]) !!}
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