<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>

@include('layouts.nav')

@yield('header')

<div class="container">
    @yield('content')
</div>

@include('layouts.footer')

</body>
</html>
