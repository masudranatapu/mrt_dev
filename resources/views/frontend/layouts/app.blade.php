<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    {{-- seo  --}}
    @include('frontend.layouts.seo')
    {{-- style  --}}
    @include('frontend.layouts.style')
</head>

<body>
    {{-- header  --}}
    @include('frontend.layouts.header')
    {{-- content --}}
    @yield('content')
    {{-- Footer --}}
    @include('frontend.layouts.footer')
    {{-- script  --}}
    @include('frontend.layouts.script')
</body>

</html>
