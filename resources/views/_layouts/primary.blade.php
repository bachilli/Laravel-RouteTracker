<!DOCTYPE html>
<html>
  <head>
    {!! $metaTags !!}
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ elixir('css/primary.css') }}">
    <!--[if lt IE 9]><script src="{{ url('js/html5shiv.min.js') }}"></script><![endif]-->
    @yield('css')
    </head>
  <body>
    <header>
      <a href="{{ url('') }}">
        @include('_layouts.svgs.gamepad')
        <h1>CentralJogos</h1>
      </a>
      {!! Form::open([ 'action' => 'Primary\SearchController@index', 'method' => 'GET' ]) !!}
        {{ Form::text('q', null) }}
      {!! Form::close() !!}
      <ul>
        @foreach ($tags as $tag)
          <li><a href="{{ action('Primary\TagController@single', $tag->slug) }}">{{ $tag->name }}</a></li>
        @endforeach
      </ul>
    </header>
    @yield('content')
    <script src="{{ elixir('js/primary.js') }}"></script>
    @yield('js')
  </body>
</html>