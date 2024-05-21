<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
    <title>@yield('title', __('Admin - PawsPalace'))</title>
</head>

<body>
    <div class="row g-0 flex-grow-1">
        <div class="p-3 col fixed custom-bg">
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
                        class="mt-2 btn btn-go">{{ __('Go back to the home page') }}</a>
                </li>
            </ul>
        </div>
        <div class="col body">
            <nav class="p-3 shadow text-end">
                <span class="profile-font">{{ __('Admin') }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('/img/undraw_profile.svg') }}">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>