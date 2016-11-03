<html>
  <head>
    <meta charset="utf-8">
    <title>CPanel | CentralJogos</title>
    <meta name="_token" content="{{ csrf_token() }}">
    @yield('styles')
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/cpanel.css') }}" media="all">
  </head>
  <body>
    <nav class="navbar navbar-light bg-faded">
      <div class="container">
        <a class="navbar-brand" href="#">CPanel</a>
        <ul class="nav navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Principal</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ action('CPanel\GameController@index') }}">{{ __('general.games') }}</a>
              <a class="dropdown-item" href="{{ action('CPanel\TagController@index') }}">{{ __('general.tags') }}</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Conteúdo</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ action('CPanel\DistributorController@index') }}">{{ __('general.distributors') }}</a>
              <a class="dropdown-item" href="{{ action('CPanel\PublicationController@index') }}">{{ __('general.publications') }}</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Gerenciamento</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">{{ __('general.users') }}</a>
            </div>
          </li>
          <li class="nav-item dropdown pull-xs-right">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Gustavo</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">{{ __('general.profile') }}</a>
              <a class="dropdown-item" href="#">{{ __('general.logout') }}</a>
            </div>
          </li>
          <li class="nav-item pull-xs-right"><a class="nav-link" href="{{ action('Primary\HomepageController@index') }}" target="_blank">&larr; {{ __('general.go_to_site') }}</a></li>
        </ul>
      </div>
    </nav>
    <hr class="dashed">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          @yield('content')
        </div>
      </div>
    </div>
    <script type="text/javascript" src="{{ elixir('js/cpanel.js') }}"></script>
    @yield('scripts')
    @yield('js')
    @include('_layouts.partials._common.google-analytics')
  </body>
</html>