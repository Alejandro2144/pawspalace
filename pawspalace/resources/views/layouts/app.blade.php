<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>@yield('title', __('PawsPalace'))</title>
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .content-container {
        flex: 1;
        padding-bottom: 30px;
    }

    .body {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="{{ route('home.index') }}">
                <img src="{{ asset('/img/logo.png') }}" alt="{{ __('PawsPalace Logo') }}"
                    style="max-height: 150px; width: auto;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" href="{{ route('home.index') }}">{{ __('Home') }}</a>
                    <a class="nav-link active" href="{{ route('product.index') }}">{{ __('Products') }}</a>
                    <a class="nav-link active"
                        href="{{ route('appointment.index') }}">{{ __('Schedule Appointment') }}</a>
                    <a class="nav-link active" href="{{ route('cart.index') }}">{{ __('Cart') }}</a>
                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    @guest
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @else
                    <a class="nav-link active" href="{{ route('product.showFavorites') }}">{{ __('My Favorites') }}</a>
                    <a class="nav-link active" href="{{ route('myaccount.orders') }}">{{ __('My Orders') }}</a>
                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link active"
                            onclick="document.getElementById('logout').submit();">{{ __('Logout') }}</a>
                        @csrf
                    </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <header class="masthead bg-primary text-black text-center py-4">
        <div class="container d-flex align-items-center flex-column">
            <h2>@yield('subtitle', __('Welcome to PawsPalace'))</h2>
        </div>
    </header>

    <div class="container my-4 content-container">
        @yield('content')
    </div>
    <div class="footer">
        <div class="container py-4">
            <div class="footer copyright py-4 text-center text-black">
                <div class="container">
                    <a class="nav-link active" href="{{ route('home.about') }}">{{ __('About') }}</a>
                    <small>
                        {{ __('Copyright - PawsPalace') }}
                    </small>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous">
            </script>
        </div>
    </div>
</body>

</html>