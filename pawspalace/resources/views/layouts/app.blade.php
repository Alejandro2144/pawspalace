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
                    <span class="nav-link active">{{ __('Balance') }}: ${{ Auth::user()->balance }}</span>
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

    @if(Route::is('home.index') || Route::is('home.about'))
    <div class="map-container">
        <h3 class="map-title">Localiza la tienda</h3>
        <div id="map"></div>
    </div>
@endif

    <div class="footer">
        <div class="container">
            <a class="nav-link" href="{{ route('home.about') }}">{{ __('About Us') }}</a>
            <small>
                {{ __('Copyright - PawsPalace') }}
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}"></script>
        <script>
        function initMap() {
            var mapOptions = {
                center: { lat: 6.192683696746826, lng: -75.56332397460938 },
                zoom: 14
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var marker = new google.maps.Marker({
                position: { lat: 6.192683696746826, lng: -75.56332397460938 },
                map: map,
                title: 'My location'
            });
        }
        window.onload = initMap;
    </script>
</body>
</html>
