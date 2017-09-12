<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
@include('Partials._head')

<body >

    <div class="content">
        @include('Partials._navbar')
        @yield('content-half')
    </div>
    @yield('body')
    @include('Partials._subfooter')
    @include('Partials._footer')

</body>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/fn.codeliter.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.mmenu.js')}}"></script>
    <script type="text/javascript">
            //	The menu on the left
        $(function () {
            $('nav#menu-left').mmenu();
        });
    </script>
    @yield('scripts')
</html>