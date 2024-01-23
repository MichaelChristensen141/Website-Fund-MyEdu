<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    {{-- Title --}}
    <title>
        @isset($title)
            {{ $title . ' - ' . config('web.title') }}
        @else
            {{ config('web.title') }}
        @endisset
    </title>

    <!-- Stylesheets -->
    <link href="{{ url('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ url('/css/preloader.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ url('/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('/images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="/https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="/js/respond.js"></script><![endif]-->

    @yield('css')
</head>

<body>

    <div class="page-wrapper dashboard ">


        @include('layouts.front.navbar')


        <!-- Sidebar Backdrop -->
        <div class="sidebar-backdrop"></div>

        @include('layouts.back.sidebar')

        @yield('content')


        <!-- Copyright -->
        <div class="copyright-text">
            <p> &copy; {{ date('Y') }}
                <strong><a href="{{ route('index') }}">{{ config('web.footer') }}</a></strong>.
                All Rights Reserved. {{ config('web.make') }}
            </p>
        </div>

    </div><!-- End Page Wrapper -->


    <script src="{{ url('/js/jquery.js') }}"></script>
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/chosen.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/js/jquery.fancybox.js') }}"></script>
    <script src="{{ url('/js/jquery.modal.min.js') }}"></script>
    <script src="{{ url('/js/mmenu.polyfills.js') }}"></script>
    <script src="{{ url('/js/mmenu.js') }}"></script>
    <script src="{{ url('/js/appear.js') }}"></script>
    <script src="{{ url('/js/anm.min.js') }}"></script>
    <script src="{{ url('/js/ScrollMagic.min.js') }}"></script>
    <script src="{{ url('/js/rellax.min.js') }}"></script>
    <script src="{{ url('/js/owl.js') }}"></script>
    <script src="{{ url('/js/wow.js') }}"></script>
    <script src="{{ url('/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire(
                    'Ubah Gagal',
                    '{{ $error }}',
                    'warning'
                )
            </script>
        @endforeach
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire(
                'Ubah Gagal',
                '{{ session('error') }}',
                'warning'
            )
        </script>
    @endif
    <script>
        var master = false;

        function masterIcon() {
            // Ambil ikon yang ada di elemen Collapse
            var icon = $(this).find('.fas');

            // Periksa apakah elemen Collapse sedang terbuka atau tertutup
            @if (request()->routeIs('masterdata.kampus.*'))
                if ($(this).attr('aria-expanded') === 'false') {
                    // Jika elemen Collapse terbuka, ubah ikon menjadi ikon yang sesuai saat tertutup
                    icon.removeClass('fa-chevron-right').removeClass('fa-chevron-down').addClass('la fa-chevron-right');
                    master = false;
                    console.log('tutup');
                } else {
                    // Jika elemen Collapse tertutup, ubah ikon menjadi ikon yang sesuai saat terbuka
                    icon.removeClass('fa-chevron-right').removeClass('fa-chevron-down').addClass('la fa-chevron-down');
                    master = true;
                    console.log('buka');

                }
            @else
                if ($(this).attr('aria-expanded') === 'false') {
                    // Jika elemen Collapse tertutup, ubah ikon menjadi ikon yang sesuai saat terbuka
                    icon.removeClass('fa-chevron-right').removeClass('fa-chevron-down').addClass('la fa-chevron-down');
                    master = true;
                    console.log('buka');
                } else {
                    // Jika elemen Collapse terbuka, ubah ikon menjadi ikon yang sesuai saat tertutup
                    icon.removeClass('fa-chevron-right').removeClass('fa-chevron-down').addClass('la fa-chevron-right');
                    master = false;
                    console.log('tutup');
                }
            @endif
        }

        $(document).ready(function() {
            // Ketika elemen Collapse diklik
            $('[data-toggle="collapse"]').on('click', masterIcon);
        });
    </script>


</body>


<!-- Mirrored from creativelayers.net/themes/superio/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jun 2023 09:10:10 GMT -->

</html>
