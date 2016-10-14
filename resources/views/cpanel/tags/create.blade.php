@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.tags.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ trans('tags.create') }}</h3>
    <hr>
    {!! Form::open([ 'action' => 'CPanel\TagController@store', 'files' => true ]) !!}
    @include('cpanel.tags.partials.form', [ 'submitButtonText' => trans('general.add'), 'isUpdate' => false ])
    {!! Form::close() !!}
  </div>
@endsection