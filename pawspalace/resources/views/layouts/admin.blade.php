<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
    <title>@yield('title', __('Admin - PawsPalace'))</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="row g-0 flex-grow-1">
        <div class="p-3 col fixed text-white bg-dark">
            <a href="{{ route('admin.home.index') }}" class="text-white text-decoration-none">
                <span class="fs-4">{{ __('Admin Panel') }}</span>
            </a>
            <hr />
            <ul class="nav flex-column">
                <li><a href="{{ route('admin.home.index') }}" class="nav-link text-white">{{ __('Home') }}</a></li>
                <li><a href="{{ route('admin.product.index') }}" class="nav-link text-white">{{ __('Products') }}</a>
                </li>
                <li><a href="{{ route('admin.appointment.index') }}"
                        class="nav-link text-white">{{ __('Appointment') }}</a></li>
                <li>
                    <a href="{{ route('home.index') }}"
                        class="mt-2 btn bg-primary text-black">{{ __('Go back to the home page') }}</a>
                </li>
            </ul>
        </div>
        <div class="col body">
            <nav class="p-3 shadow text-end">
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
            </nav>
            <div class="content-container">
                @yield('content')
            </div>
            <div class="footer copyright py-4 text-center">
                <div class="container">
                    <small>
                        {{ __('Copyright - PawsPalace') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>