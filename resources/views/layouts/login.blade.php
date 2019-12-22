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
        
            
       
      

        <main class="content-warpper-login">
                @yield('content')
            <section class="left-section">

                <div class="bottom">

                        <a class="btn btn-link" href="{{ route('index') }}">
                                <span class="arrow__zoom">⤺</span> {{ __('Go home') }} 
                            </a>

                   
                        @if (Route::has('password.request') && Route::current()->getName() != "password.request")
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }} <span class="arrow__zoom">➔</span>
                        </a>
                        @endif


                 

                        

                </div>

                    
            </section>
          
            <section class="right-section">
                @if (Route::current()->getName() == "password.request")
                <span>{{ __('Reset') }}</span>
                @else
                <span>{{ucfirst(Route::current()->getName())}}</span>
                @endif
               
                  
                   
                    
            </section>
       
       
         
        </main>
    </div>
</body>
</html>
