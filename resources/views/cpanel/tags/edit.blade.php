@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.tags.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ trans('tags.edit') }}</h3>
    <hr>
    {!! Form::model($tag, [ 'method' => 'PATCH', 'action' => [ 'CPanel\TagController@update', $tag->id, 'files' => true ] ]) !!}
    @include('cpanel.tags.partials.form', [ 'submitButtonText' => trans('general.update'), 'isUpdate' => true ])
    {!! Form::close() !!}
  </div>
@endsection