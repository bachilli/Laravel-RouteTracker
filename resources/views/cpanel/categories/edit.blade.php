@extends('_layouts.cpanel')

@section('content')
    @include('cpanel.categories.partials.menu')
    <div class="card card-block">
        @include('_layouts.partials.cpanel.alerts.default')
        @include('_layouts.partials.cpanel.alerts.validator')
        <h3 class="card-title">{{ trans('categories.edit') }}</h3>
        <hr>
        {!! Form::model($category, [ 'method' => 'PATCH', 'action' => [ 'CPanel\CategoryController@update', $category->id, 'files' => true ] ]) !!}
            @include('cpanel.categories.partials.form', [ 'submitButtonText' => trans('general.update'), 'isUpdate' => true ])
        {!! Form::close() !!}
    </div>
@endsection