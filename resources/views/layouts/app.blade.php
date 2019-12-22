<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
            
       
      

        <main class="content-warpper">

                <nav> 
                

                        @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                      
                        @endguest
                        
                                    </nav>


            <section class="top-section">

                    @yield('content')
            </section>
            <section class="form-input">

                    @yield('form-input')
            </section>
            <section class="mid-section">
                    @yield('vue-component')
            </section>
         
        </main>
      
                @yield('errors')

    </div>
    <footer>
            <div class="copyright-info"><strong>Ayoub Bousetta</strong><br>Copyright - 2019 Limited.</div>
    </footer>
</body>
</html>
