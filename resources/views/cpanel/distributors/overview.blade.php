@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.distributors.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    --Visão Geral--
  </div>
@endsection