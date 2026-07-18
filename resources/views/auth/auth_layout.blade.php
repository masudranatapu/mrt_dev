<!doctype html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact"
    data-bs-theme="{{ $settingInfo->theme_mood == 'light' ? 'light' : 'dark' }}" dir="{{ siteLanguage() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>
        @yield('title') - {{ config('app.name', 'Laravel') }}
    </title>
    <link rel="icon" type="image/x-icon" href="{{ asset($settingInfo->site_favicon) }}" />
    @include('auth.style')
</head>

<body>
    {{-- content --}}
    @yield('content')

    {{-- script --}}
    @include('backend.layouts.partials.script')

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                iziToast.error({
                    message: "{{ $error }}",
                    position: 'topRight'
                });
            @endforeach
        @endif
    </script>

    <script>
        @if (Session::has('message'))

            var type = "{{ Session::get('alert-type', 'success') }}";

            switch (type) {
                case 'success':
                    iziToast.success({
                        message: "{{ Session::get('message') }}",
                        position: 'topRight'
                    });
                    break;
                case 'info':
                    iziToast.info({
                        message: "{{ Session::get('message') }}",
                        position: 'topRight'
                    });
                    break;
                case 'warning':
                    iziToast.warning({
                        message: "{{ Session::get('message') }}",
                        position: 'topRight'
                    });
                    break;
                case 'error':
                    iziToast.error({
                        message: "{{ Session::get('message') }}",
                        position: 'topRight'
                    });
                    break;
            }
        @endif
    </script>
</body>

</html>
