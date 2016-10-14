@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.games.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ trans('games.create') }}</h3>
    <hr>
    {!! Form::open([ 'action' => 'CPanel\GameController@store', 'files' => true ]) !!}
      @include('cpanel.games.partials.form', [ 'submitButtonText' => trans('general.add'), 'isUpdate' => false ])
    {!! Form::close() !!}
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function () {
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

      $('#aspect_ratio').mask('0.00');
      $('#width').mask('0000');
      $('#height').mask('0000');

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
      $('#fake_published_at').datetimepicker({
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
    });
  </script>
@endsection