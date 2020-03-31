<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://bootswatch.com/4/slate/bootstrap.min.css" rel="stylesheet">

    {{-- External CSS --}}

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
     <div id="app"> 
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    
                    <img src="../images/logo_transparent.png">
                    Asset Management System
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        <a href="/products" class="nav-link">Equipment</a>
                      </li>
                      <li class="nav-item">
                        <a href="/cart" class="nav-link">My Request</a>
                      </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                             <form action ="/search/products" method ="POST"
                                 class="form-inline my-2 my-lg-0">
                                @csrf
                                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                               
                                </div>
                            </li>
                        @endguest
                            
                    </ul>
                </div>
            </div>
        </nav>
 </div> 
        <section id="wrapper" class="skewed">
            <div class="layer bottom">
                <div class="content-wrap">
                    <div class="content-body">
                        <h1>TREK ASSET MANAGEMENT SYSTEM</h1>
                        <P class="asset">This system is used to  keep track of the equipment and inventory vital to day-to-day operation of our business.</P>  
                        <div class="signin">
                            <h4>Please Register or Sign In before using this system.</h1> 
                        
                            <a class="btn btn-info" href="{{ route('login') }}">{{ __('Login') }}</a>
                             @if (Route::has('register'))
                                <a class="btn btn-success" href="{{ route('register') }}">{{ __('Register') }}</a>   
                             @endif
                        </div>
                    </div>
                {{-- <img src="./images/Hyundai.png" alt=""> --}}
                </div>
            </div>

            <div class="layer top">
                <div class="content-wrap">
                    <div class="content-body">  
                      {{-- <h1>Please Register or Sign In before using this system.</h1>  --}}
                    </div>
                    {{-- <img src="./images/Hyundai.png" alt=""> --}}
                </div>
            </div> 
            
            <div class="handle"></div>
        </section>

            <main class="py-4">
                @yield('content')
            </main>
        {{-- </div> --}}

 {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
</body>
</html>
