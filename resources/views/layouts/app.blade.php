<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Afif association and charity helping migrants families">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css" integrity="sha512-P9vJUXK+LyvAzj8otTOKzdfF1F3UYVl13+F8Fof8/2QNb8Twd6Vb+VD52I7+87tex9UXxnzPgWA3rH96RExA7A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg">
            <!-- <div class="container-fluid"> -->
            <a class="navbar-brand" href="{{url('/')}}"> <img class="logo-img" src="/storage/images/logo-afif.jpg" alt='logo' /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"> <i class="fa fa-bars"> </i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" role="button"  href="{{url('/home')}}">{{ __('Accueil') }}</a>
                        
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">{{ __('Qui sommes-nous?') }}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item"  href="{{route('services.index')}}">Notre mission</a></li>
                            <li><a class="dropdown-item" href="{{route('users.index')}}">Notre equipe</a></li>
                            <li><a class="dropdown-item" href="{{route('faqs.index')}}">Faqs</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item"><a class="nav-link" role="button"  aria-expanded="false" href="{{route('services.index')}}">{{ __('Services') }}</a> -->
            
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">{{ __('Evenements') }}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('events.index')}}">Evenements</a></li>
                            <li><a class="dropdown-item" href="{{route('galleries.index')}}">Galleries</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">{{ __('Contact') }}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Nos partners</a></li>
                            <li><a class="dropdown-item" href="{{route('contact')}}">Volontariat</a></li>
                            <li><a class="dropdown-item" href="{{route('testimonials.index')}}">Temoignages</a></li>
                        </ul>
                    </li>

                </ul>

            </div>
            <!-- </div> -->
        </nav>
        <div class="login">
            <ul>
                <!-- Authentication Links -->
                @if (Route::has('login'))
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endguest
                @endif

            </ul>
        </div>
    </header>

    @yield('content')
    <!--/div-->

    <!-- FOOTER -->
    <footer>
        <div class="row">

            <ul class="col-md-3 col-sm-6">
                <li><a href="{{ url('/') }}">{{ __('Qui sommes-nous?') }}</a></li>
                <li><a href="#">{{ __('Services') }}</a></li>
            </ul>

            <ul class="col-md-3 col-sm-6">

                <li><a href="#">{{ __('Activites') }}</a></li>
                <li><a href="#">{{ __('Evenements') }}</a></li>
            </ul>
            <ul class="col-md-3 col-sm-6">


                <li><a href="#">{{ __('Participer') }}</a></li>
                <li><a href="#">{{ __('Temoignage') }}</a></li>

            </ul>

            <ul class="col-md-3 col-sm-6 social-nets">
                <li>
                    <a class="btn btn-primary btn-floating m-1 facebook" href="#" role="button">
                        <i class="fa fa-facebook-f"> </i>
                    </a>
                </li>
                <li>
                    <a class="btn btn-primary btn-floating m-1 twitter" href="#" role="button">
                        <i class="fa fa-twitter"> </i>
                    </a>
                </li>
                <li>
                    <a class="btn btn-primary btn-floating m-1 youtube" href="#" role="button">
                        <i class="fa fa-youtube"> </i>
                    </a>
                </li>
                <li>
                    <a class="btn btn-primary btn-floating m-1 instagram" href="#" role="button">
                        <i class="fa fa-instagram"> </i>
                    </a>
                </li>
            </ul>


            <div class="offset-sm-5 col-6">
                <p>&copy; 2021, Develop&eacute; par Bakary Diarra.</p>
            </div>

        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"> </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>