@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.games.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ __('games.create') }}</h3>
    <hr>
    {!! Form::open([ 'action' => 'CPanel\GameController@store', 'files' => true ]) !!}
      @include('cpanel.games.partials.form', [ 'submitButtonText' => __('games.store'), 'isUpdate' => false ])
    {!! Form::close() !!}
  </div>
@endsection