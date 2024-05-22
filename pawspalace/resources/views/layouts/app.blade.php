<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
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
                    <a class="nav-link active" href="{{ route('allied.products') }}">{{ __('Allieds') }}</a>
                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    @guest
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @else
                    <a class="nav-link active" href="{{ route('product.showFavorites') }}">{{ __('My Favorites') }}</a>
                    <a class="nav-link active" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>
                    <span class="nav-link active"><i class="fa-solid fa-wallet"></i>:
                        ${{ Auth::user()->getBalance() }}</span>
                    <a class="nav-link active" href="{{ route('myaccount.orders') }}"><i
                            class="fa-solid fa-receipt"></i> {{ __('Orders') }}</a>
                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link active"
                            onclick="document.getElementById('logout').submit();"><i
                                class="fa-solid fa-right-from-bracket"></i></a>
                        @csrf
                    </form>
                    @endguest
                </div>
                <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                <div class="dropdown">
                    <a class="dropdown-toggle" id="Dropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span id="selected-flag" class="flag-icon 
                            @if(app()->getLocale() == 'en') flag-icon-gb
                            @elseif(app()->getLocale() == 'es') flag-icon-es
                            @elseif(app()->getLocale() == 'fr') flag-icon-fr
                            @elseif(app()->getLocale() == 'ja') flag-icon-jp
                            @elseif(app()->getLocale() == 'pt') flag-icon-pt
                            @endif"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="Dropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('locale/en') }}" onclick="setFlag('gb')"><span
                                    class="flag-icon flag-icon-gb"></span> English</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('locale/es') }}" onclick="setFlag('es')"><span
                                    class="flag-icon flag-icon-es"></span> Español</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('locale/fr') }}" onclick="setFlag('fr')"><span
                                    class="flag-icon flag-icon-fr"></span> Français</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('locale/ja') }}" onclick="setFlag('jp')"><span
                                    class="flag-icon flag-icon-jp"></span> 日本語</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('locale/pt') }}" onclick="setFlag('pt')"><span
                                    class="flag-icon flag-icon-pt"></span> Português</a>
                        </li>
                    </ul>
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
        <h3 class="map-title">{{ __('Locate the store') }}</h3>
        <div id="map"></div>
    </div>
    @endif

    <div class="footer">
        <div class="center-content">
            <a class="nav-link" href="{{ route('home.about') }}">{{ __('About Us') }}</a>
            <small>
                {{ __('Copyright - PawsPalace') }}
            </small>
        </div>

        @if(Auth::check() && Auth::user()->getRole() === 'admin')
        <div class="admin-panel">
            <a class="nav-link" href="{{ route('admin.home.index') }}">{{ __('Admin Panel') }}</a>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}"></script>
    <script src="{{ asset('js/map.js') }}"></script>


</body>

</html>