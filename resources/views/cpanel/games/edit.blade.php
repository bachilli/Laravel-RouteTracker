@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.games.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ __('games.edit') }}</h3>
    <a href="{{ action('Primary\GameController@single', $game->slug) }}" target="_blank">&larr; {{ __('general.see_on_site') }}</a>
    <hr>
    {!! Form::model($game, [ 'method' => 'PATCH', 'action' => [ 'CPanel\GameController@update', $game->id ], 'files' => true ]) !!}
      @include('cpanel.games.partials.form', [ 'submitButtonText' => __('games.update'), 'isUpdate' => true ])
    {!! Form::close() !!}
  </div>
@endsection