@extends('_layouts.cpanel')

@section('content')
    @include('cpanel.categories.partials.menu')
    <div class="card card-block">
        @include('_layouts.partials.cpanel.alerts.default')
        @include('_layouts.partials.cpanel.alerts.validator')
        <h3 class="card-title">{{ trans('categories.create') }}</h3>
        <hr>
        {!! Form::open([ 'action' => 'CPanel\CategoryController@store', 'files' => true ]) !!}
            @include('cpanel.categories.partials.form', [ 'submitButtonText' => trans('general.add'), 'isUpdate' => false ])
        {!! Form::close() !!}
    </div>
@endsection