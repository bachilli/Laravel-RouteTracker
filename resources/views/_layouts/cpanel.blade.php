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
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Menu</a>
                        <div class="dropdown-menu" aria-labelledby="Preview">
                            <a class="dropdown-item" href="#">{{ trans('general.games') }}</a>
                            <hr>
                            <a class="dropdown-item" href="#">{{ trans('general.categories') }}</a>
                            <a class="dropdown-item" href="#">{{ trans('general.tags') }}</a>
                        </div>
                    </li>
                    <li class="nav-item pull-xs-right"><a class="nav-link" href="#">{{ trans('general.logout') }}</a></li>
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