@extends('_layouts.primary')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <pre><?php print_r($tag->getAttributes()) ?></pre>
      </div>
    </div>
  </div>
@endsection